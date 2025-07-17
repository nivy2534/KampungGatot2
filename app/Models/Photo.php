<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable=[
        'photo_name',
        'photo_description',
        'photo_date',
        'event_id',
        'production_id',
        'blog_id'
    ];
}
