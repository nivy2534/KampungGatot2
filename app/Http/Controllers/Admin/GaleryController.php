<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Services\GaleryService;
use App\Http\Requests\GaleryRequest;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class GaleryController extends Controller
{
    protected $galeryService;
    use ApiResponse;

    public function __construct(GaleryService $galeryService)
    {
        $this->galeryService = $galeryService;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->galeryService->index($request);
        }
        return view("cms.galery.v_galery");
    }

    public function create()
    {
        return view("cms.galery.v_create_photo");
    }

    public function edit(Blog $blog)
    {
        return view("cms.blog.v_create_photo", compact("photo"));
    }

    public function store(GaleryRequest $request)
    {
        $createPhoto = $this->galeryService->store($request->validated());
        if ($createPhoto) {
            return $this->success($createPhoto, 'Foto berhasil disimpan');
        } else {
            return $this->error('Foto gagal disimpan');
        }
    }

    public function update(GaleryRequest $request)
    {
        $createPhoto = $this->galeryService->update($request->validated());
        if ($createPhoto) {
            return $this->success($createPhoto, 'Berita berhasil dibuat');
        } else {
            return $this->error('Berita gagal dibuat');
        }
    }

    public function destroy($id)
    {
        $data = $this->galeryService->delete($id);
        return $this->success($data, 'Data berhasil dihapus');
    }
}
