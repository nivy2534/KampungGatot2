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
        return view("cms.product.v_product");
    }

    public function create()
    {
        return view("cms.product.v_create_product");
    }

    public function edit(Product $blog)
    {
        return view("cms.blog.v_create_product", compact("product"));
    }

    public function store(ProductRequest $request)
    {
        $createProduct = $this->productService->store($request->validated());
        if ($createProduct) {
            return $this->success($createProduct, 'Berita berhasil dibuat');
        } else {
            return $this->error('Berita gagal dibuat');
        }
    }

    public function update(ProductRequest $request)
    {
        $createProduct = $this->productService->update($request->validated());
        if ($createProduct) {
            return $this->success($createProduct, 'Berita berhasil dibuat');
        } else {
            return $this->error('Berita gagal dibuat');
        }
    }

    public function destroy($id)
    {
        $data = $this->productService->delete($id);
        return $this->success($data, 'Data berhasil dihapus');
    }
}
