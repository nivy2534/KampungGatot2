<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
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

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $this->authorize('update', $photo);
        return view("cms.galery.v_create_photo", compact("photo"));
    }

    public function store(GaleryRequest $request)
    {
        $createPhoto = $this->galeryService->store($request->validated());
        if ($createPhoto) {
            return redirect('/dashboard/gallery')->with('success', 'Foto berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Foto gagal disimpan');
        }
    }

    public function update(GaleryRequest $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $this->authorize('update', $photo);
        $data = $request->validated();
        $data['id'] = $id;
        $updatePhoto = $this->galeryService->update($data);
        if ($updatePhoto) {
            return redirect('/dashboard/gallery')->with('success', 'Foto berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Foto gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $this->authorize('delete', $photo);
        $data = $this->galeryService->delete($id);
        return $this->success($data, 'Data berhasil dihapus');
    }
}
