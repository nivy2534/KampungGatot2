@extends('layouts.app')

@section('content')
  @include('components.header')

  <!-- Hero Section -->
  <section class="bg-cover bg-center py-24" style="background-image: url('/assets/img/shopthumb.png');">
    <div class="container mx-auto text-center text-white">
      <h1 class="text-4xl font-bold">Blog Desa Ngebruk</h1>
      <p class="mt-2 text-lg">Menjelajah Cerita, Potensi, dan Kehidupan di Desa Ngebruk.</p>
    </div>
  </section>

  <!-- Product Grid -->
  <section class="py-12 px-4 md:px-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
      @for($i = 0; $i < 8; $i++)
        <a href="/produk-detail">
          <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
            <img src="/assets/img/belanja.png" alt="Product" class="w-full h-48 object-cover">
            <div class="p-4">
              <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">BIG DEALS</span>
              <p class="text-sm text-gray-500 mt-2">24 – 28 Sep 2025</p>
              <h3 class="font-semibold mt-1">Jakarta – Surabaya</h3>
              <p class="text-blue-600 font-bold mt-1">Rp 275.000</p>
            </div>
          </div>
        </a>
      @endfor
    </div>
  </section>

  @include('components.footer')
@endsection
