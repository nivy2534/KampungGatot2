@extends('layouts.app')

@section('content')
  @include('components.header')

  {{-- Detail Produk --}}
  <section class="px-6 py-12 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
    {{-- Gambar Utama dan Thumbnail --}}
    <div>
      <div class="bg-gray-200 aspect-square w-full rounded-xl flex items-center justify-center">
        {{-- Replace with product image --}}
        <span class="text-gray-400">[ Image Here ]</span>
      </div>
      <div class="flex gap-4 mt-4">
        {{-- Replace with thumbnails --}}
        <div class="w-20 h-20 bg-gray-300 rounded-lg overflow-hidden">
          <img src="/assets/img/model1.png" alt="" class="object-cover w-full h-full">
        </div>
        <div class="w-20 h-20 bg-gray-300 rounded-lg overflow-hidden">
          <img src="/assets/img/model2.png" alt="" class="object-cover w-full h-full">
        </div>
        <div class="w-20 h-20 bg-gray-300 rounded-lg overflow-hidden">
          <img src="/assets/img/model3.png" alt="" class="object-cover w-full h-full">
        </div>
      </div>
    </div>

    {{-- Info Produk --}}
    <div>
      <h2 class="text-2xl font-semibold text-gray-800 mb-2">Event Kampung Gatot</h2>
      <p class="text-sm text-gray-500 mb-1">24 - 28 Sep 2025</p>
      <p class="text-2xl font-bold text-blue-700 mb-4">Rp 275.000</p>
      <p class="text-gray-700 mb-6">
        A stylish solid tone casual set featuring a sleeveless tank top with a square neckline and an outerwear,
        paired with a high-rise midi skirt with ruffle details. Designed for a regular fit,
        the top offers a slip-on style, while the skirt comes with a zip and hook fastening.
      </p>
      <button class="bg-blue-700 text-white px-5 py-3 rounded-full font-medium hover:bg-blue-800 transition mb-4">
        Hubungi Penjual
      </button>

      {{-- Bagikan --}}
      <div class="mt-4">
        <p class="text-sm text-gray-600 mb-2">Bagikan</p>
        <div class="flex gap-4 text-blue-600">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-tiktok"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </section>

  {{-- Produk Terkait --}}
  <section class="px-6 pb-20 max-w-7xl mx-auto">
    <h3 class="text-xl font-semibold text-gray-800 mb-6">Event Kampung Gatot</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      {{-- Card Produk --}}
      @foreach ($relatedProducts as $product)
        <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
          <img src="{{ $product->thumbnail }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
          <div class="p-4">
            <span class="inline-block bg-green-500 text-white text-xs px-3 py-1 rounded-full mb-2">BIG DEALS</span>
            <p class="text-sm text-gray-500">{{ $product->date }}</p>
            <h4 class="text-gray-800 font-semibold">{{ $product->title }}</h4>
            <p class="text-blue-700 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  @include('components.footer')
@endsection
