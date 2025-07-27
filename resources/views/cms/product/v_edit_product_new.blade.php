@extends('layouts.app_dashboard')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 mx-2 md:mx-0">
    <div class="p-3 md:p-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Edit Barang</h2>
    </div>

    <div class="p-6">
        <div class="flex flex-col lg:flex-row gap-6">
            {{-- Upload Images --}}
            <div class="lg:w-1/3">
                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar Produk</label>

                <!-- Area Upload Utama -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50 mb-4" id="uploadArea">
                    <div class="relative">
                        <!-- Icon dan Tombol Upload -->
                        <div id="uploadPlaceholder" class="flex flex-col items-center py-8">
                            <div class="w-16 h-16 bg-[#1B3A6D] rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <button type="button" onclick="document.getElementById('imageInput').click()" 
                                class="bg-[#1B3A6D] text-white px-6 py-2 rounded-lg hover:bg-[#1B3A6D]/90 transition-colors mb-2">
                                Pilih Gambar
                            </button>
                            <p class="text-sm text-gray-600 mb-1">atau seret foto ke sini</p>
                            <p class="text-xs text-gray-500">(Maksimal 10 foto)</p>
                        </div>

                        <!-- Preview Image Utama -->
                        <div id="mainPreview" class="hidden">
                            <img id="previewImage" src="" alt="Preview" class="w-full h-64 object-contain rounded-lg bg-gray-100">
                            <div class="absolute top-2 right-2">
                                <button type="button" id="removeMainBtn" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="imageInput" class="hidden" accept="image/*" multiple>
                </div>

                <p class="text-xs text-gray-500 mb-4">Tip: Geser urutan foto untuk mengubah foto sampul.</p>

                <!-- Grid Thumbnail dengan Drag & Drop -->
                <div id="thumbnailGrid" class="grid grid-cols-3 gap-2"></div>
            </div>

            {{-- Form Input --}}
            <div class="lg:w-2/3 space-y-4">
                <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">
                
                <!-- Nama Barang -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Barang</label>
                    <input id="nama" type="text" placeholder="Masukkan nama barang..."
                        value="{{ old('name', $product->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Harga Barang -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Harga Barang</label>
                    <input id="harga" type="number" placeholder="Masukkan harga barang..."
                        value="{{ old('price', $product->price) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Nama Penjual -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Penjual</label>
                    <input id="seller_name" type="text" placeholder="Masukkan nama penjual..."
                        value="{{ old('seller_name', $product->seller_name) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Nomor WhatsApp -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                    <input id="contact_person" type="text" placeholder="08xxxx..."
                        value="{{ old('contact_person', $product->contact_person) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Deskripsi Barang</label>
                    <textarea id="deskripsi" rows="4" placeholder="Masukkan deskripsi..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] resize-vertical">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Status -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                    <select id="status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]">
                        <option value="ready" {{ $product->status == 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="habis" {{ $product->status == 'habis' ? 'selected' : '' }}>Habis</option>
                        <option value="preorder" {{ $product->status == 'preorder' ? 'selected' : '' }}>Pre-Order</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex flex-col md:flex-row gap-3 md:gap-4 pt-6 border-t border-gray-200 mt-6">
                    <button id="submitBarangBtn"
                        class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition text-sm font-medium w-full md:w-auto">
                        <i class="fas fa-save mr-2"></i>
                        Update Barang
                    </button>
                    <a href="{{ url('dashboard/products') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition text-sm font-medium text-center w-full md:w-auto">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<style>
  .sortable-ghost {
    opacity: 0.4;
  }
  
  .sortable-chosen {
    transform: scale(1.02);
  }
  
  .upload-area-dragover {
    border-color: #3b82f6 !important;
    background-color: #eff6ff !important;
  }
</style>
<script>
  const isEdit = true;
  const existingImages = @json($product->images->sortBy('order')->values()->toArray());
  
  const imageInput = document.getElementById("imageInput");
  const previewImage = document.getElementById("previewImage");
  const uploadPlaceholder = document.getElementById("uploadPlaceholder");
  const mainPreview = document.getElementById("mainPreview");
  const thumbnailGrid = document.getElementById("thumbnailGrid");
  const uploadArea = document.getElementById("uploadArea");

  let imageFiles = [];
  let imageOrder = [];
  let deletedImageIds = [];

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
    const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
    if (files.length > 0) {
      addFiles(files);
    }
  });

  imageInput.addEventListener("change", (e) => {
    const files = Array.from(e.target.files);
    addFiles(files);
  });

  function addFiles(files) {
    const totalImages = imageFiles.length + existingImages.filter(img => !deletedImageIds.includes(img.id)).length;
    
    if (totalImages + files.length > 10) {
      Swal.fire({
        icon: 'warning',
        title: 'Terlalu Banyak Gambar',
        text: 'Maksimal 10 foto yang dapat diunggah!',
        customClass: {
          confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
        },
        buttonsStyling: false
      });
      return;
    }

    files.forEach(file => {
      if (file.size > 1024 * 1024) { // 1MB
        Swal.fire({
          icon: 'warning',
          title: 'File Terlalu Besar',
          text: `File ${file.name} melebihi 1MB!`,
          customClass: {
            confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
          },
          buttonsStyling: false
        });
        return;
      }
      
      imageFiles.push(file);
      imageOrder.push(imageFiles.length - 1);
    });

    updateThumbnailGrid();
    if (getVisibleImages().length > 0 && mainPreview.classList.contains('hidden')) {
      showMainPreview(0);
    }
  }

  function getVisibleImages() {
    const visibleExisting = existingImages.filter(img => !deletedImageIds.includes(img.id));
    return [...visibleExisting, ...imageFiles];
  }

  function updateThumbnailGrid() {
    thumbnailGrid.innerHTML = '';
    
    const visibleImages = getVisibleImages();
    
    if (visibleImages.length === 0) {
      uploadPlaceholder.classList.remove('hidden');
      mainPreview.classList.add('hidden');
      return;
    }

    uploadPlaceholder.classList.add('hidden');

    // Display existing images first
    existingImages.forEach((image, index) => {
      if (deletedImageIds.includes(image.id)) return;
      
      const wrapper = document.createElement('div');
      wrapper.className = 'relative group cursor-pointer border-2 border-transparent hover:border-blue-500 rounded-lg transition-colors';
      wrapper.setAttribute('data-type', 'existing');
      wrapper.setAttribute('data-id', image.id);
      wrapper.setAttribute('data-index', index);
      
      // Cover badge untuk gambar pertama yang visible
      if (index === 0 && deletedImageIds.length === 0) {
        const coverBadge = document.createElement('div');
        coverBadge.className = 'absolute -top-2 -left-2 bg-gray-800 text-white text-xs px-2 py-1 rounded z-10';
        coverBadge.textContent = 'Cover';
        wrapper.appendChild(coverBadge);
      }

      const img = document.createElement('img');
      img.src = `{{ asset('storage/') }}/${image.image_path}`;
      img.className = 'w-full h-20 object-cover rounded-lg';
      img.addEventListener('click', () => showMainPreviewExisting(image));

      const deleteBtn = document.createElement('button');
      deleteBtn.type = 'button';
      deleteBtn.className = 'absolute top-1 right-1 bg-white text-red-500 rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-50';
      deleteBtn.innerHTML = `
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      `;
      deleteBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        deleteExistingImage(image.id);
      });

      wrapper.appendChild(img);
      wrapper.appendChild(deleteBtn);
      thumbnailGrid.appendChild(wrapper);
    });

    // Display new images
    imageOrder.forEach((fileIndex, position) => {
      const file = imageFiles[fileIndex];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'relative group cursor-pointer border-2 border-transparent hover:border-blue-500 rounded-lg transition-colors';
        wrapper.setAttribute('data-type', 'new');
        wrapper.setAttribute('data-index', fileIndex);
        
        // Cover badge untuk gambar baru pertama jika tidak ada existing images
        const visibleExistingCount = existingImages.filter(img => !deletedImageIds.includes(img.id)).length;
        if (position === 0 && visibleExistingCount === 0) {
          const coverBadge = document.createElement('div');
          coverBadge.className = 'absolute -top-2 -left-2 bg-gray-800 text-white text-xs px-2 py-1 rounded z-10';
          coverBadge.textContent = 'Cover';
          wrapper.appendChild(coverBadge);
        }

        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-full h-20 object-cover rounded-lg';
        img.addEventListener('click', () => showMainPreview(fileIndex));

        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'absolute top-1 right-1 bg-white text-red-500 rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-50';
        deleteBtn.innerHTML = `
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        `;
        deleteBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          removeImage(fileIndex);
        });

        wrapper.appendChild(img);
        wrapper.appendChild(deleteBtn);
        thumbnailGrid.appendChild(wrapper);
      };
      reader.readAsDataURL(file);
    });

    // Initialize Sortable for drag and drop reordering
    if (thumbnailGrid.children.length > 0) {
      new Sortable(thumbnailGrid, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        onEnd: function(evt) {
          // Handle reordering logic here if needed
          console.log('Images reordered');
        }
      });
    }
  }

  function showMainPreview(fileIndex) {
    const file = imageFiles[fileIndex];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.src = e.target.result;
      mainPreview.classList.remove('hidden');
      uploadPlaceholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
  }

  function showMainPreviewExisting(image) {
    previewImage.src = `{{ asset('storage/') }}/${image.image_path}`;
    mainPreview.classList.remove('hidden');
    uploadPlaceholder.classList.add('hidden');
  }

  function removeImage(fileIndex) {
    // Remove from imageFiles array
    imageFiles.splice(fileIndex, 1);
    
    // Update imageOrder array - adjust indices and remove deleted one
    imageOrder = imageOrder
      .map(index => index > fileIndex ? index - 1 : index)
      .filter(index => index !== fileIndex);

    updateThumbnailGrid();
    
    const visibleImages = getVisibleImages();
    if (visibleImages.length > 0) {
      if (visibleImages[0].id) {
        showMainPreviewExisting(visibleImages[0]);
      } else {
        showMainPreview(0);
      }
    } else {
      mainPreview.classList.add('hidden');
      uploadPlaceholder.classList.remove('hidden');
    }
  }

  function deleteExistingImage(imageId) {
    deletedImageIds.push(imageId);
    updateThumbnailGrid();
    
    const visibleImages = getVisibleImages();
    if (visibleImages.length > 0) {
      if (visibleImages[0].id) {
        showMainPreviewExisting(visibleImages[0]);
      } else {
        showMainPreview(0);
      }
    } else {
      mainPreview.classList.add('hidden');
      uploadPlaceholder.classList.remove('hidden');
    }
  }

  // Remove main preview button
  document.getElementById('removeMainBtn').addEventListener('click', () => {
    const visibleImages = getVisibleImages();
    if (visibleImages.length > 0) {
      if (visibleImages[0].id) {
        deleteExistingImage(visibleImages[0].id);
      } else {
        removeImage(0);
      }
    }
  });

  // Initialize existing images display on page load
  document.addEventListener('DOMContentLoaded', function() {
    if (existingImages.length > 0) {
      updateThumbnailGrid();
      showMainPreviewExisting(existingImages[0]);
    }
  });

  document.getElementById("submitBarangBtn").addEventListener("click", async function () {
    // Validasi form
    const nama = document.getElementById("nama").value.trim();
    const harga = document.getElementById("harga").value.trim();
    const sellerName = document.getElementById("seller_name").value.trim();
    const contactPerson = document.getElementById("contact_person").value.trim();
    const deskripsi = document.getElementById("deskripsi").value.trim();
    const status = document.getElementById("status").value;

    if (!nama || !harga || !sellerName || !contactPerson || !deskripsi || !status) {
        Swal.fire({
            icon: 'warning',
            title: 'Lengkapi Form',
            text: 'Harap isi semua field yang diperlukan!',
            customClass: {
                confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
            },
            buttonsStyling: false
        });
        return;
    }

    if (isNaN(harga) || parseFloat(harga) < 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Harga Tidak Valid',
            text: 'Harap masukkan harga yang valid!',
            customClass: {
                confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
            },
            buttonsStyling: false
        });
        return;
    }

    const formData = new FormData();

    // Ambil nilai dari input
    formData.append("name", nama);
    formData.append("price", harga);
    formData.append("seller_name", sellerName);
    formData.append("contact_person", contactPerson);
    formData.append("description", deskripsi);
    formData.append("status", status);
    formData.append("id", document.getElementById('productId').value);

    // Add new images in the correct order
    imageOrder.forEach((fileIndex, position) => {
      const file = imageFiles[fileIndex];
      if (file) {
        formData.append("images[]", file);
        formData.append("image_orders[]", position);
      }
    });

    // Add deleted image IDs
    deletedImageIds.forEach(imageId => {
      formData.append("delete_images[]", imageId);
    });

    // Show loading state
    const button = document.getElementById("submitBarangBtn");
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
    button.disabled = true;

    try {
        const response = await fetch("{{ url('dashboard/products/update') }}", {
            method: "POST",
            headers: {
                "Accept":"application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: formData
        });

        if (response.ok) {
            const result = await response.json();
            Swal.fire({
                title: 'Berhasil!',
                text: 'Produk telah diperbarui.',
                icon: 'success',
                customClass: {
                    confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
                },
                buttonsStyling: false
            }).then(() => {
                window.location.href = "{{ url('dashboard/products') }}";
            });
        } else {
            const errorData = await response.json();
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: errorData.message || 'Terjadi kesalahan saat memperbarui produk.',
                customClass: {
                    confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
                },
                buttonsStyling: false
            });
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Terjadi kesalahan saat mengirim data: ' + error.message,
            customClass: {
                confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
            },
            buttonsStyling: false
        });
    } finally {
        // Restore button
        button.innerHTML = originalText;
        button.disabled = false;
    }
  });
</script>
@endsection
