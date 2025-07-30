<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'image_path', 'image_url', 'order'];

    protected static function booted()
    {
        static::deleting(function ($productImage) {
            // Delete physical file when record is deleted
            if ($productImage->image_path && Storage::disk('public')->exists($productImage->image_path)) {
                Storage::disk('public')->delete($productImage->image_path);
                \Log::info("Deleted image file: {$productImage->image_path}");
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
