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
            ->addColumn('author_name', function ($item) {
                return $item->author ? $item->author->name : 'Unknown';
            })
            ->addColumn("actions", function ($item) {
                $editUrl = route('catalogs.edit', $item->id);
                $visitUrl = url("/catalog/{$item->slug}");
                return '    <div class="flex gap-2">
                                <a href="' . $editUrl . '" class="text-blue-600 hover:text-blue-800 p-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="btn-delete text-red-600 hover:text-red-800 p-1"
                                    data-id="' . $item->id . '"
                                    data-url="' . route('catalogs.delete', $item->id) . '"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="' . $visitUrl . '" class="text-blue-600 hover:text-blue-800 p-1">
                                    <i class="fas fa-eye"></i>
                                </a>
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
            'type' => $data['type'],
            'slug' => $data['slug'] ?? Str::slug($data['name']),
            'author_id' => Auth::user()->id,
            'author_name' => Auth::user()->name,
            'excerpt' => Str::limit($data['description'], 200),
        ];

        // Tambahkan tanggal event jika tipe adalah event
        if ($data['type'] === 'event') {
            $updateData['event_start_date'] = $data['event_start_date'];
            $updateData['event_end_date'] = $data['event_end_date'];
        } else {
            // Hapus tanggal event jika tipe bukan event
            $updateData['event_start_date'] = null;
            $updateData['event_end_date'] = null;
        }

                // Handle rename/move product folder if product name changed
        if ($nameChanged && Storage::disk('public')->exists("products/{$oldFolderName}")) {
            // Create new folder
            Storage::disk('public')->makeDirectory("products/{$newFolderName}");

            // Move images to new folder
            foreach ($product->images as $image) {
                if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                    $fileName = basename($image->image_path);
                    $newPath = "products/{$newFolderName}/{$fileName}";

                    // Copy file to new location
                    Storage::disk('public')->copy($image->image_path, $newPath);

                    // Update database record
                    $image->update([
                        'image_path' => $newPath,
                        'image_url' => Storage::disk('public')->url($newPath)
                    ]);

                    // Delete old file
                    Storage::disk('public')->delete($image->image_path);
                }
            }

            // Update main product image path if exists
            if ($product->image_path) {
                $fileName = basename($product->image_path);
                $newMainPath = "products/{$newFolderName}/{$fileName}";
                if (Storage::disk('public')->exists($newMainPath)) {
                    $updateData['image_path'] = $newMainPath;
                    $updateData['image_url'] = Storage::disk('public')->url($newMainPath);
                }
            }

            // Remove old folder
            Storage::disk('public')->deleteDirectory("products/{$oldFolderName}");
        }

        // Handle delete specific images
        if (isset($data['delete_images']) && is_array($data['delete_images'])) {
            foreach ($data['delete_images'] as $imageId) {
                $imageToDelete = $product->images()->find($imageId);
                if ($imageToDelete) {
                    // Delete file from storage
                    if ($imageToDelete->image_path && Storage::disk('public')->exists($imageToDelete->image_path)) {
                        Storage::disk('public')->delete($imageToDelete->image_path);
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

        // Method 1: Get folder name from product image_path
        $productFolderName = null;
        if ($product->image_path) {
            // Extract folder name from path like "products/product-name/image.jpg"
            $pathParts = explode('/', $product->image_path);
            if (count($pathParts) >= 2 && $pathParts[0] === 'products') {
                $productFolderName = $pathParts[1];
            }
        }

        // Method 2: If no main image, try to get folder from product images
        if (!$productFolderName && $product->images->count() > 0) {
            $firstImage = $product->images->first();
            if ($firstImage->image_path) {
                $pathParts = explode('/', $firstImage->image_path);
                if (count($pathParts) >= 2 && $pathParts[0] === 'products') {
                    $productFolderName = $pathParts[1];
                }
            }
        }

        // Method 3: If still no folder name, generate from product name (fallback)
        if (!$productFolderName) {
            $productFolderName = Str::slug($product->name);
        }

        // Delete individual image files first (as fallback)
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // Delete all product images from database records
        foreach ($product->images as $image) {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        // Delete the entire product folder if it exists
        if ($productFolderName) {
            $productFolderPath = "products/{$productFolderName}";
            if (Storage::disk('public')->exists($productFolderPath)) {
                // Log the deletion for debugging
                \Log::info("Deleting product folder: {$productFolderPath}");

                // Get all files and subdirectories in the folder
                $files = Storage::disk('public')->allFiles($productFolderPath);
                $directories = Storage::disk('public')->allDirectories($productFolderPath);

                \Log::info("Files in folder: " . count($files) . " files, " . count($directories) . " subdirectories");

                // Force delete all files first
                foreach ($files as $file) {
                    Storage::disk('public')->delete($file);
                }

                // Delete all subdirectories
                foreach ($directories as $directory) {
                    Storage::disk('public')->deleteDirectory($directory);
                }

                // Finally delete the main directory
                $deleted = Storage::disk('public')->deleteDirectory($productFolderPath);

                if ($deleted) {
                    \Log::info("Product folder deleted successfully: {$productFolderPath}");
                } else {
                    \Log::error("Failed to delete product folder: {$productFolderPath}");
                }
            } else {
                \Log::warning("Product folder not found: {$productFolderPath}");
            }
        }

        // Delete from database (this will also delete related images due to cascade)
        $result = $product->delete();

        // Clean up empty directories in products folder
        $this->cleanupEmptyDirectories();

        \Log::info("Product deleted: ID {$id}, Name: {$product->name}, Folder: {$productFolderName}");

        return $result;
    }

    /**
     * Clean up empty directories in the products folder
     */
    private function cleanupEmptyDirectories()
    {
        try {
            $productsFolderPath = 'products';

            // Get all directories in products folder
            $directories = Storage::disk('public')->directories($productsFolderPath);

            foreach ($directories as $directory) {
                // Check if directory is empty
                $files = Storage::disk('public')->allFiles($directory);
                $subdirectories = Storage::disk('public')->allDirectories($directory);

                if (empty($files) && empty($subdirectories)) {
                    \Log::info("Cleaning up empty directory: {$directory}");
                    Storage::disk('public')->deleteDirectory($directory);
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error cleaning up empty directories: " . $e->getMessage());
        }
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
            'image_url' => asset('storage/' . $path),
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
