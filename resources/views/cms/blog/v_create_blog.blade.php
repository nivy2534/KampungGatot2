@extends('layouts.app_dashboard')

@section('content')
    <!-- Header -->
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0 px-3 md:px-0">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1">
                    {{ isset($blog) ? 'Edit Blog' : 'Tambah Blog' }}
                </h1>
                <p class="text-xs md:text-sm text-gray-600">
                    {{ isset($blog) ? 'Ubah konten blog yang sudah ada' : 'Buat konten blog baru untuk website desa' }}
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url('dashboard/blogs') }}"
                    class="w-full md:w-auto bg-gray-500 text-white px-3 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors hover:bg-gray-600 text-sm">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm border border-gray-200 mb-8 mx-2 md:mx-auto">
        <div class="bg-gray-50 px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <h2 class="font-semibold text-base text-gray-800">
                {{ isset($blog) ? 'Form Edit Blog' : 'Form Blog Baru' }}
            </h2>
        </div>

        <div class="p-4 md:p-6">
            <!-- Gambar Thumbnail -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar Thumbnail</label>
                <div class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg h-48 md:h-64 bg-gray-50 text-gray-500 text-center overflow-hidden"
                    id="imageUploadContainer">
                    <img id="previewImage" src="" alt="Preview"
                        class="hidden absolute inset-0 w-full h-full object-cover z-0" />

                    <div id="uploadPlaceholder" class="z-10 flex flex-col items-center">
                        <i class="fa-solid fa-image text-2xl md:text-3xl text-primary"></i>
                        <label for="imageInput"
                            class="cursor-pointer bg-primary text-white px-3 py-2 mt-3 rounded-lg hover:bg-primary/90 transition-colors text-sm">
                            Pilih Gambar
                        </label>
                        <p class="text-xs mt-2">atau seret foto ke sini</p>
                    </div>

                    <div id="imageActions" class="absolute bottom-3 left-3 z-10 gap-2" style="display: none;">
                        <label for="imageInput"
                            class="inline-block bg-primary text-white px-3 py-1 text-sm rounded hover:bg-primary/90 cursor-pointer mr-2">
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

            <!-- Form Grid -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                <!-- Kategori -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                    <select id="kategori"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Status</option>
                        <option value="draft" {{ isset($blog) && $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ isset($blog) && $blog->status == 'published' ? 'selected' : '' }}>
                            Published</option>
                        <option value="archived" {{ isset($blog) && $blog->status == 'archived' ? 'selected' : '' }}>Archived
                        </option>
                    </select>
                </div>
                <!-- Tag -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Tag</label>
                    <select name="tag" id="tag"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Tag</option>
                        <option value="sejarah" {{ isset($blog) && $blog->tag == 'sejarah' ? 'selected' : '' }}>Sejarah</option>
                        <option value="potensi_desa" {{ isset($blog) && $blog->tag == 'potensi_desa' ? 'selected' : '' }}>Potensi Desa</option>
                        <option value="kabar_warga" {{ isset($blog) && $blog->tag == 'kabar_warga' ? 'selected' : '' }}>Kabar Warga</option>
                        <option value="umkm_lokal" {{ isset($blog) && $blog->tag == 'umkm_lokal' ? 'selected' : '' }}>UMKM Lokal</option>
                    </select>
                </div>
            </div>

            <!-- Judul Berita -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Judul Berita</label>
                <input type="hidden" name="blogId" id="blogId" value="{{ isset($blog) ? $blog->id : '' }}">
                <input id="judul" type="text" placeholder="Masukkan judul berita..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    value="{{ isset($blog) ? $blog->name : '' }}" />
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" rows="4" placeholder="Masukkan deskripsi berita..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-vertical">{{ isset($blog) ? $blog->description : '' }}</textarea>
            </div>

            <!-- Konten Blog -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Konten Blog</label>
                <textarea id="konten" rows="8" placeholder="Tulis konten blog di sini..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-vertical">{{ isset($blog) ? $blog->content : '' }}</textarea>
            </div>

            <!-- Tombol -->
            <div class="flex flex-col md:flex-row gap-3 md:gap-4 pt-6 border-t border-gray-200 mt-6">
                <button id="submitBtn" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition text-sm font-medium w-full md:w-auto">
                    <i class="fas fa-save mr-2"></i>
                    {{ isset($blog) ? 'Update Blog' : 'Simpan Blog' }}
                </button>
                <a href="{{ url('dashboard/blogs') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition text-sm font-medium text-center w-full md:w-auto">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    @if (isset($blog) && $blog->image_url)
        <script>
            $(document).ready(function() {
                const imageUrl = "{{ asset($blog->image_url) }}";
                $('#previewImage').attr('src', imageUrl).removeClass('hidden');
                $('#uploadPlaceholder').addClass('hidden');
                $('#imageActions').removeClass('hidden');
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            const $imageInput = $('#imageInput');
            const $previewImage = $('#previewImage');
            const $uploadPlaceholder = $('#uploadPlaceholder');
            const $imageActions = $('#imageActions');
            const $removeImageBtn = $('#removeImageBtn');

            $imageInput.on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $previewImage.attr('src', e.target.result).removeClass('hidden');
                        $uploadPlaceholder.addClass('hidden');
                        $imageActions.removeClass('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            $removeImageBtn.on('click', function() {
                $imageInput.val('');
                $previewImage.attr('src', '').addClass('hidden');
                $uploadPlaceholder.removeClass('hidden');
                $imageActions.addClass('hidden');
            });

            $('#submitBtn').on('click', function(e) {
                e.preventDefault();

                const formData = new FormData();
                const file = $imageInput[0].files[0];
                const blogId = $('#blogId').val();
                const kategori = $('#kategori').val();
                const tag = $('#tag').val();
                const judul = $('#judul').val();
                const deskripsi = $('#deskripsi').val();

                if (!judul || !deskripsi || !kategori || !file) {
                    alert('Semua field wajib diisi!');
                    return;
                }

                const $button = $('#submitBtn');
                $button.html('<i class="fas fa-spinner fa-spin mr-2"></i>Proses Simpan ...').prop(
                    'disabled', true);

                formData.append('id', blogId);
                formData.append('image', file);
                formData.append('status', kategori);
                formData.append('tag', tag);
                formData.append('name', judul);
                formData.append('description', deskripsi);

                const createUrl = "{{ route('blogs.save') }}";
                const updateUrl = "{{ route('blogs.update') }}";

                $.ajax({
                    url: (blogId == "") ? createUrl : updateUrl,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: '<strong>🎉 Blog berhasil ditambahkan!</strong>',
                                html: `<p style="color:#6b7280; font-size:14px; margin-top:8px;">
                                    Data blog kamu sudah disimpan.<br>
                                    Kamu akan diarahkan ke dashboard blog.
                                </p>`,
                                confirmButtonText: 'Oke, Lihat Dashboard',
                                allowOutsideClick: false,
                                preConfirm: () => window.location.href = '/blogs',
                                customClass: {
                                    popup: 'rounded-xl px-6 py-8',
                                    title: 'text-black text-base font-bold',
                                    confirmButton: 'bg-blue-800 hover:bg-blue-900 text-white text-sm px-6 py-3 rounded-lg focus:outline-none'
                                },
                                buttonsStyling: false,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: `${response.message}`
                            });
                        }
                        $button.html('Simpan').prop('disabled', false);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat mengirim data.');
                        $button.html('Simpan').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
