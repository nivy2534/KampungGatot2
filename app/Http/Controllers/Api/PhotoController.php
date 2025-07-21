<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index(Request $request){
        $limit = $request->input('limit', 10);
        $status = $request->input('status'); // "active" | "inactive"

        $query = Photo::query();

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $photos = $query->paginate($limit);

        return response()->json($photos);
    }

    public function show($id){
        $photo = Photo::find($id);
        if(!$photo){
            return response()->json(['message'=>'Foto tidak ditemukan'], 404);

        }
        return response()->json($photo);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'photo_name' => 'required|string|max:255',
            'photo_description' => 'nullable|string',
            'photo_date' => 'required|date',
            'event_id' => 'nullable|integer|exists:events,id',
            'production_id' => 'nullable|integer|exists:productions,id',
            'blog_id' => 'nullable|integer|exists:blog,id',
        ]);
        $photo=Photo::create($validated);
        return response()->json($photo, 201);
    }

    public function update(Request $request, $id){
        $photo = Photo::find($id);
        if (!$photo) return response()->json(['message' => 'Foto tidak ditemukan'], 404);

        $validated = $request->validate([
            'photo_name' => 'sometimes|required|string|max:255',
            'photo_description' => 'nullable|string',
            'photo_date' => 'sometimes|required|date',
            'event_id' => 'nullable|integer|exists:events,id',
            'production_id' => 'nullable|integer|exists:productions,id',
            'blog_id' => 'nullable|integer|exists:blog,id',
        ]);

        $photo->update($validated);
        return response()->json($photo);
    }

    public function destroy($id){
        $photo = Photo::find($id);
        if(!$photo) return response()->json(['message' => 'Foto tidak ditemukan'], 404);
    
        $photo->delete();
        return response()->json(['message' => 'Foto berhasil dihapus']);
    }

    public function count(Request $request)
    {
        $status = $request->query('status'); // 'active', 'inactive', atau null

        $query = Photo::query();

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        return response()->json(['count' => $query->count()]);
    }

}
