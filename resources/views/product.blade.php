@extends('layouts.app')

@section('content')
  @include('components.header')

  <!-- Product Detail Section -->
  <section class="py-12 px-4 md:px-12">
    <div class="grid md:grid-cols-2 gap-8 items-start">

      <!-- Left: Product Image & Thumbnails -->
      <div>
        <div class="bg-gray-100 w-full aspect-square flex items-center justify-center rounded-lg mb-4">
          <span class="text-gray-400 text-4xl">Image</span>
        </div>
        <div class="flex gap-4">
          @for($i = 0; $i < 3; $i++)
            <div class="w-24 h-24 rounded-lg bg-gray-200 flex items-center justify-center">
              <span class="text-gray-400">Img</span>
            </div>
          @endfor
        </div>
      </div>

      <!-- Right: Product Info -->
      <div>
        <h1 class="text-2xl font-bold mb-1">Event Kampung Gatot</h1>
        <p class="text-gray-500 mb-2">24 – 28 Sep 2025</p>
        <p class="text-blue-600 text-xl font-bold mb-4">Rp 275.000</p>
        <p class="text-gray-700 mb-6 leading-relaxed">
          A stylish solid tone casual set featuring a sleeveless tank top with a square neckline and an outerwear,
          paired with a high-rise midi skirt with ruffle details. Designed for a regular fit, the top offers a
          slip-on style, while the skirt comes with a zip and hook fastening.
        </p>
        <a href="#" class="inline-flex items-center bg-blue-700 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition">
          Hubungi Penjual
        </a>

        <!-- Social Media Share -->
        <div class="mt-6">
          <p class="font-medium mb-2">Bagikan</p>
          <div class="flex gap-3 text-2xl text-gray-500">
            <a href="#"><i class="fab fa-facebook-square hover:text-blue-600"></i></a>
            <a href="#"><i class="fab fa-instagram hover:text-pink-600"></i></a>
            <a href="#"><i class="fab fa-tiktok hover:text-black"></i></a>
            <a href="#"><i class="fab fa-youtube hover:text-red-600"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Related Products Section -->
  <section class="py-12 px-4 md:px-12">
    <h2 class="text-xl font-bold mb-6">Event Kampung Gatot</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
      @for($i = 0; $i < 4; $i++)
        <a href="/produk-detail">
          <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
            <img src="/assets/img/belanja2.png" alt="Product" class="w-full h-48 object-cover">
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
