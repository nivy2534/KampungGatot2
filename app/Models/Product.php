<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'price',
        'description',
        'status',
        'image_path',
        'author_id',
        'author_name',
        'seller_name',
        'slug',
        'excerpt',
        'image_url',
        'image_path',
        'contact_person'
    ];

        /**
         * Get the formatted creation date.
         */
    public function getDateAttribute(): string
    {
        return $this->created_at
            ? $this->created_at->translatedFormat('d F Y H:i:s')
            : '';
    }
}
