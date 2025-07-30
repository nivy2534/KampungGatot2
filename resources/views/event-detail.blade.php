@extends('layouts.app')

@php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
  {{-- Header --}}
  @include('components.header')

  {{-- Main Content --}}
  <article class="py-8 px-4 sm:px-6 lg:px-8 bg-white min-h-screen">
    <div class="max-w-6xl mx-auto">

      {{-- Breadcrumb --}}
      <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('event') }}" class="hover:text-[#1B3A6D] transition-colors">Produk</a>
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-gray-700">{{ $product->name }}</span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
        {{-- Product Images --}}
        <div>
          @if($product->image_url)
          <div class="mb-4">
            <img
              src="{{ asset('storage/' . $product->image_path) }}"
              alt="{{ $product->name }}"
              class="w-full h-96 object-cover rounded-lg shadow-sm"
              id="mainImage"
            >
          </div>

          {{-- Thumbnail images --}}
          @php
            // Cek gambar yang benar-benar ada di direktori
            $productSlug = Str::slug($product->name);
            $productFolder = "products/{$productSlug}";
            $availableImages = [];
            
            // Tambahkan gambar utama jika ada dan path-nya benar-benar exists
            if($product->image_url && $product->image_path && Storage::disk('public')->exists($product->image_path)) {
              $availableImages[] = [
                'url' => asset('storage/' . $product->image_path), // Sudah full URL dari Storage::url()
                'path' => $product->image_path,
                'is_main' => true
              ];
            }
            
            // Tambahkan gambar tambahan yang benar-benar ada di storage (kecuali yang sama dengan gambar utama)
            if($product->images && $product->images->count() > 0) {
              foreach($product->images as $image) {
                // Skip gambar jika path-nya sama dengan gambar utama (untuk menghindari duplikasi)
                if($image->image_path && Storage::disk('public')->exists($image->image_path) && 
                   $image->image_path !== $product->image_path) {
                  $availableImages[] = [
                    'url' => asset('storage/' . $image->image_path), // Sudah full URL dari Storage::url()
                    'path' => $image->image_path,
                    'is_main' => false
                  ];
                }
              }
            }
            
            $totalImages = count($availableImages);
          @endphp
          
          @if($totalImages > 1)
          <div class="grid grid-cols-4 gap-2">
            @foreach($availableImages as $index => $image)
            <img
              src="{{ $image['url'] }}"
              alt="{{ $product->name }}"
              class="w-full h-20 object-cover rounded cursor-pointer border-2 {{ $index === 0 ? 'border-[#1B3A6D]' : 'border-transparent hover:border-[#1B3A6D]' }} thumbnail-image"
              onclick="changeMainImage('{{ $image['url'] }}')"
            >
            @endforeach
          </div>
          @elseif($totalImages == 1)
          {{-- Jika hanya ada satu gambar, tampilkan satu thumbnail --}}
          <div class="grid grid-cols-4 gap-2">
            <img
              src="{{ $availableImages[0]['url'] }}"
              alt="{{ $product->name }}"
              class="w-full h-20 object-cover rounded cursor-pointer border-2 border-[#1B3A6D] thumbnail-image"
              onclick="changeMainImage('{{ $availableImages[0]['url'] }}')"
            >
          </div>
          @endif
          @else
          <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
            <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
            </svg>
          </div>
          @endif
        </div>

        {{-- Product Info --}}
        <div>
          <div class="mb-4">
            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
              {{ ucfirst($product->status) }}
            </span>
          </div>

          <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
            {{ $product->name }}
          </h1>

          <div class="mb-6">
            <div class="text-3xl font-bold text-[#1B3A6D] mb-2">
              Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
          </div>

          {{-- Seller Info --}}
          <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Penjual</h3>
            <div class="space-y-3">
              <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-700">{{ $product->seller_name ?: $product->author_name }}</span>
              </div>

              @if($product->contact_person)
              <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                </svg>
                <span class="text-gray-700">{{ $product->contact_person }}</span>
              </div>
              @endif

              <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-700">Terdaftar {{ $product->created_at->format('d F Y') }}</span>
              </div>
            </div>
          </div>

          {{-- Contact Buttons --}}
          <div class="space-y-3">
            @if($product->contact_person)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->contact_person) }}?text=Halo, saya tertarik dengan produk {{ $product->name }}"
               target="_blank"
               class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 transition-colors flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
              </svg>
              Hubungi via WhatsApp
            </a>
            @endif
          </div>
        </div>
      </div>

      {{-- Product Description --}}
      <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Deskripsi Produk</h2>
        <div class="prose prose-lg max-w-none">
          <div class="text-gray-700 leading-relaxed">
            {!! nl2br(e($product->description)) !!}
          </div>
        </div>
      </div>
    </div>
  </article>

  {{-- Related Products --}}
  @if($relatedProducts->count() > 0)
  <section class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-2xl font-bold text-gray-900 mb-8">Produk Terkait</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($relatedProducts as $relatedProduct)
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
          <a href="{{ route('event.show', $relatedProduct->slug) }}" class="block">
            @if($relatedProduct->image_url)
            <div class="aspect-w-1 aspect-h-1">
              <img
                src="{{ $relatedProduct->image_url }}"
                alt="{{ $relatedProduct->name }}"
                class="w-full h-48 object-cover"
              >
            </div>
            @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
              <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
              </svg>
            </div>
            @endif

            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-[#1B3A6D] transition-colors">
                {{ $relatedProduct->name }}
              </h3>

              <div class="text-xl font-bold text-[#1B3A6D] mb-2">
                Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
              </div>

              <div class="flex items-center justify-between text-xs text-gray-500">
                <span>{{ $relatedProduct->seller_name ?: $relatedProduct->author_name }}</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full">
                  {{ ucfirst($relatedProduct->status) }}
                </span>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- Footer --}}
  @include('components.footer')
@endsection

@push('scripts')
<script>
function changeMainImage(src) {
  document.getElementById('mainImage').src = src;

  // Update thumbnail borders
  document.querySelectorAll('.thumbnail-image').forEach(img => {
    img.classList.remove('border-[#1B3A6D]');
    img.classList.add('border-transparent');
  });

  // Add border to clicked thumbnail
  const clickedThumbnail = document.querySelector(`.thumbnail-image[onclick="changeMainImage('${src}')"]`);
  if (clickedThumbnail) {
    clickedThumbnail.classList.remove('border-transparent');
    clickedThumbnail.classList.add('border-[#1B3A6D]');
  }
}
</script>
@endpush

@push('styles')
<style>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
@endpush
