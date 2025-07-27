@extends('layouts.app_dashboard')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 mx-2 md:mx-0">
    <div class="p-3 md:p-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Edit Barang</h2>
    </div>

    <div class="p-6">
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Upload Thumbnail --}}
            <div class="md:w-1/3">
            <label class="block mb-2 text-sm font-medium text-gray-700">Gambar Produk</label>

            <!-- Input dan preview utama -->
            <div
                class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg h-64 bg-gray-50 text-gray-500 text-center mb-4 overflow-hidden"
                id="imageUploadContainer"
            >
                <img id="previewImage" src="{{ $product->image_path ? asset('storage/' . $product->image_path) : '' }}" alt="Preview"
                class="{{ $product->image_path ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-0" />

                <div id="uploadPlaceholder" class="z-10 flex flex-col items-center{{ $product->image_path ? ' hidden' : '' }}">
                <i class="fa-solid fa-image fa-2xl text-[#1B3A6D]"></i>
                <label for="imageInput"
                    class="cursor-pointer bg-[#1B3A6D] text-white px-3 py-2 mt-3 rounded-lg hover:bg-[#1B3A6D]/90 transition-colors text-sm">
                    Pilih Gambar
                </label>
                <p class="text-sm mt-1">atau seret foto ke sini</p>
                </div>

                <!-- Tombol aksi untuk preview utama -->
                <div id="imageActions"
                class="{{ $product->image_path ? '' : 'hidden' }} absolute bottom-4 left-4 z-10 flex gap-2">
                <button id="removePreviewBtn" type="button"
                    class="bg-white/80 text-red-600 px-2 py-1 text-sm rounded hover:bg-red-100">
                    ❌
                </button>
                </div>

                <input name="images[]" type="file" id="imageInput" class="hidden" accept="image/*" multiple />
            </div>

            <p class="text-xs text-gray-500 mt-2">Lampirkan gambar. Ukuran file tidak boleh lebih dari 5MB</p>

            <!-- Daftar thumbnail preview -->
            <div id="imagePreviewList" class="flex flex-wrap gap-2">
                @foreach($product->images as $img)
                    <div class="relative group cursor-move" data-image-id="{{ $img->id }}" data-order="{{ $img->order }}">
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-20 h-20 object-cover rounded cursor-pointer old-image-preview" data-image-id="{{ $img->id }}">
                        <button type="button" class="absolute top-1 right-1 bg-white/80 text-red-600 text-xs rounded hover:bg-red-100 hidden group-hover:block remove-old-image-btn" data-image-id="{{ $img->id }}">🗑️</button>
                        <input type="hidden" name="existing_images[]" value="{{ $img->id }}">
                        <div class="absolute top-1 left-1 bg-blue-500 text-white text-xs rounded px-1">{{ $img->order + 1 }}</div>
                    </div>
                @endforeach
            </div>
         </div>



            {{-- Form Input --}}
            <div class="md:w-2/3 space-y-4">
                <!-- Nama Barang -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Barang</label>
                    <input id="nama" type="text" placeholder="Masukkan nama barang..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]"
                        value="{{ old('name', $product->name) }}" />
                </div>

                <!-- Harga Barang -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Harga Barang</label>
                    <input id="harga" type="number" placeholder="Masukkan harga barang..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]"
                        value="{{ old('price', $product->price) }}" />
                </div>

                <!-- Nama Penjual -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Penjual</label>
                    <input id="seller_name" type="text" placeholder="Masukkan nama penjual..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]"
                        value="{{ old('seller_name', $product->seller_name) }}" />
                </div>

                <!-- Nomor WhatsApp -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                    <input id="contact_person" type="text" placeholder="08xxxx..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]"
                        value="{{ old('contact_person', $product->contact_person) }}" />
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

<!-- Modal Preview Gambar Besar -->
<div id="modalImagePreview" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 hidden">
    <div class="relative">
        <img id="modalImagePreviewImg" src="" class="max-w-[90vw] max-h-[80vh] rounded shadow-lg border-4 border-white" />
        <button id="closeModalImagePreview" class="absolute top-2 right-2 bg-white rounded-full p-1 shadow hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>
</div>
@endsection

@push('addon-script')
    <!-- SortableJS for drag & drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
  const imageInput = document.getElementById("imageInput");
  const previewImage = document.getElementById("previewImage");
  const uploadPlaceholder = document.getElementById("uploadPlaceholder");
  const imageActions = document.getElementById("imageActions");
  const removePreviewBtn = document.getElementById("removePreviewBtn");
  const imagePreviewList = document.getElementById("imagePreviewList");

  let imageFiles = [];

  imageInput.addEventListener("change", (e) => {
    const files = Array.from(e.target.files);
    
    // Validate file sizes
    for (let file of files) {
      if (file.size > 5 * 1024 * 1024) { // 5MB
        Swal.fire({
          icon: 'warning',
          title: 'File Terlalu Besar',
          text: `File ${file.name} melebihi 5MB!`,
          customClass: {
            confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
          },
          buttonsStyling: false
        });
        return;
      }
    }
    
    imageFiles = [...imageFiles, ...files];
    updatePreviewList();
  });

  function updatePreviewList() {
    imagePreviewList.innerHTML = "";
    imageFiles.forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = (e) => {
        const wrapper = document.createElement("div");
        wrapper.className = "relative group";

        const img = document.createElement("img");
        img.src = e.target.result;
        img.className = "w-20 h-20 object-cover rounded cursor-pointer new-image-preview";

        const delBtn = document.createElement("button");
        delBtn.innerHTML = "🗑️";
        delBtn.className =
          "absolute top-1 right-1 bg-white/80 text-red-600 text-xs rounded hover:bg-red-100 hidden group-hover:block";
        delBtn.addEventListener("click", () => {
            const removedSrc = e.target.result;

            if(previewImage.src === removedSrc){
                previewImage.classList.add("hidden");
                previewImage.src = "";
                uploadPlaceholder.classList.remove("hidden");
                imageActions.classList.add("hidden");
            }

            imageFiles.splice(index, 1);
            updatePreviewList();
        });

        wrapper.appendChild(img);
        wrapper.appendChild(delBtn);
        imagePreviewList.appendChild(wrapper);
      };
      reader.readAsDataURL(file);
    });
  }

  function showPreview(src) {
    previewImage.src = src;
    previewImage.classList.remove("hidden");
    uploadPlaceholder.classList.add("hidden");
    imageActions.classList.remove("hidden");
  }

  removePreviewBtn.addEventListener("click", () => {
    previewImage.classList.add("hidden");
    previewImage.src = "";
    uploadPlaceholder.classList.remove("hidden");
    imageActions.classList.add("hidden");
  });

  document.getElementById("submitBarangBtn").addEventListener("click", async function (e) {
    e.preventDefault(); // Prevent any default form submission
    console.log("Update button clicked - event triggered");
    
    // Validasi form
    const nama = document.getElementById("nama").value.trim();
    const harga = document.getElementById("harga").value.trim();
    const sellerName = document.getElementById("seller_name").value.trim();
    const contactPerson = document.getElementById("contact_person").value.trim();
    const deskripsi = document.getElementById("deskripsi").value.trim();
    const status = document.getElementById("status").value;

    console.log("Form data:", { nama, harga, sellerName, contactPerson, deskripsi, status });

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

    // Validasi harga adalah angka
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
    formData.append("id", "{{ $product->id }}");

    console.log("Product ID:", "{{ $product->id }}");

    // Add image order data
    const imageOrder = getImageOrder();
    formData.append("image_order", JSON.stringify(imageOrder));

    // Add new images if any
    if (imageFiles && imageFiles.length > 0) {
        imageFiles.forEach((file, index) => {
            formData.append("images[]", file);
        });
        console.log("Adding images:", imageFiles.length);
    }

    // Show loading state
    const button = document.getElementById("submitBarangBtn");
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
    button.disabled = true;

    console.log("Sending request to:", "{{ url('dashboard/products/update') }}");

    try {
        const response = await fetch("{{ url('dashboard/products/update') }}", {
            method: "POST",
            headers: {
                "Accept":"application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: formData
        });

        console.log("Response status:", response.status);
        console.log("Response ok:", response.ok);

        if (response.ok) {
            const result = await response.json();
            console.log("Success response:", result);
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
            const errorText = await response.text();
            console.error("Error response text:", errorText);
            
            let errorData;
            try {
                errorData = JSON.parse(errorText);
            } catch (e) {
                errorData = { message: errorText };
            }
            
            console.error("Gagal memperbarui produk:", errorData);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memperbarui',
                text: errorData.message || 'Terjadi kesalahan saat memperbarui produk.',
                customClass: {
                    confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
                },
                buttonsStyling: false
            });
        }
    } catch (error) {
        console.error("Fetch error:", error);
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

// Remove old image preview on click
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-old-image-btn')) {
        const imageId = e.target.getAttribute('data-image-id');
        const wrapper = e.target.closest('[data-image-id]');
        if (wrapper) wrapper.remove();
        // Optionally, add a hidden input to mark for deletion
        const deletedInput = document.createElement('input');
        deletedInput.type = 'hidden';
        deletedInput.name = 'delete_images[]';
        deletedInput.value = imageId;
        document.getElementById('imagePreviewList').appendChild(deletedInput);
    }

    // Preview image in main preview area (imageUploadContainer) on click (old or new images)
    if (e.target.classList.contains('old-image-preview') || e.target.classList.contains('new-image-preview')) {
        const src = e.target.src;
        const previewImage = document.getElementById('previewImage');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const imageActions = document.getElementById('imageActions');
        previewImage.src = src;
        previewImage.classList.remove('hidden');
        uploadPlaceholder.classList.add('hidden');
        imageActions.classList.remove('hidden');
    }
});

// Close modal preview
document.getElementById('closeModalImagePreview').addEventListener('click', function() {
    document.getElementById('modalImagePreview').classList.add('hidden');
});

// Close modal on background click
document.getElementById('modalImagePreview').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
    }
});

// Function to get image order
function getImageOrder() {
    const imageElements = document.querySelectorAll('#imagePreviewList [data-image-id]');
    const orderData = [];
    imageElements.forEach((element, index) => {
        const imageId = element.getAttribute('data-image-id');
        if (imageId) {
            orderData.push({
                id: imageId,
                order: index
            });
        }
    });
    return orderData;
}

// Initialize Sortable for drag & drop
document.addEventListener('DOMContentLoaded', function() {
    const imagePreviewList = document.getElementById('imagePreviewList');
    if (imagePreviewList) {
        new Sortable(imagePreviewList, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                // Update order numbers after drag
                console.log('Image order changed');
            }
        });
    }
});

// Function to update order numbers
function updateOrderNumbers() {
    const imageItems = document.querySelectorAll('#imagePreviewList [data-image-id]');
    imageItems.forEach((item, index) => {
        const orderBadge = item.querySelector('.absolute.top-1.left-1');
        if (orderBadge) {
            orderBadge.textContent = index + 1;
        }
        item.setAttribute('data-order', index);
    });
}

// Function to get current order of images  
function getImageOrder() {
    const imageItems = document.querySelectorAll('#imagePreviewList [data-image-id]');
    const order = [];
    imageItems.forEach((item, index) => {
        const imageId = item.getAttribute('data-image-id');
        order.push({
            id: imageId,
            order: index
        });
    });
    return order;
}
</script>
@endpush
