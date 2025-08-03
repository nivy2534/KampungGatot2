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

            @if($latestBlogs && $latestBlogs->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($latestBlogs as $blog)
                        <a href="{{ route('blog.show', $blog->slug) }}" class="block">
                            @include('components.article-card', [
                                'title' => $blog->name,
                                'image' => $blog->image_url ? asset($blog->image_url) : 'https://placehold.co/350x200/e2e8f0/1B3A6D?text=Article',
                                'category' => ucfirst(str_replace('_', ' ', $blog->tag)),
                                'excerpt' => $blog->excerpt,
                                'date' => $blog->created_at->translatedFormat('d F Y')
                            ])
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Tidak ada artikel</h3>
                    <p class="text-gray-500">Belum ada artikel yang dipublikasikan saat ini.</p>
                </div>
            @endif

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
