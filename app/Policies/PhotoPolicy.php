<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Photo;

class PhotoPolicy
{
    public function update(User $user, Photo $photo)
    {
        return $user->id === $photo->author_id;
    }
    public function delete(User $user, Photo $photo)
    {
        return $user->id === $photo->author_id;
    }
    public function view(User $user, Photo $photo)
    {
        return $user->id === $photo->author_id;
    }
    public function create(User $user)
    {
        return true;
    }
}
