<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class EventPageController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $products = Product::query()->where('status', 'ready');

        if ($search) {
            $products->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('seller_name', 'like', '%' . $search . '%');
            });
        }

        $products = $products->latest()->paginate(12);

        return view('event', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'ready')
            ->firstOrFail();

        // Ambil produk terkait (same seller atau random)
        $relatedProducts = Product::where('status', 'ready')
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('event-detail', compact('product', 'relatedProducts'));
    }
}
