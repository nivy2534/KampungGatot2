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
            ->rawColumns(['actions'])
            ->addIndexColumn()
            ->make();
    }
    public function store(array $data)
    {
        if (isset($data['image'])) {
            $uploaded = $this->uploadThumbnail($data['image']);
            $data['image_path'] = $uploaded['image_path'];
            $data['image_url'] = $uploaded['image_url'];
        }

        // Bisa tambahkan generate slug jika tidak disediakan
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $data['author_id'] = Auth::user()->id;
        $data['author_name'] = Auth::user()->name;
        $data['excerpt'] = $data['description'];

        return Product::create($data);
    }


    public function update(array $data)
    {
        $product = Product::findOrFail($data["id"]);
        if (isset($data['image'])) {
            if ($blog->image_path && Storage::exists($blog->image_path)) {
                Storage::delete($product->image_path);
            }

            $uploaded = $this->uploadThumbnail($data['image']);
            $data['image_path'] = $uploaded['image_path'];
            $data['image_url'] = $uploaded['image_url'];
        }

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['author_id'] = Auth::user()->id;
        $data['author_name'] = Auth::user()->name;
        $data['excerpt'] = $data['description'];

        return $blog->update($data);
    }


    public function delete($id)
    {
        $blog = Product::findOrFail($id);
        // Hapus file thumbnail jika ada dan file-nya masih ada di storage
        if ($blog->image_path && Storage::exists($blog->image_path)) {
            Storage::delete($blog->image_path);
        }

        // Hapus data dari database
        return $blog->delete();
    }

    public function show($id) {}


    private function uploadThumbnail($image)
    {
        $path = $image->store('blogs', 'public'); // simpan di storage/app/public/blogs
        return [
            'image_path' => $path,
            'image_url' => Storage::url($path), // hasilnya: /storage/blogs/xxx.jpg
        ];
    }
}
