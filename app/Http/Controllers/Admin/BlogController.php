<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Requests\BlogRequest;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class BlogController extends Controller
{
    protected $blogService;
    use ApiResponse;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->blogService->index($request);
        }
        return view("cms.blog.v_blog");
    }

    public function create()
    {
        return view("cms.blog.v_create_blog");
    }

    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);
        return view("cms.blog.v_create_blog", compact("blog"));
    }

    public function store(BlogRequest $request)
    {
        $createBlog = $this->blogService->store($request->validated());
        if ($createBlog) {
            return $this->success($createBlog, 'Berita berhasil dibuat');
        } else {
            return $this->error('Berita gagal dibuat');
        }
    }

    public function update(BlogRequest $request)
    {
        $blog = Blog::findOrFail($request->id);
        $this->authorize('update', $blog);
        $createBlog = $this->blogService->update($request->validated());
        if ($createBlog) {
            return $this->success($createBlog, 'Berita berhasil dibuat');
        } else {
            return $this->error('Berita gagal dibuat');
        }
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $this->authorize('delete', $blog);
        $data = $this->blogService->delete($id);
        return $this->success($data, 'Data berhasil dihapus');
    }
}
