<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;


class ProductImageController extends Controller{
    public function destroy($id)
    {
        $image = ProductImage::findOrFail($id);
        $product = $image->product;

        // Delete from public disk storage
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Check if this is the main product image and clear it
        if ($product && $product->image_path === $image->image_path) {
            // Find the next image to set as main, or clear if none
            $nextImage = $product->images()
                ->where('id', '!=', $image->id)
                ->orderBy('order', 'asc')
                ->first();
            
            if ($nextImage) {
                $product->update([
                    'image_path' => $nextImage->image_path,
                    'image_url' => $nextImage->image_url
                ]);
            } else {
                $product->update([
                    'image_path' => null,
                    'image_url' => null
                ]);
            }
        }

        // Delete from database
        $image->delete();

        return response()->json([
            'message' => 'Gambar berhasil dihapus.',
            'product_updated' => $product ? true : false
        ]);
    }
}

