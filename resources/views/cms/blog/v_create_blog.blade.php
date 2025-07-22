@extends('layouts.app_dashboard')

@section('content')
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow">
        <div class="bg-gray-200 px-4 py-2 border-b">
            <h2 class="font-semibold text-sm text-gray-800">Tambah Berita</h2>
        </div>

        <div class="p-6">
            <!-- Gambar Thumbnail -->
            <label class="block mb-2 font-medium">Gambar Thumbnail</label>
            <div class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md h-64 bg-gray-50 text-gray-500 text-center mb-4 overflow-hidden"
                id="imageUploadContainer">
                <img id="previewImage" src="" alt="Preview"
                    class="hidden absolute inset-0 w-full h-full object-cover z-0" />

                <div id="uploadPlaceholder" class="z-10 flex flex-col items-center">
                    <i class="fa-solid fa-image fa-2xl text-primary"></i>
                    <label for="imageInput"
                        class="cursor-pointer bg-primary text-white px-3 py-1 mt-4 rounded-lg hover:bg-primary-600 transition-colors">
                        Pilih Gambar
                    </label>
                    <p class="text-sm mt-1">atau seret foto ke sini</p>
                </div>

                <div id="imageActions" class="hidden absolute bottom-4 left-4 z-10 flex gap-2">
                    <label for="imageInput"
                        class="bg-primary text-white w-24 px-2 py-1 text-sm rounded hover:bg-primary cursor-pointer">
                        Ganti
                    </label>
                    <button id="removeImageBtn" type="button"
                        class="bg-primary text-white px-2 py-1 text-sm rounded hover:bg-primary">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <input name="image" type="file" id="imageInput" class="hidden" accept="image/*" />
            </div>

            <p class="text-xs text-gray-400 mb-4">Lampirkan gambar. Ukuran file tidak boleh lebih dari 1MB</p>

            <!-- Kategori -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Kategori</label>
                <select id="kategori"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Status</option>
                    <option value="draft" {{ isset($blog) && $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ isset($blog) && $blog->status == 'published' ? 'selected' : '' }}>
                        Published</option>
                    <option value="archived" {{ isset($blog) && $blog->status == 'archived' ? 'selected' : '' }}>Archived
                    </option>
                </select>
            </div>

            <!-- Judul Berita -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Judul Berita</label>
                <input type="hidden" name="blogId" id="blogId" value="{{ isset($blog) ? $blog->id : '' }}">
                <input id="judul" type="text" placeholder="Masukkan judul berita..."
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ isset($blog) ? $blog->name : '' }}" />
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block mb-1 font-medium">Deskripsi Berita</label>
                <textarea id="deskripsi" rows="4" placeholder="Masukkan deskripsi berita..."
                    class="w-full border-2 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ isset($blog) ? $blog->description : '' }}</textarea>
            </div>

            <!-- Tombol -->
            <div class="flex gap-2">
                <button id="submitBtn" class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                    Simpan
                </button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                    Kembali
                </button>
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
