<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        return response()->json(Event::all());
    }

    public function show($id){
        $event = Event::find($id);
        if(!$event){
            return response()->json(['message' => 'Event tidak ditemukan'], 404);
        } 

        return response()->json($event);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'event_price' => 'required|numeric',
        ]);

        $event = Event::create($validated);
        return response()->json($event, 201);
    }

    public function update(Request $request, $id){
        $event = Event::find($id);
        if (!$event){
            return response()->json(['message'=>'Event tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'event_name'=>'sometimes|required|string|max:255',
            'event_description'=>'sometimes|required|string',
            'event_date'=>'sometimes|required|date',
            'event_price'=>'sometimes|required|numeric',
        ]);

        $event->update($validated);
        return response()->json($event);
    }

    public function destroy($id){
        $event = Event::find($id);
        if(!$event){
            return response()->json(['message'=>'Event tidak ditemukan'], 404);
        }

        $event->delete();
        return response()->json(['message'=>'Event berhasil dihapus']);
    }
}
