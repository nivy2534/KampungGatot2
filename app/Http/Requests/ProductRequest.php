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
             'product_name' => 'required|string|max:255',
             'product_description' => 'required|string|max:255',
             'product_price' => 'required|numeric|min:0',
             'product_contact_person' => 'required|string|max:255',
         ];
     }

}
