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

        $blogs = Blog::query();

        if ($tag) {
            $blogs->where('tag', $tag);
        }

        $blogs = $blogs->latest()->get();

        return view('blog', [
            'blogs' => $blogs,
            'activeTag' => $tag
        ]);
    }
}
