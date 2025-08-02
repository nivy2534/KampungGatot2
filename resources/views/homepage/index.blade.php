@extends('layouts.app_homepage')

@section('content')
    @include('components.header')
    @include('components.hero')
    @include('components.umkm')
    @include('components.event-section')

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
                @forelse($latestBlogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}" class="block">
                        @include('components.article-card', [
                            'title' => $blog->name,
                            'image' => $blog->image_url ? asset($blog->image_url) : 'https://placehold.co/350x200/e2e8f0/1B3A6D?text=Article',
                            'category' => ucfirst(str_replace('_', ' ', $blog->tag)),
                            'excerpt' => $blog->excerpt,
                            'date' => $blog->created_at->translatedFormat('d F Y')
                        ])
                    </a>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2m-6 4h6a2 2 0 002-2v-6a2 2 0 00-2-2h-6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak ada artikel</h3>
                        <p class="text-sm text-gray-500">Artikel akan tampil di sini ketika sudah tersedia.</p>
                    </div>
                @endforelse
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
    <section class="py-12 px-6 bg-gray-50">
      @include('components.gallery')
    </section>

    {{-- Dokumentasi --}}
    @include('components.documentary')

    {{-- Testimoni Warga --}}
    <section class="py-12 px-6 bg-white">
        <div class="container mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Testimoni Warga & Pengunjung</h2>
                <p class="text-base text-gray-600 max-w-xl mx-auto">
                    Dengarkan cerita inspiratif dari warga dan pengunjung yang merasakan kebaikan Kampung Gatot
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
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
