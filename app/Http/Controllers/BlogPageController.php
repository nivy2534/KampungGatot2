<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BlogPageController extends Controller
{
    public function index(){
        $response = Http::get(url('/api/blogs'));

        if(!$response->successful()){
            return view('blog', ['blogs' => [], 'error' => 'Gagal mengambil data']);
        }

        $blogs = $response->json();

        return view('blog',['blogs'=>$blogs]);
    }
}
