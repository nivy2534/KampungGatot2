<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;

class BlogPolicy
{
    public function update(User $user, Blog $blog)
    {
        return $user->id === $blog->author_id;
    }
    public function delete(User $user, Blog $blog)
    {
        return $user->id === $blog->author_id;
    }
    public function view(User $user, Blog $blog)
    {
        return $user->id === $blog->author_id;
    }
    public function create(User $user)
    {
        return true;
    }
}
