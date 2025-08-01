<?php

namespace App\Http\Controllers\Homepage;

use App\Models\Blog;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HomepageController extends Controller
{
    public function index()
    {
        // Ambil blog terbaru dengan status published (limit 3)
        $latestBlogs = Blog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Ambil produk terbaru (limit 6)
        $latestProducts = Product::with(['images' => function($query) {
                $query->orderBy('order', 'asc'); // Konsisten dengan CMS
            }])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Ambil event (produk dengan type = 'event')
        $allEvents = Product::where('type', 'event')
            ->whereNotNull('event_start_date')
            ->orderBy('event_start_date', 'asc')
            ->get();

        // Group events berdasarkan waktu
        $today = Carbon::today();
        $now = Carbon::now();
        
        $currentEvents = $allEvents->filter(function ($event) use ($today, $now) {
            $start = Carbon::parse($event->event_start_date);
            $end = Carbon::parse($event->event_end_date);
            return $start->lte($now) && $end->gte($today);
        });

        $upcomingEvents = $allEvents->filter(function ($event) use ($today) {
            $start = Carbon::parse($event->event_start_date);
            return $start->gt($today);
        });

        $pastEvents = $allEvents->filter(function ($event) use ($today) {
            $end = Carbon::parse($event->event_end_date ?? $event->event_start_date);
            return $end->lt($today);
        });

        return view("homepage.index", compact(
            'latestBlogs', 
            'latestProducts', 
            'allEvents', 
            'currentEvents', 
            'upcomingEvents', 
            'pastEvents'
        ));
    }
}
