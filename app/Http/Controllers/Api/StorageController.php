<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class StorageController extends Controller
{
    public function getFolderStats(Request $request)
    {
        $path = $request->query('path', '');

        if (!Storage::exists($path)) {
            return response()->json([
                'message' => 'Folder tidak ditemukan',
            ], 404);
        }

        $files = File::allFiles(storage_path("app/" . $path));

        $totalSize = 0;
        foreach ($files as $file) {
            $totalSize += $file->getSize();
        }

        return response()->json([
            'totalSize' => $totalSize,
            'fileCount' => count($files),
        ]);
    }
}
