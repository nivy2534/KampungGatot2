<?php

namespace App\Http\Controllers\Homepage;

use App\Models\Blog;
use App\Models\Product;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        // Ambil blog terbaru dengan status published (limit 3)
        $latestBlogs = Blog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Ambil produk terbaru (limit 6)
        $latestProducts = Product::with(['images' => function($query) {
                $query->orderBy('order', 'asc'); // Konsisten dengan CMS
            }])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view("homepage.index", compact('latestBlogs', 'latestProducts'));
    }
}
