<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function index(Request $request);
    public function show($id);
    public function store(array $data);
    public function update(array $data);
    public function delete($id);
}
