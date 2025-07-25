<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'product_name',
        'product_description',
        'product_price',
        'product_contact_person',
        'author_name',
        'image_url',
        'image_path'
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
