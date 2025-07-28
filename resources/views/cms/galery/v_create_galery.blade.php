@extends('layouts.app_dashboard')

@section('content')
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                <i class="fas fa-images text-[#1B3A6D] text-sm"></i>
            </div>
            <div>
                <h1 class="text-xl font-semibold text-gray-900">
                    {{ isset($photo) ? 'Edit Galeri' : 'Tambah Galeri Baru' }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ isset($photo) ? 'Perbarui informasi dan gambar galeri' : 'Unggah gambar baru ke galeri desa' }}
                </p>
            </div>
        </div>
        <a href="{{ route('gallery.index') }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <form action="{{ isset($photo) ? route('gallery.update', $photo->id) : route('gallery.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if (isset($photo))
            @method('PUT')
        @endif

        <!-- Error/Success Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Upload Image Section --}}
            <div>
                <!-- Section Header -->
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-6 h-6 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-camera text-[#1B3A6D] text-xs"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900">Pilih Gambar</h3>
                </div>

                <!-- Upload Area -->
                <div class="relative border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 hover:border-[#1B3A6D] hover:bg-blue-50/30 transition-all group" 
                     id="uploadArea" style="aspect-ratio: 4/3;">
                    
                    <!-- Preview Image -->
                    @if(isset($photo) && $photo->image_path)
                        <img id="previewImage" 
                             src="{{ asset('storage/' . $photo->image_path) }}" 
                             alt="Preview" 
                             class="absolute inset-0 w-full h-full object-cover" />
                        <div id="uploadPlaceholder" class="hidden absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                    @else
                        <img id="previewImage" 
                             src="" 
                             alt="Preview" 
                             class="hidden absolute inset-0 w-full h-full object-cover" />
                        <div id="uploadPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                    @endif
                        <div class="w-16 h-16 bg-[#1B3A6D] rounded-lg flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fas fa-images text-white text-2xl"></i>
                        </div>
                        <button type="button" onclick="document.getElementById('imageInput').click()" 
                            class="bg-[#1B3A6D] text-white px-6 py-3 rounded-lg hover:bg-[#152f5a] transition-colors mb-3 text-sm font-medium shadow-sm">
                            <i class="fas fa-plus mr-2"></i>Pilih Gambar
                        </button>
                        <p class="text-sm text-gray-600 mb-1">atau seret foto ke sini</p>
                        <p class="text-xs text-gray-500">Format: JPG, PNG, GIF (Max: 5MB)</p>
                    </div>

                    <!-- Change Image Overlay -->
                    <div id="changeImageOverlay" class="hidden absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity cursor-pointer"
                         onclick="document.getElementById('imageInput').click()">
                        <div class="bg-white rounded-lg px-4 py-2 shadow-lg">
                            <i class="fas fa-camera mr-2 text-[#1B3A6D]"></i>
                            <span class="text-sm font-medium text-gray-800">Ganti Gambar</span>
                        </div>
                    </div>

                    <input type="file" id="imageInput" name="image" class="hidden" accept="image/*" />
                </div>

                <!-- Upload Info -->
                <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start space-x-2">
                        <div class="w-4 h-4 bg-blue-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                            <i class="fas fa-info text-white text-xs"></i>
                        </div>
                        <div class="text-xs text-blue-700">
                            <p class="font-medium mb-1">Tips Upload Gambar:</p>
                            <ul class="space-y-1">
                                <li>• Gunakan gambar berkualitas tinggi</li>
                                <li>• Ukuran file maksimal 5MB</li>
                                <li>• Format yang didukung: JPG, PNG, GIF</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Input Section --}}
            <div>
                <!-- Section Header -->
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-6 h-6 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-edit text-[#1B3A6D] text-xs"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900">Informasi Gambar</h3>
                </div>

                <div class="space-y-6">
                    <!-- Judul Gambar -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-heading mr-1 text-gray-400"></i>
                            Judul Gambar
                        </label>
                        <input id="judul" name="photo_name" type="text" 
                               placeholder="Masukkan judul gambar..."
                               value="{{ isset($photo) ? $photo->photo_name : old('photo_name') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors" />
                    </div>

                    <!-- Deskripsi Gambar -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-align-left mr-1 text-gray-400"></i>
                            Deskripsi Gambar
                        </label>
                        <textarea id="deskripsi" name="photo_description" rows="4" 
                                  placeholder="Masukkan deskripsi gambar..."
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors resize-vertical">{{ isset($photo) ? $photo->photo_description : old('photo_description') }}</textarea>
                    </div>

                    <!-- Kategori Gambar -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-tags mr-1 text-gray-400"></i>
                            Kategori Gambar
                        </label>
                        <select name="category" id="category"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors">
                            <option value="">Pilih Kategori</option>
                            <option value="umum" {{ (isset($photo) && $photo->category == 'umum') || old('category') == 'umum' ? 'selected' : '' }}>Umum</option>
                            <option value="pemandangan_alam" {{ (isset($photo) && $photo->category == 'pemandangan_alam') || old('category') == 'pemandangan_alam' ? 'selected' : '' }}>Pemandangan Alam</option>
                            <option value="kegiatan_warga" {{ (isset($photo) && $photo->category == 'kegiatan_warga') || old('category') == 'kegiatan_warga' ? 'selected' : '' }}>Kegiatan Warga</option>
                            <option value="umkm_lokal" {{ (isset($photo) && $photo->category == 'umkm_lokal') || old('category') == 'umkm_lokal' ? 'selected' : '' }}>UMKM Lokal</option>
                            <option value="infrastruktur" {{ (isset($photo) && $photo->category == 'infrastruktur') || old('category') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="acara_desa" {{ (isset($photo) && $photo->category == 'acara_desa') || old('category') == 'acara_desa' ? 'selected' : '' }}>Acara Desa</option>
                        </select>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex flex-col md:flex-row gap-3 pt-6 border-t border-gray-100">
                        <button type="submit" id="submitBtn"
                            class="flex items-center justify-center bg-[#1B3A6D] text-white px-6 py-3 rounded-lg hover:bg-[#152f5a] transition-colors text-sm font-medium shadow-sm">
                            <i class="fas fa-save mr-2"></i>
                            {{ isset($photo) ? 'Update Galeri' : 'Upload' }}
                        </button>
                        <a href="{{ route('gallery.index') }}"
                            class="flex items-center justify-center bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                            <i class="fas fa-times mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('addon-script')
<style>
  /* Enhanced upload area styling */
  .upload-area-dragover {
    border-color: #1B3A6D !important;
    background-color: rgba(27, 58, 109, 0.05) !important;
    transform: scale(1.01);
  }

  /* Enhanced focus states */
  input:focus, textarea:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(27, 58, 109, 0.1);
  }

  /* Loading animation */
  .loading-spinner {
    @apply animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full;
  }

  /* Enhanced animations */
  @keyframes slideInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-slide-in {
    animation: slideInUp 0.3s ease-out;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const changeImageOverlay = document.getElementById('changeImageOverlay');
    const uploadArea = document.getElementById('uploadArea');
    const submitBtn = document.getElementById('submitBtn');

    // Initialize drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('upload-area-dragover');
    });

    uploadArea.addEventListener('dragleave', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('upload-area-dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('upload-area-dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            handleImageUpload(files[0]);
        }
    });

    // Handle file input change
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            handleImageUpload(file);
        }
    });

    function handleImageUpload(file) {
        // Validate file size (5MB = 5 * 1024 * 1024 bytes)
        if (file.size > 5 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File Terlalu Besar',
                text: 'Ukuran file tidak boleh lebih dari 5MB!',
                customClass: {
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                },
                buttonsStyling: false
            });
            return;
        }

        // Validate file type
        if (!file.type.startsWith('image/')) {
            Swal.fire({
                icon: 'error',
                title: 'Format File Tidak Valid',
                text: 'Harap pilih file gambar (JPG, PNG, GIF)!',
                customClass: {
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                },
                buttonsStyling: false
            });
            return;
        }

        // Create FileReader to preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove('hidden');
            uploadPlaceholder.classList.add('hidden');
            changeImageOverlay.classList.remove('hidden');
            
            // Add animation
            previewImage.classList.add('animate-slide-in');
        };
        reader.readAsDataURL(file);
    }

    // Form validation and submission
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Get form values
        const judul = document.getElementById('judul').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();
        const category = document.getElementById('category').value;
        const hasImage = !previewImage.classList.contains('hidden') || imageInput.files.length > 0;

        // Validate required fields
        if (!judul) {
            Swal.fire({
                icon: 'warning',
                title: 'Judul Diperlukan',
                text: 'Harap masukkan judul gambar!',
                customClass: {
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                },
                buttonsStyling: false
            });
            document.getElementById('judul').focus();
            return;
        }

        if (!deskripsi) {
            Swal.fire({
                icon: 'warning',
                title: 'Deskripsi Diperlukan',
                text: 'Harap masukkan deskripsi gambar!',
                customClass: {
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                },
                buttonsStyling: false
            });
            document.getElementById('deskripsi').focus();
            return;
        }

        if (!category) {
            Swal.fire({
                icon: 'warning',
                title: 'Kategori Diperlukan',
                text: 'Harap pilih kategori gambar!',
                customClass: {
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                },
                buttonsStyling: false
            });
            document.getElementById('category').focus();
            return;
        }

        @if(!isset($photo))
        if (!hasImage) {
            Swal.fire({
                icon: 'warning',
                title: 'Gambar Diperlukan',
                text: 'Harap pilih gambar untuk diunggah!',
                customClass: {
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                },
                buttonsStyling: false
            });
            return;
        }
        @endif

        // Show loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<div class="loading-spinner mr-2"></div>{{ isset($photo) ? "Memperbarui..." : "Mengunggah..." }}';
        submitBtn.disabled = true;

        // Submit form
        setTimeout(() => {
            submitBtn.closest('form').submit();
        }, 500);
    });

    // Show success message with nice animation
    @if(session('success'))
        setTimeout(() => {
            showToast('{{ session("success") }}', 'success');
        }, 100);
    @endif
});

function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : 
                   type === 'error' ? 'bg-red-500' : 
                   type === 'warning' ? 'bg-orange-500' : 'bg-[#1B3A6D]';
                   
    toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg text-white text-sm font-medium shadow-lg transform transition-all duration-300 ${bgColor}`;
    toast.innerHTML = `
        <div class="flex items-center space-x-3">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-times-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
        toast.style.opacity = '1';
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}
</script>
@endpush
            const file = e.target.files[0];
            if (file) {
                // Check file size (5MB = 5 * 1024 * 1024 bytes)
                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file tidak boleh lebih dari 5MB!',
                        customClass: {
                            confirmButton: 'bg-[#1B3A6D] hover:bg-[#1B3A6D]/90 text-white px-6 py-2 rounded-lg'
                        },
                        buttonsStyling: false
                    });
                    e.target.value = ''; // Clear the input
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewImage.classList.add('block');
                    uploadPlaceholder.classList.add('hidden');
                    changeImageBtn.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewImage.classList.add('hidden');
                uploadPlaceholder.classList.remove('hidden');
                changeImageBtn.classList.add('hidden');
            }
        });

        // Submit form dengan AJAX
        $('#submitBtn').on('click', function(e) {
            e.preventDefault();

            const formData = new FormData();
            const file = $('#imageInput')[0].files[0];
            const photoName = $('input[name="photo_name"]').val();
            const photoDescription = $('textarea[name="photo_description"]').val();
            const category = $('select[name="category"]').val();
            const isEdit = {{ isset($photo) ? 'true' : 'false' }};

            // Validasi
            if (!photoName || !category) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama foto dan kategori wajib diisi!'
                });
                return;
            }

            if (!isEdit && !file) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gambar wajib dipilih!'
                });
                return;
            }

            // Disable button dan tampilkan loading
            const $button = $(this);
            $button.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...').prop('disabled', true);

            // Append data ke FormData
            formData.append('photo_name', photoName);
            formData.append('photo_description', photoDescription);
            formData.append('category', category);
            if (file) {
                formData.append('image', file);
            }

            const url = isEdit ? '{{ isset($photo) ? route("gallery.update", $photo->id) : "" }}' : '{{ route("gallery.store") }}';
            const method = isEdit ? 'POST' : 'POST';
            
            if (isEdit) {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                method: method,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        if (isEdit) {
                            // SweetAlert untuk update
                            Swal.fire({
                                title: '<strong>🎉 Berhasil Diperbarui!</strong>',
                                html: `<p style="color:#6b7280; font-size:14px; margin-top:8px;">
                                    Data produk kamu sudah berhasil disimpan.<br>
                                    Terima kasih telah memperbarui katalog.
                                </p>`,
                                confirmButtonText: 'Kembali ke Dashboard',
                                allowOutsideClick: false,
                                customClass: {
                                    popup: 'rounded-xl px-6 py-8',
                                    title: 'text-black text-base font-bold',
                                    confirmButton: 'bg-blue-800 hover:bg-blue-900 text-white text-sm px-6 py-3 rounded-lg focus:outline-none'
                                },
                                buttonsStyling: false,
                            }).then(() => {
                                window.location.href = '{{ route("gallery.index") }}';
                            });
                        } else {
                            // SweetAlert untuk create
                            Swal.fire({
                                title: '<strong>🎉 Katalog berhasil ditambahkan!</strong>',
                                html: `<p style="color:#6b7280; font-size:14px; margin-top:8px;">
                                    Data Katalog kamu sudah disimpan dengan sukses.<br>
                                    Kamu akan diarahkan ke dashboard Katalog untuk melihat daftar lengkap.
                                </p>`,
                                confirmButtonText: 'Oke, Lihat Dashboard',
                                allowOutsideClick: false,
                                customClass: {
                                    popup: 'rounded-xl px-6 py-8',
                                    title: 'text-black text-base font-bold',
                                    confirmButton: 'bg-blue-800 hover:bg-blue-900 text-white text-sm px-6 py-3 rounded-lg focus:outline-none'
                                },
                                buttonsStyling: false,
                            }).then(() => {
                                window.location.href = '{{ route("gallery.index") }}';
                            });
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Terjadi kesalahan!'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan saat memproses data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage
                    });
                },
                complete: function() {
                    // Reset button
                    $button.html('<i class="fas fa-save mr-2"></i>{{ isset($photo) ? "Update Galeri" : "Simpan Galeri" }}').prop('disabled', false);
                }
            });
        });
    });
</script>
@endpush