<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    public function update(User $user, Product $product)
    {
        return $user->id === $product->author_id;
    }
    public function delete(User $user, Product $product)
    {
        return $user->id === $product->author_id;
    }
    public function view(User $user, Product $product)
    {
        return $user->id === $product->author_id;
    }
    public function create(User $user)
    {
        return true;
    }
}
