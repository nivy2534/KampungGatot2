<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function index(Request $request)
    {
        $limit = $request->length == "" ? '10' : $request->length;
        $offset = $request->start == "" ? '0' : $request->start;

        // Filter hanya konten milik user yang sedang login dengan relasi author
        $query = Product::with('author')
            ->where('author_id', Auth::id())
            ->orderBy("created_at", "ASC");

        if ($request->status_filter != "") {
            $query->where("status", $request->status_filter);
        }

        if ($request->custom_search != "") {
            $query->where('name', 'LIKE', "%$request->custom_search%");
        }

        $count = $query->count();
        $limit = $limit < 0 ? $count : $limit;

        $query = $query->skip($offset)->take($limit);
        $data = $query->get();

        return Datatables::of($data)
            ->setOffset($offset)
            ->with([
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
            ])
            ->addColumn('author_name', function ($item) {
                return $item->author ? $item->author->name : 'Unknown';
            })
            ->addColumn("actions", function ($item) {
                $editUrl = route('products.edit', $item->id);
                return '    <div class="flex gap-2">
                                <a href="' . $editUrl . '" class="text-blue-600 hover:text-blue-800 p-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="btn-delete text-red-600 hover:text-red-800 p-1"
                                    data-id="' . $item->id . '"
                                    data-url="' . route('products.delete', $item->id) . '"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        ';
            })
            ->editColumn('created_at', function ($item) {
                return $item->created_at->translatedFormat('d F Y');
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make();
    }
    
    public function store(array $data)
    {
        $images = $data['images'] ?? []; // tangkap semua file
        $imageOrders = $data['image_orders'] ?? [];

        // Upload thumbnail utama (pertama berdasarkan order)
        if (isset($images[0])) {
            $uploaded = $this->uploadThumbnail($images[0]);
            $data['image_path'] = $uploaded['image_path'];
            $data['image_url'] = $uploaded['image_url'];
        }

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['author_id'] = Auth::user()->id;
        $data['author_name'] = Auth::user()->name;
        $data['excerpt'] = $data['description'];

        $product = Product::create($data);

        // Upload semua gambar dengan order yang benar
        foreach ($images as $index => $img) {
            $uploaded = $this->uploadThumbnail($img);
            $order = isset($imageOrders[$index]) ? $imageOrders[$index] : $index;
            
            $product->images()->create([
                'image_path' => $uploaded['image_path'],
                'image_url' => $uploaded['image_url'],
                'order' => $order,
            ]);
        }

        return $product;
    }

    public function update(array $data)
    {
        $product = Product::findOrFail($data["id"]);

        // Update data produk utama
        $updateData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'seller_name' => $data['seller_name'],
            'contact_person' => $data['contact_person'],
            'status' => $data['status'],
            'slug' => $data['slug'] ?? Str::slug($data['name']),
            'author_id' => Auth::user()->id,
            'author_name' => Auth::user()->name,
            'excerpt' => Str::limit($data['description'], 200),
        ];

        // Handle delete specific images
        if (isset($data['delete_images']) && is_array($data['delete_images'])) {
            foreach ($data['delete_images'] as $imageId) {
                $imageToDelete = $product->images()->find($imageId);
                if ($imageToDelete) {
                    // Delete file from storage
                    if ($imageToDelete->image_path && Storage::exists($imageToDelete->image_path)) {
                        Storage::delete($imageToDelete->image_path);
                    }
                    // Delete from database
                    $imageToDelete->delete();
                }
            }
        }

        // Add new images
        if (isset($data['images']) && is_array($data['images']) && !empty($data['images'])) {
            $imageOrders = $data['image_orders'] ?? [];
            
            // Upload semua gambar baru ke tabel product_images dengan order
            foreach ($data['images'] as $index => $img) {
                $uploaded = $this->uploadThumbnail($img);
                $order = isset($imageOrders[$index]) ? $imageOrders[$index] : ($product->images()->max('order') ?? -1) + 1;
                
                $product->images()->create([
                    'image_path' => $uploaded['image_path'],
                    'image_url' => $uploaded['image_url'],
                    'order' => $order,
                ]);
            }
        }

        // Update main thumbnail jika belum ada atau jika ada gambar pertama
        $firstImage = $product->images()->orderBy('order', 'asc')->first();
        if ($firstImage) {
            $updateData['image_path'] = $firstImage->image_path;
            $updateData['image_url'] = $firstImage->image_url;
        } else if (!$product->image_path) {
            // Jika tidak ada gambar sama sekali, kosongkan thumbnail
            $updateData['image_path'] = null;
            $updateData['image_url'] = null;
        }

        // Handle image order update
        if (isset($data['image_order']) && !empty($data['image_order'])) {
            $imageOrder = json_decode($data['image_order'], true);
            if (is_array($imageOrder)) {
                foreach ($imageOrder as $orderData) {
                    if (isset($orderData['id']) && isset($orderData['order'])) {
                        $product->images()
                            ->where('id', $orderData['id'])
                            ->update(['order' => $orderData['order']]);
                    }
                }
            }

            // Update main thumbnail setelah reorder
            $newFirstImage = $product->images()->orderBy('order', 'asc')->first();
            if ($newFirstImage) {
                $updateData['image_path'] = $newFirstImage->image_path;
                $updateData['image_url'] = $newFirstImage->image_url;
            }
        }

        $product->update($updateData);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        // Hapus file thumbnail jika ada dan file-nya masih ada di storage
        if ($product->image_path && Storage::exists($product->image_path)) {
            Storage::delete($product->image_path);
        }

        // Hapus data dari database
        return $product->delete();
    }

    public function show($id) 
    {
        return Product::findOrFail($id);
    }

    private function uploadThumbnail($image)
    {
        $path = $image->store('products', 'public'); // simpan di storage/app/public/products
        return [
            'image_path' => $path,
            'image_url' => Storage::url($path), // hasilnya: /storage/products/xxx.jpg
        ];
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getAllProducts()
    {
        return Product::where('author_id', Auth::id())->latest()->get();
    }
}
