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
        $rules = [
            'photo_name' => 'required|string|max:255',
            'photo_description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'photo_date' => 'nullable|date|date_format:Y-m-d',
        ];

        // Jika ini adalah request untuk create (method POST), image wajib
        // Jika ini adalah request untuk update (method PUT/PATCH), image opsional
        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|max:5120'; // max 5MB
        } else {
            $rules['image'] = 'nullable|image|max:5120'; // max 5MB
        }

        return $rules;
    }
}
