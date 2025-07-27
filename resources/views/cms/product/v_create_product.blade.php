@extends('layouts.app_dashboard')

@section('content')
    <!-- Header -->
    <div class="mb-4 md:mb-6 px-2 md:px-0">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between md:gap-0">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-1">
                    {{ isset($product) ? 'Edit Barang' : 'Tambah Barang' }}
                </h1>
                <p class="text-xs md:text-sm text-gray-600">
                    {{ isset($product) ? 'Ubah informasi produk yang sudah ada' : 'Buat produk baru untuk website desa' }}
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url('dashboard/products') }}"
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
            {{ isset($product) ? 'Form Edit Barang' : 'Form Barang Baru' }}
        </h2>
    </div>

    <div class="p-4 md:p-6">
        <div class="flex flex-col lg:flex-row gap-6">
            {{-- Upload Thumbnail --}}
            <div class="lg:w-1/3">
                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar Produk</label>

                <!-- Input dan preview utama -->
                <div
                    class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg h-48 md:h-64 bg-gray-50 text-gray-500 text-center mb-4 overflow-hidden"
                    id="imageUploadContainer"
                >
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

                    <!-- Tombol aksi untuk preview utama -->
                    <div id="imageActions" class="absolute bottom-3 left-3 z-10 gap-2" style="display: none;">
                        <button id="removePreviewBtn" type="button"
                            class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </div>

                    <input name="images[]" type="file" id="imageInput" class="hidden" accept="image/*" multiple />
                </div>

                <p class="text-xs text-gray-500 mb-4">Maksimal 1MB per gambar</p>

                <!-- Daftar thumbnail preview -->
                <div id="imagePreviewList" class="flex flex-wrap gap-2"></div>
            </div>

            {{-- Form Input --}}
            <div class="lg:w-2/3 space-y-4">
                <input type="hidden" name="productId" id="productId" value="{{ isset($product) ? $product->id : '' }}">
                <!-- Nama Barang -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Barang</label>
                    <input id="nama" type="text" placeholder="Masukkan nama barang..."
                        value="{{ isset($product) ? $product->nama : '' }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Harga Barang -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Harga Barang</label>
                    <input id="harga" type="number" placeholder="Masukkan harga barang..."
                        value="{{ isset($product) ? $product->harga : '' }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Nama Penjual -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Penjual</label>
                    <input id="seller_name" type="text" placeholder="Masukkan nama penjual..."
                        value="{{ isset($product) ? $product->seller_name : '' }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Nomor WhatsApp -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                    <input id="contact_person" type="text" placeholder="08xxxx..."
                        value="{{ isset($product) ? $product->contact_person : '' }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]" />
                </div>

                <!-- Grid untuk Deskripsi dan Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Deskripsi Barang</label>
                        <textarea id="deskripsi" rows="4" placeholder="Masukkan deskripsi..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D] resize-vertical">{{ isset($product) ? $product->deskripsi : '' }}</textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                        <select id="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-[#1B3A6D]">
                            <option value="ready" {{ isset($product) && $product->status == 'ready' ? 'selected' : '' }}>Ready</option>
                            <option value="habis" {{ isset($product) && $product->status == 'habis' ? 'selected' : '' }}>Habis</option>
                            <option value="preorder" {{ isset($product) && $product->status == 'preorder' ? 'selected' : '' }}>Pre-Order</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex flex-col md:flex-row gap-3 md:gap-4 pt-6 border-t border-gray-200 mt-6">
                    <button id="submitBarangBtn"
                        class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition text-sm font-medium w-full md:w-auto">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($product) ? 'Update Barang' : 'Simpan Barang' }}
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
@endsection

@push('addon-script')
<script>
  const isEdit = {{ isset($product) ? 'true' : 'false' }};
  const imageInput = document.getElementById("imageInput");
  const previewImage = document.getElementById("previewImage");
  const uploadPlaceholder = document.getElementById("uploadPlaceholder");
  const imageActions = document.getElementById("imageActions");
  const removePreviewBtn = document.getElementById("removePreviewBtn");
  const imagePreviewList = document.getElementById("imagePreviewList");

  let imageFiles = [];

  imageInput.addEventListener("change", (e) => {
    const files = Array.from(e.target.files);
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
        img.className = "w-20 h-20 object-cover rounded cursor-pointer";
        img.addEventListener("click", () => showPreview(e.target.result));

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

    // Validasi gambar untuk create
    if (imageFiles.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Gambar Diperlukan',
            text: 'Harap pilih minimal satu gambar produk!',
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

    imageFiles.forEach((file) => {
        formData.append("images[]", file);
    });

    // Show loading state
    const button = document.getElementById("submitBarangBtn");
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
    button.disabled = true;

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
            const result = await response.json();
            Swal.fire({
                title: 'Berhasil!',
                text: 'Produk telah disimpan.',
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
            console.error("Gagal menyimpan produk:", errorData);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan',
                text: errorData.message || 'Terjadi kesalahan saat menyimpan produk.',
                customClass: {
                    confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
                },
                buttonsStyling: false
            });
        }
    } catch (error) {
        console.error("Error:", error);
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Terjadi kesalahan saat mengirim data.',
            customClass: {
                confirmButton: 'bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg'
            },
            buttonsStyling: false
        });
    } finally {
        // Reset button state
        button.innerHTML = originalText;
        button.disabled = false;
    }
            alert("Gagal menyimpan produk. Cek console untuk detail.");
        }
    } catch (error) {
        alert("Terjadi kesalahan saat mengirim data.");
        console.error(error);
    }
});
</script>
@endpush
