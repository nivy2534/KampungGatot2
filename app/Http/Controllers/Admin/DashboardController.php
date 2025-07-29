<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index() {
        $blogs = Blog::all();
        $products = Product::all();
        $photos = Photo::all();
        $totalVisitor = Visitor::count();
        $todayVisitor = Visitor::whereDate('created_at', Carbon::today())->count();
        
        // Get visitor location data for the chart
        $visitorLocations = $this->getVisitorLocationData();
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities();

        try{
            DB::connection()->getPdo();
            $dbStatus = 'connected';
        }catch(\Exception $e){
            $dbStatus = 'Not Connected';
        }

        return view('cms.dashboard', compact('blogs','products','photos', 'totalVisitor', 'todayVisitor', 'dbStatus', 'visitorLocations', 'recentActivities'));
    }
    
    public function getVisitorLocationData() {
        // Get visitor data grouped by city from the last 30 days (real data only, exclude seeder data)
        $visitorData = Visitor::select('city', 'province', DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->where('city', '!=', 'Unknown')
            ->where('city', '!=', 'Local')
            ->where('user_agent', '!=', 'Sample Browser Data') // Exclude seeder data
            ->whereNotNull('city')
            ->groupBy('city', 'province')
            ->orderBy('total', 'desc')
            ->limit(5) // Only show top 5 cities
            ->get();
            
        return $visitorData;
    }
    
    public function getRecentActivities() {
        $activities = collect();
        
        // Get recent blogs (last 7 days)
        $recentBlogs = Blog::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        foreach ($recentBlogs as $blog) {
            $activities->push([
                'type' => 'blog',
                'icon' => 'fas fa-newspaper',
                'title' => 'Artikel "' . Str::limit($blog->name, 50) . '" telah diterbitkan',
                'time' => $blog->created_at->diffForHumans(),
                'created_at' => $blog->created_at
            ]);
        }
        
        // Get recent products (last 7 days)
        $recentProducts = Product::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        foreach ($recentProducts as $product) {
            $activities->push([
                'type' => 'product',
                'icon' => 'fas fa-box',
                'title' => 'Produk "' . Str::limit($product->name, 50) . '" ditambahkan ke katalog',
                'time' => $product->created_at->diffForHumans(),
                'created_at' => $product->created_at
            ]);
        }
        
        // Get recent photos (last 7 days)
        $recentPhotos = Photo::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        foreach ($recentPhotos as $photo) {
            $activities->push([
                'type' => 'photo',
                'icon' => 'fas fa-image',
                'title' => 'Foto "' . Str::limit($photo->photo_name, 50) . '" ditambahkan ke galeri',
                'time' => $photo->created_at->diffForHumans(),
                'created_at' => $photo->created_at
            ]);
        }
        
        // Get recent visitors count (if significant activity)
        $todayVisitorCount = Visitor::whereDate('created_at', Carbon::today())->count();
        $yesterdayVisitorCount = Visitor::whereDate('created_at', Carbon::yesterday())->count();
        
        if ($todayVisitorCount > 10) {
            $activities->push([
                'type' => 'visitor',
                'icon' => 'fas fa-users',
                'title' => $todayVisitorCount . ' pengunjung mengakses website hari ini',
                'time' => 'Hari ini',
                'created_at' => Carbon::today()
            ]);
        }
        
        // Sort by creation date and limit to 5 most recent
        return $activities->sortByDesc('created_at')->take(5)->values();
    }
    
    public function getVisitorLocationDataApi() {
        $visitorData = $this->getVisitorLocationData();
        return response()->json($visitorData);
    }
}
