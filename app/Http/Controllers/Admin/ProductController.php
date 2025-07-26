<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Log;

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
        $product->load(['images' => function($query) {
            $query->orderBy('order', 'asc');
        }]);
        return view("cms.product.v_edit_product", compact("product"));
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

    public function update(Request $request){
        Log::info('Product update request received', [
            'request_data' => $request->all(),
            'files' => $request->hasFile('images') ? 'has files' : 'no files'
        ]);

        try {
            $validated = $request->validate([
                'id' => 'required|exists:products,id',
                'name'=>'required|string|max:255',
                'description'=>'required|string',
                'price'=>'required|numeric|min:0',
                'seller_name'=>'required|string|max:255',
                'contact_person'=>'required|string|max:20',
                'status'=>'required|in:ready,habis,preorder',
                'images.*' => 'nullable|image|max:1024',
                'image_order' => 'nullable|string',
            ]);

            Log::info('Validation passed', $validated);

            $validated['images'] = $request->file('images');

            $updateProduct = $this->productService->update($validated);
            if ($updateProduct) {
                Log::info('Product updated successfully');
                return $this->success($updateProduct, 'Produk berhasil diperbarui');
            } else {
                Log::error('Product update failed in service');
                return $this->error('Produk gagal diperbarui');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Exception in product update', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function updateOld(Request $request, $id){
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
            'image_order' => 'nullable|string',
        ]);

        $validated['id'] = $id;
        $validated['images'] = $request->file('images');

        // Handle image order update
        if ($request->has('image_order')) {
            $imageOrder = json_decode($request->image_order, true);
            if (is_array($imageOrder)) {
                foreach ($imageOrder as $orderData) {
                    if (isset($orderData['id']) && isset($orderData['order'])) {
                        \App\Models\ProductImage::where('id', $orderData['id'])
                            ->where('product_id', $id)
                            ->update(['order' => $orderData['order']]);
                    }
                }
            }
        }

        app(ProductRepository::class)->update($validated);

        return response()->json(['message' => 'Produk berhasil diperbarui.']);
    }


    public function destroy($id)
    {
        $data = $this->productService->delete($id);
        return $this->success($data, 'Produk berhasil dihapus');
    }
}
