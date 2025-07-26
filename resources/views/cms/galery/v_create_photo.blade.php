@extends('layouts.app_dashboard')

@section('content')
    <!-- Header -->
    <div class="mb-4 md:mb-6 px-2 md:px-0">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1">
                    {{ isset($photo) ? 'Edit Galeri' : 'Tambah Galeri' }}
                </h1>
                <p class="text-xs md:text-sm text-gray-600">
                    {{ isset($photo) ? 'Ubah data galeri yang sudah ada' : 'Unggah gambar baru ke galeri desa' }}
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url('gallery/index') }}"
                   class="w-full md:w-auto bg-gray-500 text-white px-3 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors hover:bg-gray-600 text-sm">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 mx-2 md:mx-0">
        <div class="p-3 md:p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">
                {{ isset($photo) ? 'Form Edit Galeri' : 'Form Galeri Baru' }}
            </h2>
        </div>

        <div class="p-4 md:p-6">
            <!-- Gambar Upload -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar</label>
                <div class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg h-48 md:h-64 bg-gray-50 text-gray-500 text-center overflow-hidden"
                     id="imageUploadContainer">
                    <img id="previewImage" src="" alt="Preview"
                         class="hidden absolute inset-0 w-full h-full object-cover z-0" />

                    <div id="uploadPlaceholder" class="z-10 flex flex-col items-center">
                        <i class="fa-solid fa-image text-2xl md:text-3xl text-[#1B3A6D]"></i>
                        <label for="imageInput"
                               class="cursor-pointer bg-[#1B3A6D] text-white px-3 py-2 mt-3 rounded-lg hover:bg-[#1B3A6D]/90 transition-colors text-sm">
                            Pilih Gambar
                        </label>
                        <p class="text-xs mt-2">atau seret foto ke sini</p>
                    </div>

                    <div id="imageActions" class="absolute bottom-3 left-3 z-10 gap-2" style="display: none;">
                        <label for="imageInput"
                               class="inline-block bg-[#1B3A6D] text-white px-3 py-1 text-sm rounded hover:bg-[#1B3A6D]/90 cursor-pointer mr-2">
                            Ganti
                        </label>
                        <button id="removeImageBtn" type="button"
                                class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </div>

                    <input name="image" type="file" id="imageInput" class="hidden" accept="image/*" />
                </div>
                <p class="text-xs text-gray-500 mt-2">Lampirkan gambar. Ukuran file tidak boleh lebih dari 1MB</p>
            </div>

            <!-- Judul & Deskripsi -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Judul Gambar</label>
                <input id="judul" name="photo_name" type="text" placeholder="Masukkan judul..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]"
                       value="{{ isset($photo) ? $photo->name : '' }}" />
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="photo_description" rows="3" placeholder="Masukkan deskripsi..."
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] resize-vertical">{{ isset($photo) ? $photo->description : '' }}</textarea>
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                <select name="kategori" id="kategori"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]">
                    <option value="">Pilih Kategori</option>
                    <option value="umum" {{ isset($photo) && $photo->kategori == 'umum' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex flex-col md:flex-row gap-3 md:gap-4 pt-6 border-t border-gray-200 mt-6">
                <button id="submitBtn" class="bg-[#1B3A6D] text-white px-4 py-2 rounded-lg hover:bg-[#1B3A6D]/90 transition text-sm font-medium w-full md:w-auto">
                    <i class="fas fa-save mr-2"></i>
                    {{ isset($photo) ? 'Update Galeri' : 'Simpan Galeri' }}
                </button>
                <a href="{{ url('gallery/index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition text-sm font-medium text-center w-full md:w-auto">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
            </div>
        </div>
    </div>
@endsection
