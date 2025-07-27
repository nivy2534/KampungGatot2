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

        <form action="{{ isset($photo) ? url('/dashboard/gallery/'.$photo->id) : url('/dashboard/gallery/create') }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-6">
            @csrf
            @if(isset($photo))
                @method('PUT')
            @endif
            <!-- Gambar Upload -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar</label>
                <div class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg h-48 md:h-64 bg-gray-50 text-gray-500 text-center overflow-hidden"
                     id="imageUploadContainer">
                    @if(isset($photo) && $photo->image_path)
                        <img id="previewImage" src="{{ asset('storage/' . $photo->image_path) }}" alt="Preview"
                             class="absolute inset-0 w-full h-full object-cover z-0" />
                    @else
                        <img id="previewImage" src="" alt="Preview"
                             class="hidden absolute inset-0 w-full h-full object-cover z-0" />
                    @endif
                    <div id="uploadPlaceholder" class="z-10 flex flex-col items-center">
                        <i class="fa-solid fa-image text-2xl md:text-3xl text-[#1B3A6D]"></i>
                        <label for="imageInput"
                               class="cursor-pointer bg-[#1B3A6D] text-white px-3 py-2 mt-3 rounded-lg hover:bg-[#1B3A6D]/90 transition-colors text-sm">
                            Pilih Gambar
                        </label>
                        <p class="text-xs mt-2">atau seret foto ke sini</p>
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
                       value="{{ isset($photo) ? $photo->photo_name : '' }}" />
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Deskripsi Gambar</label>
                <textarea id="deskripsi" name="photo_description" rows="3" placeholder="Masukkan deskripsi..."
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] resize-vertical">{{ isset($photo) ? $photo->photo_description : '' }}</textarea>
            </div>
            <!-- Kategori -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Kategori Gambar</label>
                <select name="category" id="category"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]">
                    <option value="">Pilih Kategori</option>
                    <option value="pemandangan_alam" {{ (isset($photo) && $photo->category == 'pemandangan_alam') ? 'selected' : '' }}>Pemandangan Alam</option>
                    <option value="kegiatan_warga" {{ (isset($photo) && $photo->category == 'kegiatan_warga') ? 'selected' : '' }}>Kegiatan Warga</option>
                    <option value="umkm_lokal" {{ (isset($photo) && $photo->category == 'umkm_lokal') ? 'selected' : '' }}>UMKM Lokal</option>
                </select>
            </div>
            <!-- Tombol -->
            <div class="flex flex-col md:flex-row gap-3 md:gap-4 pt-6 border-t border-gray-200 mt-6">
                <button type="submit" class="bg-[#1B3A6D] text-white px-4 py-2 rounded-lg hover:bg-[#1B3A6D]/90 transition text-sm font-medium w-full md:w-auto">
                    <i class="fas fa-save mr-2"></i>
                    {{ isset($photo) ? 'Update Galeri' : 'Simpan Galeri' }}
                </button>
                <a href="{{ url('gallery/index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition text-sm font-medium text-center w-full md:w-auto">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@push('addon-script')
<script>
    // Preview gambar setelah memilih file
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewImage.classList.add('block');
                    uploadPlaceholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewImage.classList.add('hidden');
                uploadPlaceholder.style.display = 'flex';
            }
        });
    });
</script>
@endpush
