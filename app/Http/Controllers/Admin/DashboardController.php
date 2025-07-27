<?php

namespace App\Http\Controllers\Admin;

use App\Models\visitor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Photo;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $blogs = Blog::all();
        $products = Product::all();
        $photos = Photo::all();
        $totalVisitor = Visitor::count();
        $todayVisitor = Visitor::whereDate('created_at', Carbon::today())->count();

        try{
            DB::connection()->getPdo();
            $dbStatus = 'connected';
        }catch(\Exception $e){
            $dbStatus = 'Not Connected';
        }

        return view('cms.dashboard', compact('blogs','products','photos', 'totalVisitor', 'todayVisitor', 'dbStatus'));
    }
}
