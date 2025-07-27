<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $appends = ['title', 'content', 'date'];

    protected $fillable = [
        'name',
        'description',
        'status',
        'author_id',
        'author_name',
        'slug',
        'excerpt',
        'image_url',
        'image_path',
        'tag',
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

    public function getTitleAttribute()
    {
        return $this->name;
    }

    public function getContentAttribute()
    {
        return $this->description;
    }

    // Relasi ke User (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
