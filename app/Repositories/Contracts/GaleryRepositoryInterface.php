<?php

namespace App\Repositories\Contracts;

use App\Models\Photo;
use Illuminate\Http\Request;

interface GaleryRepositoryInterface
{
    public function index(Request $request);
    public function show($id);
    public function store(array $data);
    public function update(array $data);
    public function delete($id);
}
