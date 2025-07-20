@extends('layouts.app')

@section('content')
    {{-- Header/Navbar --}}
    @include('components.header')

    <section class="py-16 bg-slate-50 text-center">
        <h1 class="text-4xl font-bold mb-4">Galeri Kampung Gatot</h1>
        <p class="text-gray-600 mb-6">Potret kehidupan, keindahan alam, dan semangat kebersamaan warga Desa Ngabruk.</p>

        <div class="flex justify-center gap-3 flex-wrap mb-10">
            <button class="px-4 py-2 rounded-full bg-blue-600 text-white">Semua</button>
            <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-600">Pemandangan Alam</button>
            <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-600">Kegiatan Warga</button>
            <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-600">UMKM Lokal</button>
        </div>

        <div id="gallery" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
            {{-- Gambar akan diisi lewat JavaScript --}}
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/api/photos')
                .then(response => response.json())
                .then(data => {
                    const gallery = document.getElementById('gallery');
                    data.forEach(photo => {
                        const card = document.createElement('div');
                        card.className = "bg-white rounded-xl shadow hover:shadow-md overflow-hidden";

                        card.innerHTML = `
                            <img src="${photo.url}" alt="${photo.title}" class="w-full h-64 object-cover">
                            <div class="p-4 text-left">
                                <h3 class="font-semibold">${photo.title ?? 'Foto Tanpa Judul'}</h3>
                                <p class="text-sm text-gray-500">${photo.description ?? ''}</p>
                            </div>
                        `;
                        gallery.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error('Gagal memuat galeri:', error);
                });
        });
    </script>


    {{-- Footer --}}
    @include('components.footer')
@endsection