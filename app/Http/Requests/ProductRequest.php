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
         $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:ready,habis,preorder',
            'seller_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:20',
         ];

         // Jika ini adalah update (ada ID), images tidak wajib
         if ($this->has('id') && $this->id) {
             $rules['id'] = 'required|exists:products,id';
             $rules['images'] = 'nullable|array';
             $rules['images.*'] = 'nullable|image|max:5120';
         } else {
             // Jika ini adalah create, images wajib ada
             $rules['images'] = 'required|array|min:1';
             $rules['images.*'] = 'required|image|max:5120';
         }

         return $rules;
     }

}
