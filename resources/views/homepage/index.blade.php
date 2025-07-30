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
                    @for($i = 0; $i < 4; $i++)
                        @include('components.article-card', [
                            'title' => ['Inovasi Pertanian Organik di Kampung Gatot', 'Festival Kerajinan Tangan Kampung Gatot', 'Program Digitalisasi UMKM Lokal', 'Wisata Alam Tersembunyi Kampung Gatot'][$i],
                            'image' => 'https://placehold.co/350x200/e2e8f0/1B3A6D?text=Article+' . ($i + 1),
                            'category' => ['Pertanian', 'Budaya', 'Teknologi', 'Pariwisata'][$i],
                            'excerpt' => ['Mengenal sistem pertanian organik yang dikembangkan warga untuk meningkatkan hasil panen.', 'Perayaan seni dan budaya lokal melalui pameran kerajinan tangan khas daerah.', 'Langkah revolusioner untuk membawa UMKM lokal ke era digital.', 'Jelajahi destinasi wisata alam yang menawan di sekitar Kampung Gatot.'][$i],
                            'date' => now()->subDays($i)->translatedFormat('d F Y')
                        ])
                    @endfor
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
