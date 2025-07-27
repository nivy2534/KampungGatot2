<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'tag' => 'required|in:sejarah,potensi_desa,kabar_warga,umkm_lokal',
        ];

        // Jika ini adalah update (ada ID), image tidak wajib
        if ($this->has('id') && $this->id) {
            $rules['id'] = 'required|exists:blogs,id';
            $rules['image'] = 'nullable|image|max:5120';
        } else {
            // Jika ini adalah create, image wajib ada
            $rules['image'] = 'required|image|max:5120';
        }

        return $rules;
    }
}
