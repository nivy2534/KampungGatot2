@extends('layouts.app_homepage')

@section('content')
  @include('components.header')
  @include('components.hero')
  @include('components.umkm')
  @include('components.event-section')

  {{-- Artikel & Berita Terbaru --}}
    {{-- Artikel & Berita Terbaru --}}
  <section class="py-12 px-6 bg-white">
    <div class="container mx-auto">
      <div class="text-center mb-8">
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Artikel & Berita Terbaru</h2>
        <p class="text-base text-gray-600 max-w-xl mx-auto">
          Temukan informasi terkini seputar kegiatan, perkembangan, dan cerita inspiratif dari Kampung Gatot
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @include('components.article-card', [
          'title' => 'Inovasi Pertanian Organik di Kampung Gatot',
          'image' => 'https://placehold.co/350x200/e2e8f0/1B3A6D?text=Pertanian+Organik',
          'category' => 'Pertanian',
          'excerpt' => 'Mengenal sistem pertanian organik yang dikembangkan warga untuk meningkatkan hasil panen.',
          'date' => '15 Juli 2025'
        ])
        @include('components.article-card', [
          'title' => 'Festival Kerajinan Tangan Kampung Gatot',
          'image' => 'https://placehold.co/350x200/f1f5f9/1B3A6D?text=Kerajinan+Tangan',
          'category' => 'Budaya',
          'excerpt' => 'Perayaan seni dan budaya lokal melalui pameran kerajinan tangan khas daerah.',
          'date' => '12 Juli 2025'
        ])
        @include('components.article-card', [
          'title' => 'Program Digitalisasi UMKM Lokal',
          'image' => 'https://placehold.co/350x200/f8fafc/1B3A6D?text=Digitalisasi+UMKM',
          'category' => 'Teknologi',
          'excerpt' => 'Langkah revolusioner untuk membawa UMKM lokal ke era digital.',
          'date' => '10 Juli 2025'
        ])
        @include('components.article-card', [
          'title' => 'Wisata Alam Tersembunyi Kampung Gatot',
          'image' => 'https://placehold.co/350x200/e2e8f0/1B3A6D?text=Wisata+Alam',
          'category' => 'Pariwisata',
          'excerpt' => 'Jelajahi destinasi wisata alam yang menawan di sekitar Kampung Gatot.',
          'date' => '8 Juli 2025'
        ])
      </div>

      <div class="text-center mt-8">
        <a href="/blog" class="inline-flex items-center gap-2 bg-[#1B3A6D] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#0f2a4f] transition-colors">
          Lihat Semua Artikel
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
          </svg>
        </a>
      </div>
    </div>
  </section>

  {{-- Produk Unggulan UMKM --}}
  <section class="py-16 px-6 bg-gray-50">
    <div class="container mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Produk Unggulan UMKM</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Dukung ekonomi lokal dengan produk berkualitas dari pengrajin dan petani Kampung Gatot
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @for($i = 0; $i < 6; $i++)
          <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
            <div class="relative h-48 bg-gray-200 overflow-hidden">
              <img src="https://placehold.co/300x200/{{ ['e2e8f0', 'f1f5f9', 'f8fafc'][$i % 3] }}/1B3A6D?text=Produk+{{ $i + 1 }}"
                   alt="Produk UMKM" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <div class="absolute top-4 right-4 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                -20%
              </div>
            </div>
            <div class="p-6 space-y-3">
              <h3 class="text-gray-900 text-lg font-bold">
                {{ ['Kerajinan Bambu', 'Batik Tulis', 'Madu Murni', 'Kopi Robusta', 'Tas Pandan', 'Makanan Tradisional'][$i] }}
              </h3>
              <div class="flex items-center gap-2">
                <span class="text-[#1B3A6D] text-xl font-bold">Rp {{ number_format([50000, 150000, 75000, 45000, 85000, 25000][$i], 0, ',', '.') }}</span>
                <span class="text-gray-400 text-sm line-through">Rp {{ number_format([62500, 187500, 93750, 56250, 106250, 31250][$i], 0, ',', '.') }}</span>
              </div>
              <div class="flex items-center gap-1 text-sm text-gray-500">
                <svg class="w-4 h-4 fill-yellow-400" viewBox="0 0 24 24">
                  <path d="M12 2L14.97 8.72L22.29 9.64L17 14.89L18.36 22.13L12 18.52L5.64 22.13L7 14.89L1.71 9.64L9.03 8.72L12 2Z" />
                </svg>
                <span>4.{{ 5 + $i % 4 }}</span>
                <span>({{ 10 + $i * 3 }} ulasan)</span>
              </div>
              <button class="w-full bg-[#1B3A6D] text-white py-3 rounded-lg font-semibold hover:bg-[#0f2a4f] transition-colors">
                Beli Sekarang
              </button>
            </div>
          </div>
        @endfor
      </div>

      <div class="text-center mt-10">
        <a href="/event" class="inline-flex items-center gap-2 bg-[#1B3A6D] text-white px-8 py-4 rounded-xl font-semibold hover:bg-[#0f2a4f] transition-colors">
          Lihat Semua Produk
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
          </svg>
        </a>
      </div>
    </div>
  </section>

  {{-- Testimoni Warga --}}
  <section class="py-16 px-6 bg-white">
    <div class="container mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Testimoni Warga & Pengunjung</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Dengarkan cerita inspiratif dari warga dan pengunjung yang merasakan kebaikan Kampung Gatot
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @include('components.testimonial-card', [
          'name' => 'Siti Nurhaliza',
          'message' => 'Produk UMKM di Kampung Gatot sangat berkualitas dan ramah lingkungan. Saya selalu membeli kerajinan tangan dari sini!',
          'avatar' => 'https://placehold.co/80x80/e2e8f0/1B3A6D?text=SN'
        ])
        @include('components.testimonial-card', [
          'name' => 'Ahmad Wijaya',
          'message' => 'Event-event di Kampung Gatot selalu menarik dan edukatif. Tempat yang sempurna untuk belajar tentang budaya lokal.',
          'avatar' => 'https://placehold.co/80x80/f1f5f9/1B3A6D?text=AW'
        ])
        @include('components.testimonial-card', [
          'name' => 'Maya Sari',
          'message' => 'Komunitas di Kampung Gatot sangat hangat dan ramah. Pengalaman berbelanja di sini selalu menyenangkan!',
          'avatar' => 'https://placehold.co/80x80/f8fafc/1B3A6D?text=MS'
        ])
      </div>
    </div>
  </section>

  @include('components.footer')
@endsection
