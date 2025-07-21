<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request){
        $status = $request->query('status', 'all');
        $perPage = $request->query('pageSize', 10);

        $query = Blog::orderBy('blog_date', 'desc');

        if ($status !== 'all') {
            $query->where('blog_status', $status);
        }

        $blogs = $query->paginate($perPage);

        return response()->json([
            'data' => $blogs->items(),
            'totalItems' => $blogs->total(),
            'totalPages' => $blogs->lastPage(),
        ]);
    }

    public function show($id){
        $blog = Blog::find($id);
        if(!$blog){
            return response()->json(['message'=>'Blog tidak ditemukan'], 404);
        }

        return response()->json($blog);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'blog_name'=>'required|string|max:255',
            'blog_description'=>'required|string',
            'blog_date'=>'required|date',
            'blog_status' => 'required|string',
            'author_id' => 'required|integer',
            'author_name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog,slug',
            'excerpt' => 'required|string|max:500',
            'image_url' => 'nullable|string',
            'image_path' => 'nullable|string',
        ]);

        $blog = Blog::create($validated);
        return response()->json($blog, 201);
    }

    public function uploadImage(Request $request){
        $request -> validate([
            'image'=>'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('assets/img','public');

        return response()->json([
            'url' => asset('storage/'),
            'path'=>$path,
        ]);
    }

    public function showBySlug($slug){
        $blog = Blog::where('slug', $slug)->first();

        if(!$blog){
            return response()->json(['message'=>'Blog tidak ditemukan'],404);
        }

        return response()->json($blog);
    }

    public function update(Request $request, $id){
        $blog = Blog::find($id);
        if(!$blog){
            return response()->json(['message'=>'Blog tidak ditemukan'], 404);
        };

        $validate = $request->validate([
            'blog_name'=>'required|string|max:255',
            'blog_description'=>'required|string',
            'blog_date'=>'required|date',
            'blog_status' => 'required|string',
            'author_id' => 'required|integer',
            'author_name' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog,slug',
            'excerpt' => 'required|string|max:500',
            'image_url' => 'nullable|string',
            'image_path' => 'nullable|string',
        ]);

        $blog->update($validate);
        return response()->json($blog);
    }

    public function delete($id){
        $blog = Blog::find($id);
        if(!$blog){
            return response()->json(['message'=>'blog tidak ditemukan']);
        }

        $blog->delete();
        return response()->json(['message'=>'Blog berhasil dihapus']);
    }

    public function search(Request $request){
        $query = $request->input('q');

        if(!$query){
            return response()->json([],200);
        }

        $blog = Blog::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orWhere('excerpt','LIKE',"%{$query}%")
            ->orderBy('created_at','desc')
            ->get();
        return response()->json($blog);
    }

    public function getPublished(Request $request){
        $limit = $request->query('limit');

        $query = Blog::where('status', 'published')->orderBy('created_at', 'desc');

        if($limit && is_numeric($limit)){
            $query->limit($limit);
        }

        $blog = $query->get();

        return response()->json($blog);
    }
    public function countByStatus(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = Blog::query();
        if ($status !== 'all') {
            $query->where('blog_status', $status);
        }

        return response()->json([
            'count' => $query->count()
        ]);
    }

}
