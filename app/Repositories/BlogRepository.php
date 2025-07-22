<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Yajra\DataTables\DataTables;

class BlogRepository implements BlogRepositoryInterface
{
    public function index(Request $request)
    {
        $limit = $request->length == "" ? '10' : $request->length;
        $offset = $request->start == "" ? '0' : $request->start;

        $query = Blog::query();

        $count = $query->count();
        $limit = $limit < 0 ? $count : $limit;
        $query->skip($offset)->take($limit);
        $data = $query->get();
        return Datatables::of($data)
            ->setOffset($offset)
            ->with([
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
            ])
            ->addColumn("action", function ($item) {
                return `
                    <div class="flex gap-2">
                        <button onclick="editBlog($item)" class="text-blue-600 hover:text-blue-800 p-1">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteBlog($item)" class="text-red-600 hover:text-red-800 p-1">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    `;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make();
    }
    public function store(Request $request) {}
    public function update(Request $request) {}
    public function delete($id) {}
    public function show($id) {}
}
