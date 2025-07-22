<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->blogService->index($request);
        }
        return view("cms.v_blog");
    }

    public function create() {}
}
