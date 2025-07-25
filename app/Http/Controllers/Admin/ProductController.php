<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class ProductController extends Controller
{
    protected $productService;
    use ApiResponse;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->productService->index($request);
        }
        $products = $this->productService->getAllProducts();
        return view("cms.product.v_product", compact("products"));
    }

    public function create()
    {
        return view("cms.product.v_create_product");
    }

    public function edit(Product $product)
    {
        return view("cms.product.v_create_product", compact("product"));
    }

    public function store(ProductRequest $request)
    {
        $createProduct = $this->productService->store($request->validated());
        if ($createProduct) {
            return $this->success($createProduct, 'Produk berhasil dibuat');
        } else {
            return $this->error('Produk gagal dibuat');
        }
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message'=>'Produk tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'name'=>'sometimes|required|string|max:255',
            'description'=>'sometimes|required|string',
            'price'=>'sometimes|required|numeric',
            'contact_person'=>'sometimes|required|string|max:15',
            'images.*' => 'nullable|image|max:1024',
        ]);

        $validated['id'] = $id;
        $validated['images'] = $request->file('images');

        app(ProductRepository::class)->update($validated);

        return response()->json(['message' => 'Produk berhasil diperbarui.']);
    }


    public function destroy($id)
    {
        $data = $this->productService->delete($id);
        return $this->success($data, 'Produk berhasil dihapus');
    }
}
