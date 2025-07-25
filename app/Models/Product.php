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
        'seller_name',
        'whatsapp_number'
    ];
}
