<?php

namespace App\Http\Controllers;

use App\Models\Photo;

abstract class Controller
{
    public function index(){
        $photos = Photo::all();

        return view('galeri',['photos'=>$photos]);
    }
}
