<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface BlogRepositoryInterface
{
    public function index(Request $request);
    public function show($id);
    public function store(Request $request);
    public function update(Request $request);
    public function delete($id);
}
