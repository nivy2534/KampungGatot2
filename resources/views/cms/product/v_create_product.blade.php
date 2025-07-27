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
                                <li>• Maksimal 10 foto, masing-masing 1MB</li>
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
                                <i class="fas fa-crown mr-1"></i>
                                <span id="mainImageLabel">Foto Sampul</span>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="imageInput" class="hidden" accept="image/*" multiple>
                </div>

                <!-- Grid Thumbnail dengan Drag & Drop -->
                <div id="thumbnailGrid" class="grid grid-cols-3 gap-[0px]"></div>
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
  let imageFiles = [];
  let mainImageIndex = 0;

  const imageInput = document.getElementById("imageInput");
  const mainPreview = document.getElementById("mainPreview");
  const previewImage = document.getElementById("previewImage");
  const thumbnailGrid = document.getElementById("thumbnailGrid");
  const removeMainBtn = document.getElementById("removeMainBtn");
  const uploadPlaceholder = document.getElementById("uploadPlaceholder");

  imageInput.addEventListener("change", (e) => {
    const files = Array.from(e.target.files);
    imageFiles = [...imageFiles, ...files];
    updatePreviewList();
  });

  function updatePreviewList() {
    thumbnailGrid.innerHTML = "";

    imageFiles.forEach((file, index) => {
        const readerThumb = new FileReader();
        readerThumb.onload = (e) => {
            const wrapper = document.createElement("div");
            wrapper.className = "relative w-20 h-20 flex flex-col items-center justify-center shrink-0";
            wrapper.dataset.index = index;

            const img = document.createElement("img");
            img.src = e.target.result;
            img.className = "w-full h-full object-cover rounded cursor-pointer";
            img.onclick = () => {
                previewImage.src = e.target.result;
                mainImageIndex = index;
                mainPreview.classList.remove("hidden");
                uploadPlaceholder.classList.add("hidden");
                updatePreviewList(); // refresh label cover
            };

            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "absolute top-0 right-0 bg-red-500 text-white w-5 h-5 flex items-center justify-center rounded-full text-xs hover:bg-red-600 -mt-1 -mr-1 shadow";
            removeBtn.innerHTML = "&times;";
            removeBtn.onclick = (ev) => {
                ev.stopPropagation();

                imageFiles.splice(index, 1);

                if (index === mainImageIndex) {
                    mainImageIndex = 0;
                } else if (index < mainImageIndex) {
                    mainImageIndex -= 1;
                }

                updatePreviewList();
            };

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);

            // Label cover hanya untuk yang saat ini jadi cover
            if (index === mainImageIndex) {
                const coverLabel = document.createElement("span");
                coverLabel.innerText = "Cover";
                coverLabel.className = "absolute bottom-1 left-1 bg-blue-600 text-white text-xs px-1.5 py-0.5 rounded shadow";
                wrapper.appendChild(coverLabel);
            }

            thumbnailGrid.appendChild(wrapper);

            // Tampilkan preview utama sesuai cover (sekali di sini saja)
            if (index === mainImageIndex) {
                previewImage.src = e.target.result;
                mainPreview.classList.remove("hidden");
                uploadPlaceholder.classList.add("hidden");
            }
        };
        readerThumb.readAsDataURL(file);
    });

    // Jika tidak ada file, sembunyikan preview
    if (imageFiles.length === 0) {
        mainPreview.classList.add("hidden");
        uploadPlaceholder.classList.remove("hidden");
    }
}



    new Sortable(thumbnailGrid, {
        animation: 150,
        ghostClass: "sortable-ghost",
        onEnd: function () {
            const newOrder = Array.from(thumbnailGrid.children).map((child) => {
                const index = parseInt(child.dataset.index);
                return imageFiles[index];
            });

            imageFiles = newOrder;
            mainImageIndex = 0; // ← Cover selalu index 0
            updatePreviewList();
        }
    });



  removeMainBtn.addEventListener("click", () => {
    previewImage.src = "";
    mainPreview.classList.add("hidden");
    uploadPlaceholder.classList.remove("hidden");
  });

  document.addEventListener('DOMContentLoaded', function() {
    updateImageDisplay();
  });
</script>

@endpush
