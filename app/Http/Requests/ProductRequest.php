<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'id' => 'nullable|exists:products,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:ready,habis,preorder',
            'seller_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'image' => 'nullable|image|max:1024',
         ];
     }

}
