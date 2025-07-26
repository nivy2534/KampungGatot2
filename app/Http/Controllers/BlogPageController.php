<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;

class BlogPageController extends Controller
{
    public function index(Request $request){
        $tag = $request->query('tag');

        $blogs = Blog::query()->where('status', 'published');

        if ($tag) {
            $blogs->where('tag', $tag);
        }

        $blogs = $blogs->latest()->paginate(9);

        return view('blog', [
            'blogs' => $blogs,
            'activeTag' => $tag
        ]);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Ambil blog terkait (same tag, exclude current)
        $relatedBlogs = Blog::where('tag', $blog->tag)
            ->where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->limit(3)
            ->get();

        return view('blog-detail', compact('blog', 'relatedBlogs'));
    }
}
