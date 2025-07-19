<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable =[
        'blog_name',
        'blog_description',
        'blog_date',
        'blog_status',
        'author_id',
        'author_name',
        'slug',
        'excerpt',
        'image_url',
        'image_path',
    ];

    protected $appends = ['title', 'content'];

    public function getTitleAttribute()
    {
        return $this->blog_name;
    }

    public function getContentAttribute()
    {
        return $this->blog_description;
    }
}
