@extends('layouts.app_dashboard')

@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-lg shadow">
    <div class="bg-gray-200 px-4 py-2 border-b">
        <h2 class="font-semibold text-sm text-gray-800">Tambah Barang</h2>
    </div>

    <div class="p-6">
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Upload Thumbnail --}}
            <div class="md:w-1/3">
            <label class="block mb-2 font-medium">Gambar Produk</label>

            <!-- Input dan preview utama -->
            <div
                class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-md h-64 bg-gray-50 text-gray-500 text-center mb-4 overflow-hidden"
                id="imageUploadContainer"
            >
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

                <!-- Tombol aksi untuk preview utama -->
                <div id="imageActions"
                class="hidden absolute bottom-4 left-4 z-10 flex gap-2">
                <button id="removePreviewBtn" type="button"
                    class="bg-white/80 text-red-600 px-2 py-1 text-sm rounded hover:bg-red-100">
                    ❌
                </button>
                </div>

                <input name="images[]" type="file" id="imageInput" class="hidden" accept="image/*" multiple />
            </div>

            <p class="text-xs text-gray-400 mb-4">Maksimal 1MB per gambar</p>

            <!-- Daftar thumbnail preview -->
            <div id="imagePreviewList" class="flex flex-wrap gap-2"></div>
         </div>



            {{-- Form Input --}}
            <div class="md:w-2/3 space-y-4">
                <!-- Nama Barang -->
                <div>
                    <label class="block mb-1 font-medium">Nama Barang</label>
                    <input id="nama" type="text" placeholder="Masukkan nama barang..."
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Harga Barang -->
                <div>
                    <label class="block mb-1 font-medium">Harga Barang</label>
                    <input id="harga" type="number" placeholder="Masukkan harga barang..."
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Nama Penjual -->
                <div>
                    <label class="block mb-1 font-medium">Nama Penjual</label>
                    <input id="seller_name" type="text" placeholder="Masukkan nama penjual..."
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Nomor WhatsApp -->
                <div>
                    <label class="block mb-1 font-medium">Nomor WhatsApp</label>
                    <input id="contact_person" type="text" placeholder="08xxxx..."
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block mb-1 font-medium">Deskripsi Barang</label>
                    <textarea id="deskripsi" rows="4" placeholder="Masukkan deskripsi..."
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Status -->
                <div>
                    <label class="block mb-1 font-medium">Status</label>
                    <select id="status"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="ready">Ready</option>
                        <option value="habis">Habis</option>
                        <option value="preorder">Pre-Order</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex gap-2">
                    <button id="submitBarangBtn"
                        class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-800 transition">
                        Simpan
                    </button>
                    <a href="{{ url('products') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
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
    const formData = new FormData();
    const imageFile = imageFiles[0]; // hanya ambil satu gambar utama

    // Ambil nilai dari input
    formData.append("name", document.getElementById("nama").value);
    formData.append("price", document.getElementById("harga").value);
    formData.append("seller_name", document.getElementById("seller_name").value);
    formData.append("contact_person", document.getElementById("contact_person").value);
    formData.append("description", document.getElementById("deskripsi").value);
    formData.append("status", document.getElementById("status").value);

    if (imageFile) {
        formData.append("image", imageFile);
    }

    try {
        const response = await fetch("{{ url('products/save') }}", {
            method: "POST",
            headers: {
                "Accept":"application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: formData
        }); 

        if (response.ok) {
            const result = await response.json();
            alert("Produk berhasil disimpan!");
            window.location.href = "{{ url('products') }}";
        } else {
            const text = await response.text();
            console.error("Gagal menyimpan produk. Isi response:", text);
            alert("Gagal menyimpan produk. Cek console untuk detail.");
        }
    } catch (error) {
        alert("Terjadi kesalahan saat mengirim data.");
        console.error(error);
    }
});
</script>
@endpush
