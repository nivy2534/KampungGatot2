@extends('layouts.app')

@section('content')
  {{-- Header --}}
  @include('components.header')

  {{-- Hero Section --}}
  <section class="bg-cover bg-center py-24 px-6 text-white text-center" style="background-image: url('/assets/img/bloghero.png')">
    <h1 class="text-4xl font-bold mb-2">Blog Kampung Gatot</h1>
    <p class="text-lg">Menjelajahi Cerita, Potensi, dan Kehidupan di Kampung Gatot.</p>
  </section>

  {{-- Filter & Search --}}
  <section class="py-10 px-6 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
      <input type="text" placeholder="Cari" class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      <div class="flex flex-wrap gap-2">
        <button class="px-4 py-2 rounded-full bg-blue-600 text-white text-sm">Semua</button>
        <button class="px-4 py-2 rounded-full border text-sm">Sejarah</button>
        <button class="px-4 py-2 rounded-full border text-sm">Potensi Desa</button>
        <button class="px-4 py-2 rounded-full border text-sm">Kabar Warga</button>
        <button class="px-4 py-2 rounded-full border text-sm">UMKM Lokal</button>
      </div>
    </div>

    {{-- Articles Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @for ($i = 0; $i < 12; $i++)
        @include('components.article-card', [
          'title' => 'Asal–Usul Nama dan Sejarah Berdirinya Desa Ngebruk',
          'date' => '8 Juli 2025',
          'category' => 'Sejarah',
          'excerpt' => 'Menelusuri jejak masa lalu dan cerita para leluhur yang membangun Desa Ngebruk hingga menjadi seperti sekarang',
          'image' => '/assets/img/blogthumb.png'
        ])
      @endfor
    </div>

    {{-- Pagination --}}
    <div class="mt-10 flex justify-center">
      <nav class="inline-flex items-center space-x-2">
        <button class="px-3 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">&laquo;</button>
        <button class="px-3 py-2 rounded-lg bg-blue-600 text-white">1</button>
        <button class="px-3 py-2 rounded-lg border hover:bg-gray-100">2</button>
        <button class="px-3 py-2 rounded-lg border hover:bg-gray-100">3</button>
        <button class="px-3 py-2 rounded-lg border hover:bg-gray-100">...</button>
        <button class="px-3 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">&raquo;</button>
      </nav>
    </div>
  </section>

  {{-- Footer --}}
  @include('components.footer')
@endsection
