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

        $query = Product::orderBy("created_at", "ASC");

        if ($request->type_filter != "") {
            $query->where("type", $request->type_filter);
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
                return $item->created_at->format('d M Y');
            })
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make();
    }
    
    public function store(array $data)
    {
        $images = $data['images'] ?? []; // tangkap semua file

        // Upload thumbnail utama (pertama)
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

        // Upload semua gambar tambahan (termasuk utama juga bisa disimpan di sini)
        foreach ($images as $img) {
            $uploaded = $this->uploadThumbnail($img);
            $product->images()->create([
                'image_path' => $uploaded['image_path'],
                'image_url' => $uploaded['image_url'],
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

        // Update thumbnail utama jika ada gambar baru
        if (isset($data['images']) && is_array($data['images']) && !empty($data['images'])) {
            // Hapus thumbnail lama jika ada
            if ($product->image_path && Storage::exists($product->image_path)) {
                Storage::delete($product->image_path);
            }

            // Upload thumbnail baru (gambar pertama)
            $uploaded = $this->uploadThumbnail($data['images'][0]);
            $updateData['image_path'] = $uploaded['image_path'];
            $updateData['image_url'] = $uploaded['image_url'];

            // Upload semua gambar baru ke tabel product_images
            foreach ($data['images'] as $index => $img) {
                $uploaded = $this->uploadThumbnail($img);
                $product->images()->create([
                    'image_path' => $uploaded['image_path'],
                    'image_url' => $uploaded['image_url'],
                    'order' => $index,
                ]);
            }
        }

        // Handle image order update jika ada
        if (isset($data['image_order'])) {
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
        }

        // Update produk dengan data baru
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
        return Product::latest()->get();
    }
}
