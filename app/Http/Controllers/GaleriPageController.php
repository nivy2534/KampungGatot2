<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class GaleriPageController extends Controller
{
    public function index()
    {
        $photos = Photo::with('author')->orderBy('photo_date', 'desc')->get();

        return view('galeri', [
            'title' => 'Galeri Kampung Gatot',
            'photos' => $photos,
        ]);
    }
}
