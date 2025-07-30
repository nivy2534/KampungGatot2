<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Contracts\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function index(Request $request)
    {
        $limit = $request->length == "" ? '10' : $request->length;
        $offset = $request->start == "" ? '0' : $request->start;

        // Filter hanya konten milik user yang sedang login dengan relasi author
        $query = Blog::with('author')
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
            ->editColumn('created_at', function ($item) {
                return $item->created_at->translatedFormat('d F Y');
            })
            ->addColumn("actions", function ($item) {
                $editUrl = route('blogs.edit', $item->id);
                $visitUrl = url("/blog/{$item->slug}");
                return '    <div class="flex gap-2">
                                <a href="' . $editUrl . '" class="text-blue-600 hover:text-blue-800 p-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    class="btn-delete text-red-600 hover:text-red-800 p-1"
                                    data-id="' . $item->id . '"
                                    data-url="' . route('blogs.delete', $item->id) . '"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="' . $visitUrl . '" class="text-blue-600 hover:text-blue-800 p-1">
                                    <i class="fas fa-eye"></i>
                                </a>
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

        // Set excerpt from description field (ringkasan)
        $data['excerpt'] = $data['description'];

        // Set description from content field (konten penuh)
        if (isset($data['content'])) {
            $data['description'] = $data['content'];
            unset($data['content']); // Remove content as it's not a DB column yet
        }

        return Blog::create($data);
    }


    public function update(array $data)
    {
        $blog = Blog::findOrFail($data["id"]);
        if (isset($data['image'])) {
            if ($blog->image_path && Storage::exists($blog->image_path)) {
                Storage::delete($blog->image_path);
            }

            $uploaded = $this->uploadThumbnail($data['image']);
            $data['image_path'] = $uploaded['image_path'];
            $data['image_url'] = $uploaded['image_url'];
        }

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['author_id'] = Auth::user()->id;
        $data['author_name'] = Auth::user()->name;

        // Set excerpt from description field (ringkasan)
        $data['excerpt'] = $data['description'];

        // Set description from content field (konten penuh)
        if (isset($data['content'])) {
            $data['description'] = $data['content'];
            unset($data['content']); // Remove content as it's not a DB column yet
        }

        return $blog->update($data);
    }


    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
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

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
