<?php

namespace App\Repositories;

use App\Models\Photo;
use App\Models\Product;
use App\Repositories\Contracts\GaleryRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleryRepository implements GaleryRepositoryInterface
{
    public function index(Request $request)
    {
        $limit = $request->length == "" ? '10' : $request->length;
        $offset = $request->start == "" ? '0' : $request->start;

        $query = Photo::orderBy("created_at", "ASC");

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
        // Tangkap file gambar dari request
        $image = $data['image'] ?? null;
        if ($image) {
            $path = $image->store('photo', 'public');
            $data['image_path'] = $path;
        }
        // Isi otomatis photo_date dengan hari ini
        $photo = Photo::create([
            'photo_name' => $data['photo_name'],
            'photo_description' => $data['photo_description'] ?? null,
            'category' => $data['category'],
            'image_path' => $data['image_path'] ?? null,
            'photo_date' => date('Y-m-d'),
        ]);
        return $photo;
    }

    public function update(array $data)
    {
        $photo = Photo::findOrFail($data["id"]);
        // Jika ada file gambar baru, upload dan update image_path
        if (isset($data['image'])) {
            if ($photo->image_path && Storage::exists('public/' . $photo->image_path)) {
                Storage::delete('public/' . $photo->image_path);
            }
            $path = $data['image']->store('photo', 'public');
            $data['image_path'] = $path;
        }
        $photo->update([
            'photo_name' => $data['photo_name'],
            'photo_description' => $data['photo_description'] ?? null,
            'category' => $data['category'],
            'image_path' => $data['image_path'] ?? $photo->image_path,
        ]);
        return $photo;
    }


    public function delete($id)
    {
        $product = Photo::findOrFail($id);
        // Hapus file thumbnail jika ada dan file-nya masih ada di storage
        if ($product->image_path && Storage::exists($product->image_path)) {
            Storage::delete($product->image_path);
        }

        // Hapus data dari database
        return $product->delete();
    }

    public function show($id) {}


    private function uploadThumbnail($image)
    {
        // Tidak dipakai lagi, logic upload langsung di store/update
        return null;
    }

    public function getAllProducts(){
        return Photo::latest()->get();
    }
}
