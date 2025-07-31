<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class EventPageController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $search = $request->query('search');

        $products = Product::query()
            ->with(['images' => function($query) {
                $query->orderBy('order', 'asc'); // Konsisten dengan CMS
            }]);

        if ($search) {
            $products->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('seller_name', 'like', '%' . $search . '%');
            });
        }

        if ($type) {
            $products->where('type', $type);
        }

        $products = $products->latest()->paginate(12);

        return view('catalog', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['images' => function($query) {
                $query->orderBy('order', 'asc'); // Urutkan berdasarkan order seperti di CMS
            }])
            ->firstOrFail();

        // Ambil produk terkait (same seller atau random)
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('catalog-detail', compact('product', 'relatedProducts'));
    }
}
