<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index(){
        return response()->json(Photo::all());
    }

    public function show($id){
        $photo = Photo::find($id);
        if(!$photo){
            return response()->json(['message'=>'Foto tidak ditemukan', 404]);
        }
        return response()->json($photo);
    }

    public function store(Request $request){
        $photo=Photo::create($request->all());
        return response()->json($photo, 201);
    }

    public function update(Request $request, $id){
        $photo=Photo::find($id);
        if (!$photo) return response()->json(['message' => 'Foto tidak ditemukan'], 404);
        
        $photo->update($request->all());
        return response()->json($photo);
    }

    public function destroy($id){
        $photo = Photo::find($id);
        if(!$photo) return response()->json(['message' => 'Foto tidak ditemukan'], 404);
    
        $photo->delete();
        return response()->json(['message' => 'Foto tidak ditemukan']);
    }
}
