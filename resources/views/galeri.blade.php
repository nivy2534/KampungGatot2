@extends('layouts.app')

@section('content')
    @include('components.header')

    <section class="py-16 bg-slate-50 text-center">
        <h1 class="text-4xl font-bold mb-4">{{ $title }}</h1>
        <p class="text-gray-600 mb-6">Potret kehidupan, keindahan alam, dan semangat kebersamaan warga Desa Ngabruk.</p>

        <div class="flex justify-center gap-3 flex-wrap mb-10">
            <button class="px-4 py-2 rounded-full bg-blue-600 text-white">Semua</button>
            <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-600">Pemandangan Alam</button>
            <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-600">Kegiatan Warga</button>
            <button class="px-4 py-2 rounded-full border border-gray-400 text-gray-600">UMKM Lokal</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
            @forelse ($photos as $photo)
                <div class="bg-white rounded-xl shadow hover:shadow-md overflow-hidden">
                    <img src="{{ asset('storage/photos/' . ($photo->photo_name ?? 'default.jpg')) }}" alt="{{ $photo->photo_description ?? 'Foto' }}" class="w-full h-64 object-cover">
                    <div class="p-4 text-left">
                        <h3 class="font-semibold">{{ $photo->photo_name }}</h3>
                        <p class="text-sm text-gray-500">{{ $photo->photo_description }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($photo->photo_date)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-full">Belum ada foto yang tersedia.</p>
            @endforelse
        </div>
    </section>

    @include('components.footer')
@endsection
