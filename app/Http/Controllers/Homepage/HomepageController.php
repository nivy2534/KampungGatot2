<?php

namespace App\Http\Controllers\Homepage;


use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function index()
    {
        return view("homepage.index");
    }
}
