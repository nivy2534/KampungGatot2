@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
  <div class="p-[50px]">
    <div class="flex justify-between items-center h-[90px] border-b border-[#D9D9D9]">
      <div class="text-[32px] font-semibold">Detail Produk</div>
      <div class="text-[20px]">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}</div>
    </div>

    <div class="flex gap-[64px] mt-[85px]">
      {{-- Preview Gambar Produk --}}
      <div class="w-[402px]">
        <div class="bg-[#BCBCBC] h-[402px] rounded-[13.4px] overflow-hidden">
          <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : '/placeholder.png' }}" alt="Gambar Produk" class="w-full h-full object-cover">
        </div>
      </div>

      {{-- Deskripsi Produk --}}
      <div class="flex-1">
        <div class="text-[32px] font-medium mb-2">{{ $product->name }}</div>

        <div class="text-[#1B3A6D] font-bold text-[20px] mb-1">
          Tipe: <span class="uppercase">{{ ucfirst($product->type) }}</span>
        </div>

        <div class="text-gray-600 text-base mb-1">
          Harga: <span class="font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        </div>

        <div class="text-gray-700 text-sm mb-1">
          Penjual: <strong>{{ $product->seller_name }}</strong>
        </div>

        <div class="text-gray-600 italic text-sm mb-4">
          WhatsApp: <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->seller_whatsapp) }}" target="_blank" class="text-green-600 underline">{{ $product->seller_whatsapp }}</a>
        </div>

        <p class="mb-[20px] text-justify">{{ $product->description }}</p>

        <a href="{{ route('admin.products.index') }}" class="bg-[#1B3A6D] text-white py-2 px-4 rounded-[8px] inline-block">Kembali</a>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<script>
 document.getElementById("submitBarangBtn").addEventListener("click", async function () {
    const formData = new FormData();
    const imageFile = imageFiles[0]; // hanya satu gambar

    formData.append("name", document.getElementById("nama").value);
    formData.append("price", document.getElementById("harga").value);
    formData.append("description", document.getElementById("deskripsi").value);
    formData.append("status", document.getElementById("status").value);
    formData.append("seller_name", document.getElementById("seller_name").value);
    formData.append("whatsapp_number", document.getElementById("whatsapp_number").value);
    if (imageFile) formData.append("image", imageFile);

    try {
        const response = await fetch("{{ route('admin.product.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: formData
        });

        const result = await response.json();
        if (response.ok) {
            alert("Produk berhasil disimpan");
            window.location.href = "{{ url('products') }}";
        } else {
            alert(result.message || "Terjadi kesalahan");
        }
    } catch (err) {
        alert("Gagal mengirim data");
    }
});
</script>
@endpush
