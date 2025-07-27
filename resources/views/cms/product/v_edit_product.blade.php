@extends('layouts.app_dashboard')

@section('content')
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                <i class="fas fa-edit text-[#1B3A6D] text-sm"></i>
            </div>
            <div>
                <h1 class="text-xl font-semibold text-gray-900">Edit Produk</h1>
                <p class="text-sm text-gray-500">Perbarui informasi dan gambar produk</p>
            </div>
        </div>
        <a href="{{ url('dashboard/products') }}" 
           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Upload Images Section --}}
            <div class="lg:col-span-1">
                <!-- Section Header -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-images text-[#1B3A6D] text-xs"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900">Gambar Produk</h3>
                    </div>
                    <span id="imageCounter" class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md font-medium">0/10 foto</span>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                    <div class="flex items-start space-x-2">
                        <div class="w-4 h-4 bg-blue-500 rounded-full flex items-center justify-center mt-0.5 flex-shrink-0">
                            <i class="fas fa-info text-white text-xs"></i>
                        </div>
                        <div class="text-xs text-blue-700">
                            <p class="font-medium mb-1">Tips Upload Gambar:</p>
                            <ul class="space-y-1 text-xs">
                                <li>• Pilih multiple gambar sekaligus</li>
                                <li>• Geser untuk mengubah urutan</li>
                                <li>• Gambar pertama = foto sampul</li>
                                <li>• Maksimal 10 foto, masing-masing 1MB</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Area Upload Utama -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 mb-4 transition-all hover:border-[#1B3A6D] hover:bg-blue-50/50" id="uploadArea">
                    <div class="relative">
                        <!-- Icon dan Tombol Upload -->
                        <div id="uploadPlaceholder" class="flex flex-col items-center py-6">
                            <div class="w-12 h-12 bg-[#1B3A6D] rounded-lg flex items-center justify-center mb-3 shadow-sm">
                                <i class="fas fa-images text-white text-lg"></i>
                            </div>
                            <button type="button" onclick="document.getElementById('imageInput').click()" 
                                class="bg-[#1B3A6D] text-white px-4 py-2.5 rounded-lg hover:bg-[#152f5a] transition-colors mb-2 text-sm font-medium shadow-sm">
                                <i class="fas fa-plus mr-2"></i>Tambah Gambar
                            </button>
                            <p class="text-xs text-gray-600 mb-1">atau seret foto ke sini</p>
                            <p class="text-xs text-gray-500">Bisa pilih banyak sekaligus</p>
                        </div>

                        <!-- Preview Image Utama -->
                        <div id="mainPreview" class="hidden">
                            <img id="previewImage" src="" alt="Preview" class="w-full h-48 object-contain rounded-lg bg-gray-100 border">
                            <div class="absolute top-2 right-2">
                                <button type="button" id="removeMainBtn" class="bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition-colors shadow-lg">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded backdrop-blur-sm">
                                <i class="fas fa-crown mr-1"></i>
                                <span id="mainImageLabel">Foto Sampul</span>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="imageInput" class="hidden" accept="image/*" multiple>
                </div>
                <!-- Tombol Tambah Gambar Lagi -->
                <div id="addMoreImagesBtn" class="hidden mb-4">
                    <button type="button" onclick="document.getElementById('imageInput').click()" 
                        class="w-full border-2 border-dashed border-gray-300 rounded-lg py-3 text-center hover:border-[#1B3A6D] hover:bg-blue-50/30 transition-all group">
                        <i class="fas fa-plus text-[#1B3A6D] mr-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-sm text-gray-600 font-medium">Tambah Gambar Lagi</span>
                    </button>
                </div>

                <!-- Grid Thumbnail dengan Drag & Drop -->
                <div id="thumbnailContainer" class="hidden">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-grip-vertical text-gray-400 mr-2"></i>
                            Semua Foto
                        </p>
                        <p class="text-xs text-gray-500">Geser untuk ubah urutan</p>
                    </div>
                    <div id="thumbnailGrid" class="grid grid-cols-3 gap-2 p-3 bg-gray-50 rounded-lg border border-gray-200"></div>
                </div>
            </div>

            {{-- Form Input --}}
            <div class="lg:col-span-2">
                <!-- Form Header -->
                <div class="flex items-center space-x-2 mb-6">
                    <div class="w-6 h-6 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-form text-[#1B3A6D] text-xs"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900">Informasi Produk</h3>
                </div>

                <div class="space-y-6">
                    <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">
                    
                    <!-- Nama Barang -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-tag mr-1 text-gray-400"></i>
                            Nama Produk
                        </label>
                        <input id="nama" type="text" placeholder="Masukkan nama produk..."
                            value="{{ old('name', $product->name) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors" />
                    </div>

                    <!-- Harga Barang -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-money-bill-wave mr-1 text-gray-400"></i>
                            Harga Produk
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                            <input id="harga" type="number" placeholder="0"
                                value="{{ old('price', $product->price) }}"
                                class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors" />
                        </div>
                    </div>

                    <!-- Nama Penjual -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-user mr-1 text-gray-400"></i>
                            Nama Penjual
                        </label>
                        <input id="seller_name" type="text" placeholder="Masukkan nama penjual..."
                            value="{{ old('seller_name', $product->seller_name) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors" />
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fab fa-whatsapp mr-1 text-gray-400"></i>
                            Nomor WhatsApp
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">+62</span>
                            <input id="contact_person" type="text" placeholder="8xxxx..."
                                value="{{ old('contact_person', $product->contact_person) }}"
                                class="w-full border border-gray-300 rounded-lg pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors" />
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-align-left mr-1 text-gray-400"></i>
                            Deskripsi Produk
                        </label>
                        <textarea id="deskripsi" rows="4" placeholder="Masukkan deskripsi produk..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors resize-vertical">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-toggle-on mr-1 text-gray-400"></i>
                            Status Produk
                        </label>
                        <select id="status"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors">
                            <option value="ready" {{ $product->status == 'ready' ? 'selected' : '' }}>
                                <i class="fas fa-check-circle mr-2"></i>Ready
                            </option>
                            <option value="habis" {{ $product->status == 'habis' ? 'selected' : '' }}>
                                <i class="fas fa-times-circle mr-2"></i>Habis
                            </option>
                            <option value="preorder" {{ $product->status == 'preorder' ? 'selected' : '' }}>
                                <i class="fas fa-clock mr-2"></i>Pre-Order
                            </option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex flex-col md:flex-row gap-3 pt-6 border-t border-gray-100">
                        <button id="submitBarangBtn"
                            class="flex items-center justify-center bg-[#1B3A6D] text-white px-6 py-3 rounded-lg hover:bg-[#152f5a] transition-colors text-sm font-medium shadow-sm">
                            <i class="fas fa-save mr-2"></i>
                            Update Produk
                        </button>
                        <a href="{{ url('dashboard/products') }}"
                            class="flex items-center justify-center bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<style>
  /* Dashboard-consistent styling */
  .sortable-ghost {
    opacity: 0.4;
    transform: scale(0.95);
  }
  
  .sortable-chosen {
    transform: scale(1.02);
    z-index: 999;
    box-shadow: 0 8px 25px rgba(27, 58, 109, 0.15);
  }
  
  .sortable-drag {
    transform: rotate(2deg);
  }
  
  .upload-area-dragover {
    border-color: #1B3A6D !important;
    background-color: rgba(27, 58, 109, 0.05) !important;
    transform: scale(1.01);
  }

  /* Thumbnail hover effects */
  #thumbnailGrid .group:hover {
    box-shadow: 0 4px 12px rgba(27, 58, 109, 0.15);
    transform: translateY(-1px);
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

  /* Enhanced focus states */
  input:focus, textarea:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(27, 58, 109, 0.1);
  }

  /* Custom badge styles */
  .status-badge {
    @apply inline-flex items-center px-2 py-1 rounded-full text-xs font-medium;
  }
  
  .status-ready {
    @apply bg-green-100 text-green-800;
  }
  
  .status-habis {
    @apply bg-red-100 text-red-800;
  }
  
  .status-preorder {
    @apply bg-yellow-100 text-yellow-800;
  }

  /* Enhanced button styles */
  .btn-primary {
    @apply bg-[#1B3A6D] text-white hover:bg-[#152f5a] focus:ring-2 focus:ring-[#1B3A6D] focus:ring-opacity-50;
  }
  
  .btn-secondary {
    @apply bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-2 focus:ring-gray-300;
  }

  /* Loading animation */
  .loading-spinner {
    @apply animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full;
  }

  /* Enhanced thumbnails */
  .thumbnail-wrapper {
    @apply relative group cursor-pointer border-2 border-transparent hover:border-[#1B3A6D] rounded-lg transition-all duration-200;
  }
  
  .thumbnail-wrapper:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 58, 109, 0.15);
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
    
    // Enhanced visual feedback with dashboard colors
    const placeholder = uploadArea.querySelector('#uploadPlaceholder');
    if (placeholder && !placeholder.classList.contains('hidden')) {
      placeholder.innerHTML = `
        <div class="w-12 h-12 bg-[#1B3A6D] rounded-lg flex items-center justify-center mb-3 animate-pulse shadow-lg">
          <i class="fas fa-cloud-upload-alt text-white text-lg"></i>
        </div>
        <p class="text-sm font-medium text-[#1B3A6D]">Lepas file di sini untuk mengunggah</p>
        <p class="text-xs text-gray-500">Mendukung multiple file sekaligus</p>
      `;
    }
  });

  uploadArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('upload-area-dragover');
    
    // Restore original placeholder with dashboard styling
    const placeholder = uploadArea.querySelector('#uploadPlaceholder');
    if (placeholder && !placeholder.classList.contains('hidden')) {
      placeholder.innerHTML = `
        <div class="w-12 h-12 bg-[#1B3A6D] rounded-lg flex items-center justify-center mb-3 shadow-sm">
          <i class="fas fa-images text-white text-lg"></i>
        </div>
        <button type="button" onclick="document.getElementById('imageInput').click()" 
            class="bg-[#1B3A6D] text-white px-4 py-2.5 rounded-lg hover:bg-[#152f5a] transition-colors mb-2 text-sm font-medium shadow-sm">
            <i class="fas fa-plus mr-2"></i>Tambah Gambar
        </button>
        <p class="text-xs text-gray-600 mb-1">atau seret foto ke sini</p>
        <p class="text-xs text-gray-500">Bisa pilih banyak sekaligus</p>
      `;
    }
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
          confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
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
            confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
          },
          buttonsStyling: false
        });
        return;
      }
      
      imageFiles.push(file);
      imageOrder.push(imageFiles.length - 1);
    });

    updateImageDisplay();
    
    // Show success message for multiple files
    if (files.length > 1) {
      showToast(`${files.length} foto berhasil ditambahkan!`, 'success');
    }
  }

  function updateImageDisplay() {
    updateImageCounter();
    updateThumbnailGrid();
    updateMainPreview();
    toggleUIElements();
  }

  function updateImageCounter() {
    const totalImages = getVisibleImages().length;
    const counter = document.getElementById('imageCounter');
    if (counter) {
      counter.textContent = `${totalImages}/10 foto`;
      if (totalImages >= 8) {
        counter.className = 'text-xs text-orange-600 bg-orange-100 px-2 py-1 rounded-md font-medium border border-orange-200';
      } else if (totalImages >= 5) {
        counter.className = 'text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded-md font-medium border border-blue-200';
      } else {
        counter.className = 'text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md font-medium';
      }
    }
  }

  function toggleUIElements() {
    const visibleImages = getVisibleImages();
    const hasImages = visibleImages.length > 0;
    
    // Toggle main preview
    if (hasImages) {
      uploadPlaceholder.classList.add('hidden');
      mainPreview.classList.remove('hidden');
    } else {
      uploadPlaceholder.classList.remove('hidden');
      mainPreview.classList.add('hidden');
    }
    
    // Toggle add more button and thumbnail container
    const addMoreBtn = document.getElementById('addMoreImagesBtn');
    const thumbnailContainer = document.getElementById('thumbnailContainer');
    
    if (hasImages) {
      addMoreBtn.classList.remove('hidden');
      thumbnailContainer.classList.remove('hidden');
    } else {
      addMoreBtn.classList.add('hidden');
      thumbnailContainer.classList.add('hidden');
    }
  }

  function updateMainPreview() {
    const visibleImages = getVisibleImages();
    if (visibleImages.length > 0) {
      const firstImage = visibleImages[0];
      if (firstImage.id) {
        showMainPreviewExisting(firstImage);
      } else {
        showMainPreview(0);
      }
    }
  }

  function showToast(message, type = 'info') {
    // Enhanced toast with dashboard styling
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-500' : 
                   type === 'error' ? 'bg-red-500' : 
                   type === 'warning' ? 'bg-orange-500' : 'bg-[#1B3A6D]';
                   
    toast.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-white text-sm font-medium shadow-lg transform transition-all duration-300 ${bgColor}`;
    toast.innerHTML = `
      <div class="flex items-center space-x-2">
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
    }, 3000);
  }

  function getVisibleImages() {
    const visibleExisting = existingImages.filter(img => !deletedImageIds.includes(img.id));
    return [...visibleExisting, ...imageFiles];
  }

  function updateThumbnailGrid() {
    thumbnailGrid.innerHTML = '';
    
    const visibleImages = getVisibleImages();
    
    if (visibleImages.length === 0) {
      return;
    }

    // Display existing images first
    existingImages.forEach((image, index) => {
      if (deletedImageIds.includes(image.id)) return;
      
      const wrapper = document.createElement('div');
      wrapper.className = 'thumbnail-wrapper';
      wrapper.setAttribute('data-type', 'existing');
      wrapper.setAttribute('data-id', image.id);
      wrapper.setAttribute('data-index', index);
      
      // Cover badge dengan styling dashboard
      const visibleExistingIndex = existingImages.filter((img, i) => i < index && !deletedImageIds.includes(img.id)).length;
      if (visibleExistingIndex === 0 && deletedImageIds.filter(id => existingImages.findIndex(img => img.id === id) < index).length === 0) {
        const coverBadge = document.createElement('div');
        coverBadge.className = 'absolute -top-1 -left-1 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full z-20 shadow-lg border border-white';
        coverBadge.innerHTML = '<i class="fas fa-crown mr-1"></i>Sampul';
        wrapper.appendChild(coverBadge);
      }

      // Order number badge dengan styling dashboard
      const orderBadge = document.createElement('div');
      orderBadge.className = 'absolute -top-1 -right-1 bg-[#1B3A6D] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center z-20 shadow-lg border border-white';
      orderBadge.textContent = visibleExistingIndex + 1;
      wrapper.appendChild(orderBadge);

      const img = document.createElement('img');
      img.src = `{{ asset('storage/') }}/${image.image_path}`;
      img.className = 'w-full h-20 object-cover rounded-lg';
      img.addEventListener('click', () => {
        showMainPreviewExisting(image);
        highlightThumbnail(wrapper);
      });

      const deleteBtn = document.createElement('button');
      deleteBtn.type = 'button';
      deleteBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:bg-red-600 shadow-lg border border-white hover:scale-110';
      deleteBtn.innerHTML = '<i class="fas fa-trash text-xs"></i>';
      deleteBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        confirmDeleteImage(() => deleteExistingImage(image.id), `Hapus gambar "${image.image_path.split('/').pop()}"?`);
      });

      // Enhanced drag handle
      const dragHandle = document.createElement('div');
      dragHandle.className = 'absolute bottom-1 left-1 bg-[#1B3A6D] text-white rounded p-1.5 opacity-0 group-hover:opacity-90 transition-all cursor-move shadow-lg border border-white';
      dragHandle.innerHTML = '<i class="fas fa-grip-vertical text-xs"></i>';
      wrapper.appendChild(dragHandle);

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
        wrapper.className = 'thumbnail-wrapper';
        wrapper.setAttribute('data-type', 'new');
        wrapper.setAttribute('data-index', fileIndex);
        
        // Cover badge untuk gambar baru pertama jika tidak ada existing images
        const visibleExistingCount = existingImages.filter(img => !deletedImageIds.includes(img.id)).length;
        if (position === 0 && visibleExistingCount === 0) {
          const coverBadge = document.createElement('div');
          coverBadge.className = 'absolute -top-1 -left-1 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full z-20 shadow-lg border border-white';
          coverBadge.innerHTML = '<i class="fas fa-crown mr-1"></i>Sampul';
          wrapper.appendChild(coverBadge);
        }

        // Order number badge dengan styling dashboard
        const orderBadge = document.createElement('div');
        orderBadge.className = 'absolute -top-1 -right-1 bg-[#1B3A6D] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center z-20 shadow-lg border border-white';
        orderBadge.textContent = visibleExistingCount + position + 1;
        wrapper.appendChild(orderBadge);

        // New badge dengan styling yang konsisten
        const newBadge = document.createElement('div');
        newBadge.className = 'absolute bottom-1 right-1 bg-orange-500 text-white text-xs px-1.5 py-0.5 rounded z-20 shadow-lg border border-white';
        newBadge.textContent = 'Baru';
        wrapper.appendChild(newBadge);

        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-full h-20 object-cover rounded-lg';
        img.addEventListener('click', () => {
          showMainPreview(fileIndex);
          highlightThumbnail(wrapper);
        });

        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:bg-red-600 shadow-lg border border-white hover:scale-110';
        deleteBtn.innerHTML = '<i class="fas fa-trash text-xs"></i>';
        deleteBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          confirmDeleteImage(() => removeImage(fileIndex), `Hapus gambar "${file.name}"?`);
        });

        // Enhanced drag handle
        const dragHandle = document.createElement('div');
        dragHandle.className = 'absolute bottom-1 left-1 bg-[#1B3A6D] text-white rounded p-1.5 opacity-0 group-hover:opacity-90 transition-all cursor-move shadow-lg border border-white';
        dragHandle.innerHTML = '<i class="fas fa-grip-vertical text-xs"></i>';
        wrapper.appendChild(dragHandle);

        wrapper.appendChild(img);
        wrapper.appendChild(deleteBtn);
        thumbnailGrid.appendChild(wrapper);
      };
      reader.readAsDataURL(file);
    });

    // Initialize Sortable for drag and drop reordering
    setTimeout(() => {
      if (thumbnailGrid.children.length > 0) {
        new Sortable(thumbnailGrid, {
          animation: 150,
          ghostClass: 'sortable-ghost',
          chosenClass: 'sortable-chosen',
          dragClass: 'sortable-drag',
          handle: '.cursor-move',
          onEnd: function(evt) {
            showToast('Urutan foto berhasil diubah!', 'success');
            updateImageDisplay();
          }
        });
      }
    }, 100);
  }

  function highlightThumbnail(element) {
    // Remove previous highlights
    document.querySelectorAll('#thumbnailGrid .border-[\\#1B3A6D]').forEach(el => {
      el.classList.remove('border-[#1B3A6D]');
      el.classList.add('border-transparent');
    });
    
    // Add highlight to clicked thumbnail with dashboard colors
    element.classList.add('border-[#1B3A6D]');
    element.classList.remove('border-transparent');
    element.style.boxShadow = '0 4px 12px rgba(27, 58, 109, 0.25)';
  }

  function confirmDeleteImage(callback, message) {
    Swal.fire({
      title: 'Hapus Gambar?',
      text: message,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal',
      customClass: {
        confirmButton: 'bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg mr-2 font-medium',
        cancelButton: 'bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-medium'
      },
      buttonsStyling: false
    }).then((result) => {
      if (result.isConfirmed) {
        callback();
        showToast('Gambar berhasil dihapus!', 'success');
      }
    });
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

    updateImageDisplay();
  }

  function deleteExistingImage(imageId) {
    deletedImageIds.push(imageId);
    updateImageDisplay();
  }

  // Remove main preview button
  document.getElementById('removeMainBtn').addEventListener('click', () => {
    const visibleImages = getVisibleImages();
    if (visibleImages.length > 0) {
      const firstImage = visibleImages[0];
      if (firstImage.id) {
        confirmDeleteImage(() => deleteExistingImage(firstImage.id), `Hapus gambar sampul?`);
      } else {
        confirmDeleteImage(() => removeImage(0), `Hapus gambar sampul?`);
      }
    }
  });

  // Initialize existing images display on page load
  document.addEventListener('DOMContentLoaded', function() {
    updateImageDisplay();
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
                confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
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
                confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
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

    // Show loading state dengan styling dashboard
    const button = document.getElementById("submitBarangBtn");
    const originalText = button.innerHTML;
    button.innerHTML = '<div class="loading-spinner mr-2"></div>Memperbarui Produk...';
    button.disabled = true;
    button.classList.add('opacity-75');

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
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
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
                    confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
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
                confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
            },
            buttonsStyling: false
        });
    } finally {
        // Restore button dengan styling dashboard
        button.innerHTML = originalText;
        button.disabled = false;
        button.classList.remove('opacity-75');
    }
  });
</script>
@endpush
