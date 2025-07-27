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
        $productName = $data['name'];

        // Upload thumbnail utama (pertama berdasarkan order)
        if (isset($images[0])) {
            $uploaded = $this->uploadThumbnail($images[0], $productName);
            $data['image_path'] = $uploaded['image_path'];
            $data['image_url'] = $uploaded['image_url'];
        }

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['author_id'] = Auth::user()->id;
        $data['author_name'] = Auth::user()->name;
        $data['excerpt'] = $data['description'];

        $product = Product::create($data);

        // Upload semua gambar dengan order yang benar ke folder produk yang sama
        foreach ($images as $index => $img) {
            $uploaded = $this->uploadThumbnail($img, $productName);
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
        $product = Product::with('images')->findOrFail($data["id"]);
        $oldProductName = $product->name;
        $newProductName = $data['name'];
        
        // Check if product name changed (affects folder name)
        $nameChanged = $oldProductName !== $newProductName;
        $oldFolderName = Str::slug($oldProductName);
        $newFolderName = Str::slug($newProductName);

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

        // Handle folder rename if product name changed
        if ($nameChanged && Storage::exists("products/{$oldFolderName}")) {
            // Create new folder
            Storage::makeDirectory("products/{$newFolderName}");
            
            // Move all files to new folder and update database paths
            $allImages = $product->images;
            foreach ($allImages as $image) {
                if ($image->image_path && Storage::exists($image->image_path)) {
                    $fileName = basename($image->image_path);
                    $newPath = "products/{$newFolderName}/{$fileName}";
                    
                    // Copy file to new location
                    Storage::copy($image->image_path, $newPath);
                    
                    // Update database with new path
                    $image->update([
                        'image_path' => $newPath,
                        'image_url' => Storage::url($newPath)
                    ]);
                    
                    // Delete old file
                    Storage::delete($image->image_path);
                }
            }
            
            // Update main product image path if exists
            if ($product->image_path) {
                $fileName = basename($product->image_path);
                $newMainPath = "products/{$newFolderName}/{$fileName}";
                if (Storage::exists($newMainPath)) {
                    $updateData['image_path'] = $newMainPath;
                    $updateData['image_url'] = Storage::url($newMainPath);
                }
            }
            
            // Remove old folder
            Storage::deleteDirectory("products/{$oldFolderName}");
        }

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

        // Add new images to the product folder
        if (isset($data['images']) && is_array($data['images']) && !empty($data['images'])) {
            $imageOrders = $data['image_orders'] ?? [];
            
            // Get the current max order to append new images properly
            $currentMaxOrder = $product->images()->max('order') ?? -1;
            
            // Upload semua gambar baru ke folder produk
            foreach ($data['images'] as $index => $img) {
                $uploaded = $this->uploadThumbnail($img, $newProductName);
                // New images get order starting from max + 1, or use provided order
                $order = isset($imageOrders[$index]) ? $imageOrders[$index] : ($currentMaxOrder + $index + 1);
                
                $product->images()->create([
                    'image_path' => $uploaded['image_path'],
                    'image_url' => $uploaded['image_url'],
                    'order' => $order,
                ]);
            }
        }

        // Handle existing image order updates
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
        }

        // Update main thumbnail to always reflect the first image by order
        $firstImage = $product->images()->orderBy('order', 'asc')->first();
        if ($firstImage) {
            $updateData['image_path'] = $firstImage->image_path;
            $updateData['image_url'] = $firstImage->image_url;
        } else {
            // If no images, clear main thumbnail
            $updateData['image_path'] = null;
            $updateData['image_url'] = null;
        }

        $product->update($updateData);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::with('images')->findOrFail($id);
        
        // Get the product folder name from the first image path
        $productFolderName = null;
        if ($product->image_path) {
            // Extract folder name from path like "products/product-name/image.jpg"
            $pathParts = explode('/', $product->image_path);
            if (count($pathParts) >= 2 && $pathParts[0] === 'products') {
                $productFolderName = $pathParts[1];
            }
        }
        
        // Delete individual image files first (as fallback)
        if ($product->image_path && Storage::exists($product->image_path)) {
            Storage::delete($product->image_path);
        }
        
        // Delete all product images
        foreach ($product->images as $image) {
            if ($image->image_path && Storage::exists($image->image_path)) {
                Storage::delete($image->image_path);
            }
        }
        
        // Delete the entire product folder if it exists
        if ($productFolderName) {
            $productFolderPath = "products/{$productFolderName}";
            if (Storage::exists($productFolderPath)) {
                Storage::deleteDirectory($productFolderPath);
            }
        }

        // Delete from database (this will also delete related images due to cascade)
        return $product->delete();
    }

    public function show($id) 
    {
        return Product::findOrFail($id);
    }

    private function uploadThumbnail($image, $productName = null)
    {
        // Create a clean folder name from product name
        $folderName = $productName ? Str::slug($productName) : 'temp-product-' . time();
        
        // Store in products/{product-name}/ folder
        $path = $image->store("products/{$folderName}", 'public');
        
        return [
            'image_path' => $path,
            'image_url' => Storage::url($path),
            'folder_name' => $folderName
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
