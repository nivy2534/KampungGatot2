<?php

namespace App\Services;

use App\Repositories\Contracts\GaleryRepositoryInterface;
use App\Traits\ApiResponse;

class GaleryService
{
    use ApiResponse;

    protected $galeryRepository;

    public function __construct(GaleryRepositoryInterface $galeryRepository)
    {
        $this->galeryRepository = $galeryRepository;
    }

    public function index($request)
    {
        return $this->galeryRepository->index($request);
    }

    public function store($request)
    {
        return $this->galeryRepository->store($request);
    }

    public function update($request)
    {
        return $this->galeryRepository->update($request);
    }

    public function delete($id)
    {
        return $this->galeryRepository->delete($id);
    }

    public function getAllProducts()
    {
        return $this->galeryRepository->getAllProducts();
    }
}
