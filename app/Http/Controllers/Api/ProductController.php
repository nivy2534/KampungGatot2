<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return response()->json(Product::all());
    }

    public function show($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message'=>'Produk tidak ditemukan'], 404);
        }

        return response()->json($product);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'product_name'=>'required|string|max:255',
            'product_description'=>'required|string',
            'product_price'=>'required|numeric',
            'prodcut_contact_person'=>'required|string|max:15',
        ]);

        $product = Product::create($validate);
        return response()->json($product);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message'=>'Produk tidak ditemukan'], 404);
        }

        $validated=$request->validate([
            'product_name'=>'sometimes|required|string|max:255',
            'product_description'=>'sometimes|required|string',
            'product_price'=>'sometimes|required|numeric',
            'product_contact_person'=>'sometimes|required|string|max:15',
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    public function delete($id){
        $product=Product::find($id);
        if(!$product){
            return response()->json(['message'=>'Produk tidak ditemukan'], 404);
        }

        $product->delete();
        return response()->json(['mesagge'=>'Produk berhasil dihapus']);
    }
}
