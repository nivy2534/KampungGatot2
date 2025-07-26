<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Photo;

class DashboardController extends Controller
{
    public function index() {
        $blogs = Blog::all();
        $products = Product::all();
        $photos = Photo::all();

        return view('cms.dashboard', compact('blogs','products','photos'));
    }
}
