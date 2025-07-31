<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'price',
        'description',
        'type',
        'event_start_date',
        'event_end_date',
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

    protected static function booted()
    {
        static::deleting(function ($product) {
            // Delete all associated images when product is deleted
            $product->images()->delete();
        });
    }

        /**
         * Get the formatted creation date.
         */
    public function getDateAttribute(): string
    {
        return $this->created_at
            ? $this->created_at->translatedFormat('d F Y')
            : '';
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get all product images in correct order (main image + additional images)
     * Returns collection of objects with url, alt, order, and is_main properties
     */
    public function getAllImagesOrdered()
    {
        $allImages = collect();
        
        // Add main image if exists
        if ($this->image_url) {
            $allImages->push((object)[
                'url' => asset($this->image_url),
                'alt' => $this->name,
                'order' => -1, // Ensure main image is first
                'is_main' => true
            ]);
        }
        
        // Add additional images (already ordered by relationship)
        if ($this->images && $this->images->count() > 0) {
            foreach ($this->images as $image) {
                $allImages->push((object)[
                    'url' => asset('storage/' . $image->image_path),
                    'alt' => $this->name,
                    'order' => $image->order,
                    'is_main' => false
                ]);
            }
        }
        
        // Sort by order and return
        return $allImages->sortBy('order')->values();
    }

    /**
     * Get the first image URL (main image or first additional image)
     */
    public function getFirstImageUrl()
    {
        $images = $this->getAllImagesOrdered();
        return $images->first() ? $images->first()->url : null;
    }

    // Relasi ke User (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
