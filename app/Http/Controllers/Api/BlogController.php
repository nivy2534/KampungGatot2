<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Models\Blog;
use function PHPUnit\Framework\returnArgument;

class BlogController extends Controller
{
    public function index(){
        return response()->json(Blog::all());
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
        ]);

        $blog = Blog::create($validated);
        return response()->json($blog, 201);
    }

    public function update(Request $request, $id){
        $blog = Blog::find($id);
        if(!$blog){
            return response()->json(['message'=>'Blog tidak ditemukan'], 404);
        };

        $validate = $request->validate([
            'blog_name'=>'sometimes|required|string|max:255',
            'blog_description'=>'sometimes|required|string',
            'blog_date'=>'sometimes|required|date',
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
}
