<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventPageController extends Controller
{
    public function index(){
        $events = Event::all();

        return view('/event', ['events'=>$events]);
    }
}
