@extends('layouts.app_dashboard')

@section('content')
<div class="bg-white rounded-lg border border-gray-200 p-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                <i class="fas fa-plus-circle text-[#1B3A6D] text-sm"></i>
            </div>
            <div>
                <h1 class="text-xl font-semibold text-gray-900">Tambah Produk Baru</h1>
                <p class="text-sm text-gray-500">Buat produk baru untuk website desa</p>
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
                                <li>• Maksimal 10 foto, masing-masing 5MB</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Area Upload Utama -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 mb-4 transition-all hover:border-[#1B3A6D] hover:bg-blue-50/50" id="uploadArea">
                    <div class="relative">
                        <!-- Icon dan Tombol Upload -->
                        <div id="uploadPlaceholder" class="flex flex-col items-center py-8">
                            <div class="w-16 h-16 bg-[#1B3A6D] rounded-lg flex items-center justify-center mb-4 shadow-sm">
                                <i class="fas fa-images text-white text-2xl"></i>
                            </div>
                            <button type="button" onclick="document.getElementById('imageInput').click()" 
                                class="bg-[#1B3A6D] text-white px-6 py-3 rounded-lg hover:bg-[#152f5a] transition-colors mb-3 text-sm font-medium shadow-sm">
                                <i class="fas fa-plus mr-2"></i>Pilih Gambar
                            </button>
                            <p class="text-sm text-gray-600 mb-1">atau seret foto ke sini</p>
                            <p class="text-xs text-gray-500">(Maksimal 10 foto, masing-masing 5MB)</p>
                        </div>

                        <!-- Preview Image Utama -->
                        <div id="mainPreview" class="hidden">
                            <img id="previewImage" src="" alt="Preview" class="w-full h-64 object-contain rounded-lg bg-gray-100 border">
                            <div class="absolute top-2 right-2">
                                <button type="button" id="removeMainBtn" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors shadow-lg">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                            <div class="absolute bottom-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded backdrop-blur-sm">
                                <i class="fas fa-eye mr-1"></i>
                                <span id="mainImageLabel">Preview</span>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="imageInput" class="hidden" accept="image/*" multiple>
                </div>

                <!-- Tombol Tambah Gambar Lagi -->
                <div class="mt-4" id="addMoreImagesBtn" style="display: none;">
                    <button type="button" onclick="document.getElementById('imageInput').click()" 
                        class="w-full bg-white border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-[#1B3A6D] hover:bg-blue-50/30 transition-all group">
                        <i class="fas fa-plus text-gray-400 group-hover:text-[#1B3A6D] text-lg mb-2"></i>
                        <p class="text-sm text-gray-600 group-hover:text-[#1B3A6D] font-medium">Tambah Gambar Lagi</p>
                        <p class="text-xs text-gray-500 mt-1">Maksimal <span id="remainingSlots">10</span> foto lagi</p>
                    </button>
                </div>

                <!-- Grid Thumbnail dengan Drag & Drop -->
                <div id="thumbnailContainer" class="hidden mt-4">
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
                    <!-- Nama Produk -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-tag mr-1 text-gray-400"></i>
                            Nama Produk
                        </label>
                        <input id="nama" type="text" placeholder="Masukkan nama produk..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors" />
                    </div>

                    <!-- Harga Produk -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-money-bill-wave mr-1 text-gray-400"></i>
                            Harga Produk
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                            <input id="harga" type="number" placeholder="0"
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
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors resize-vertical"></textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            <i class="fas fa-toggle-on mr-1 text-gray-400"></i>
                            Status Produk
                        </label>
                        <select id="status"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] transition-colors">
                            <option value="ready">Ready</option>
                            <option value="habis">Habis</option>
                            <option value="preorder">Pre-Order</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex flex-col md:flex-row gap-3 pt-6 border-t border-gray-100">
                        <button id="submitBarangBtn"
                            class="flex items-center justify-center bg-[#1B3A6D] text-white px-6 py-3 rounded-lg hover:bg-[#152f5a] transition-colors text-sm font-medium shadow-sm">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Produk
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

  input:focus, textarea:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(27, 58, 109, 0.1);
  }

  .thumbnail-wrapper {
    position: relative;
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 0.5rem;
    transition: all 0.2s ease;
  }
  
  .thumbnail-wrapper:hover {
    border-color: #1B3A6D;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 58, 109, 0.15);
  }

  .drag-handle {
    cursor: grab !important;
    opacity: 0.7;
    transition: all 0.2s ease;
  }
  
  .drag-handle:active {
    cursor: grabbing !important;
  }
  
  .thumbnail-wrapper:hover .drag-handle {
    opacity: 1 !important;
    transform: scale(1.1);
  }
  
  .drag-handle:hover {
    background-color: #0f2744 !important;
    transform: scale(1.2) !important;
  }

  /* Better visual feedback for sortable */
  .sortable-chosen .drag-handle {
    opacity: 1 !important;
    background-color: #0f2744 !important;
  }

  /* Mobile responsive drag handles */
  @media (max-width: 768px) {
    .drag-handle {
      opacity: 0.8 !important;
    }
    
    .thumbnail-wrapper .drag-handle {
      opacity: 0.8 !important;
    }
  }

  .loading-spinner {
    animation: spin 1s linear infinite;
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 2px solid currentColor;
    border-top-color: transparent;
    border-radius: 50%;
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }
</style>
<script>
  const imageInput = document.getElementById("imageInput");
  const previewImage = document.getElementById("previewImage");
  const uploadPlaceholder = document.getElementById("uploadPlaceholder");
  const mainPreview = document.getElementById("mainPreview");
  const thumbnailGrid = document.getElementById("thumbnailGrid");
  const uploadArea = document.getElementById("uploadArea");
  const thumbnailContainer = document.getElementById("thumbnailContainer");
  const imageCounter = document.getElementById("imageCounter");

  let imageFiles = [];
  let imageOrder = [];

  // Drag and drop handlers
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
    // Reset input untuk memungkinkan memilih file yang sama lagi
    e.target.value = '';
  });

  function addFiles(files) {
    if (imageFiles.length + files.length > 10) {
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
      if (file.size > 5 * 1024 * 1024) { // 5MB 
        Swal.fire({
          icon: 'warning',
          title: 'File Terlalu Besar',
          text: `File ${file.name} melebihi 5MB!`,
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
  }

  function updateImageDisplay() {
    updateImageCounter();
    updateThumbnailGrid();
    updateMainPreview();
    toggleUIElements();
  }

  function updateImageCounter() {
    const totalImages = imageFiles.length;
    const remainingSlots = 10 - totalImages;
    
    if (imageCounter) {
      imageCounter.textContent = `${totalImages}/10 foto`;
      if (totalImages >= 8) {
        imageCounter.className = 'text-xs text-orange-600 bg-orange-100 px-2 py-1 rounded-md font-medium border border-orange-200';
      } else if (totalImages >= 5) {
        imageCounter.className = 'text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded-md font-medium border border-blue-200';
      } else {
        imageCounter.className = 'text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md font-medium';
      }
    }
    
    // Update remaining slots counter
    const remainingSlotsEl = document.getElementById('remainingSlots');
    if (remainingSlotsEl) {
      remainingSlotsEl.textContent = remainingSlots;
    }
    
    // Hide "Tambah Gambar Lagi" button if limit reached
    const addMoreBtn = document.getElementById('addMoreImagesBtn');
    if (addMoreBtn && totalImages > 0) {
      if (totalImages >= 10) {
        addMoreBtn.style.display = 'none';
      } else {
        addMoreBtn.style.display = 'block';
      }
    }
  }

  function toggleUIElements() {
    const hasImages = imageFiles.length > 0;
    const addMoreBtn = document.getElementById('addMoreImagesBtn');
    
    if (hasImages) {
      uploadPlaceholder.classList.add('hidden');
      mainPreview.classList.remove('hidden');
      thumbnailContainer.classList.remove('hidden');
      addMoreBtn.style.display = 'block';
    } else {
      uploadPlaceholder.classList.remove('hidden');
      mainPreview.classList.add('hidden');
      thumbnailContainer.classList.add('hidden');
      addMoreBtn.style.display = 'none';
    }
  }

  function updateMainPreview() {
    if (imageOrder.length > 0) {
      showMainPreview(imageOrder[0]); // Show the first image in order as main preview
    }
  }

  function updateThumbnailGrid() {
    // Destroy existing sortable instance first
    if (thumbnailGrid.sortableInstance) {
      thumbnailGrid.sortableInstance.destroy();
      thumbnailGrid.sortableInstance = null;
    }
    
    thumbnailGrid.innerHTML = '';
    
    if (imageFiles.length === 0) {
      return;
    }

    imageOrder.forEach((fileIndex, position) => {
      const file = imageFiles[fileIndex];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'thumbnail-wrapper group';
        wrapper.setAttribute('data-index', fileIndex);
        
        if (position === 0) {
          const coverBadge = document.createElement('div');
          coverBadge.className = 'absolute -top-1 -left-1 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full z-20 shadow-lg border border-white';
          coverBadge.innerHTML = '<i class="fas fa-crown mr-1"></i>Sampul';
          wrapper.appendChild(coverBadge);
        }

        const orderBadge = document.createElement('div');
        orderBadge.className = 'absolute -top-1 -right-1 bg-blue-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center z-20 shadow-lg border border-white';
        orderBadge.textContent = position + 1;
        wrapper.appendChild(orderBadge);

        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'w-full h-20 object-cover rounded-lg cursor-pointer';
        img.addEventListener('click', () => showMainPreview(fileIndex));

        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:bg-red-600 shadow-lg border border-white hover:scale-110';
        deleteBtn.innerHTML = '<i class="fas fa-trash text-xs"></i>';
        deleteBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          removeImage(fileIndex);
        });

        const dragHandle = document.createElement('div');
        dragHandle.className = 'drag-handle absolute bottom-1 left-1 bg-[#1B3A6D] text-white rounded p-1.5 opacity-0 group-hover:opacity-90 transition-all cursor-grab shadow-lg border border-white';
        dragHandle.innerHTML = '<i class="fas fa-grip-vertical text-xs"></i>';
        
        // Add proper event listeners for cursor changes
        dragHandle.addEventListener('mousedown', function() {
          this.style.cursor = 'grabbing';
        });
        dragHandle.addEventListener('mouseup', function() {
          this.style.cursor = 'grab';
        });
        
        wrapper.appendChild(img);
        wrapper.appendChild(deleteBtn);
        wrapper.appendChild(dragHandle);
        thumbnailGrid.appendChild(wrapper);
      };
      reader.readAsDataURL(file);
    });

    // Reinitialize Sortable after all thumbnails are created
    setTimeout(() => {
      if (thumbnailGrid.children.length > 0) {
        thumbnailGrid.sortableInstance = new Sortable(thumbnailGrid, {
          animation: 150,
          ghostClass: 'sortable-ghost',
          chosenClass: 'sortable-chosen',
          dragClass: 'sortable-drag',
          handle: '.drag-handle',
          forceFallback: false,
          onEnd: function(evt) {
            // Update image order array based on new DOM order
            const newOrder = [];
            Array.from(thumbnailGrid.children).forEach((child) => {
              const dataIndex = child.getAttribute('data-index');
              if (dataIndex !== null) {
                newOrder.push(parseInt(dataIndex));
              }
            });
            imageOrder = newOrder;
            
            // Update badges without recreating thumbnails
            updateThumbnailBadges();
            
            // Update main preview to show new first image
            if (imageOrder.length > 0) {
              showMainPreview(imageOrder[0]);
            }
          }
        });
      }
    }, 200);
  }

  function updateThumbnailBadges() {
    // Update cover badge and order numbers without recreating thumbnails
    Array.from(thumbnailGrid.children).forEach((wrapper, position) => {
      // Remove existing badges
      const existingCoverBadge = wrapper.querySelector('.bg-green-500');
      const existingOrderBadges = wrapper.querySelectorAll('[class*="bg-blue-600"]');
      
      if (existingCoverBadge) existingCoverBadge.remove();
      existingOrderBadges.forEach(badge => badge.remove());
      
      // Add cover badge to first item
      if (position === 0) {
        const coverBadge = document.createElement('div');
        coverBadge.className = 'absolute -top-1 -left-1 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full z-20 shadow-lg border border-white';
        coverBadge.innerHTML = '<i class="fas fa-crown mr-1"></i>Sampul';
        wrapper.appendChild(coverBadge);
      }
      
      // Add order badge
      const orderBadge = document.createElement('div');
      orderBadge.className = 'absolute -top-1 -right-1 bg-blue-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center z-20 shadow-lg border border-white';
      orderBadge.textContent = position + 1;
      wrapper.appendChild(orderBadge);
    });
  }



  function showMainPreview(fileIndex) {
    const file = imageFiles[fileIndex];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  function removeImage(fileIndex) {
    // Find the position of this file in the order array
    const orderPosition = imageOrder.indexOf(fileIndex);
    
    // Remove the file from the array
    imageFiles.splice(fileIndex, 1);
    
    // Update the order array:
    // 1. Remove the deleted file index
    // 2. Decrease all indices that are greater than the deleted index
    imageOrder = imageOrder
      .filter(index => index !== fileIndex)
      .map(index => index > fileIndex ? index - 1 : index);
    
    updateImageDisplay();
  }

  document.getElementById('removeMainBtn').addEventListener('click', () => {
    if (imageOrder.length > 0) {
      const mainImageIndex = imageOrder[0]; // Get the first image in order (cover image)
      removeImage(mainImageIndex);
    }
  });

  document.getElementById("submitBarangBtn").addEventListener("click", async function () {
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
    formData.append("name", nama);
    formData.append("price", harga);
    formData.append("seller_name", sellerName);
    formData.append("contact_person", contactPerson);
    formData.append("description", deskripsi);
    formData.append("status", status);

    imageOrder.forEach((fileIndex, position) => {
      const file = imageFiles[fileIndex];
      if (file) {
        formData.append("images[]", file);
        formData.append("image_orders[]", position);
      }
    });

    const button = document.getElementById("submitBarangBtn");
    const originalText = button.innerHTML;
    button.innerHTML = '<div class="loading-spinner mr-2"></div>Menyimpan Produk...';
    button.disabled = true;
    button.classList.add('opacity-75');

    try {
        const response = await fetch("{{ url('dashboard/products/save') }}", {
            method: "POST",
            headers: {
                "Accept":"application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: formData
        });

        if (response.ok) {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Produk baru telah disimpan.',
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
                text: errorData.message || 'Terjadi kesalahan saat menyimpan produk.',
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
        button.innerHTML = originalText;
        button.disabled = false;
        button.classList.remove('opacity-75');
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    updateImageDisplay();
  });
</script>
@endpush
