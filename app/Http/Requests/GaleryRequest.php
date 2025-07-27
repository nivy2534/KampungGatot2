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
            'photo_name' => 'required|string|max:255',
            'photo_description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'photo_date' => 'nullable|date|date_format:Y-m-d',
            'image' => 'nullable|image|max:1024', // max 1MB
        ];
    }
}
