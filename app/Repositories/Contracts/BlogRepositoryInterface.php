<?php

namespace App\Repositories\Contracts;

use App\Models\Blog;
use Illuminate\Http\Request;

interface BlogRepositoryInterface
{
    public function index(Request $request);
    public function show($id);
    public function store(array $data);
    public function update(array $data);
    public function delete(Blog $blog);
}
