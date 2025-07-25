<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

public function destroy($id)
{
    $image = ProductImage::findOrFail($id);

    if (Storage::exists($image->image_path)) {
        Storage::delete($image->image_path);
    }

    $image->delete();

    return response()->json(['message' => 'Gambar dihapus.']);
}
