<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GaleryRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan membuat request ini.
     */
    public function authorize(): bool
    {
        return true; // Ubah ke false jika ingin menambahkan otorisasi
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived', // sesuaikan enum
            'tag' => 'required|in:sejarah,potensi_desa,kabar_warga,umkm_lokal',
            'image' => 'nullable',
        ];
    }
}
