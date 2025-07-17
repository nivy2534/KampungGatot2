<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Http;
use Log;

class BlogPageController extends Controller
{
    public function index(){
        $blogs = Blog::all();

        return view('blog',['blogs'=>$blogs]);
    }
}
