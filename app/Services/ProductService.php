<?php

namespace App\Services;

use App\Traits\ApiResponse;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{
    use ApiResponse;

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($request)
    {
        return $this->productRepository->index($request);
    }

    public function store($request)
    {
        return $this->productRepository->store($request);
    }

    public function update($request)
    {
        return $this->productRepository->update($request);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }
}
