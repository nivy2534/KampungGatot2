@extends('layouts.app_homepage')

@section('content')
    @include('components.header')
    @include('components.hero')
    @include('components.umkm')
    @include('components.event-section')
    <!-- @include('components.umkm-card') -->

    {{-- Artikel Terbaru --}}
    <section class="py-12 px-6">
        <h2 class="text-2xl font-bold mb-4">Temukan Artikel Terbaru di sini!</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @include('components.article-card', [
                'title' => 'Desa Wisata Dlingo',
                'image' => '/images/article1.jpg',
            ])
            @include('components.article-card', [
                'title' => 'River Wonders Singapore',
                'image' => '/images/article2.jpg',
            ])
            @include('components.article-card', [
                'title' => 'Wisata Kece di Bali & Dompu',
                'image' => '/images/article3.jpg',
            ])
            @include('components.article-card', [
                'title' => 'Pantai Keren di Sumba',
                'image' => '/images/article4.jpg',
            ])
        </div>
    </section>

    {{-- Negara Terbaik --}}
    <section class="py-12 px-6 bg-gray-50">
        <h2 class="text-2xl font-bold mb-6">Rekomendasi Negara Terbaik Dikunjungi 2025</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
            @foreach (['Indonesia', 'India', 'Jepang', 'Thailand', 'Prancis', 'USA'] as $i => $country)
                @include('components.country-card', [
                    'name' => $country,
                    'image' => '/images/country' . ($i + 1) . '.jpg',
                ])
            @endforeach
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="py-12 px-6 bg-white">
        <h2 class="text-2xl font-bold mb-6 text-center">Apa Kata Mereka tentang Produk Kami?</h2>
        <div class="flex justify-center mb-8">
            <video controls class="w-full max-w-3xl rounded shadow">
                <source src="/videos/testimonial.mp4" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                @include('components.testimonial-card', [
                    'name' => 'Elgin Brian Wahyu Bramadhika',
                    'message' =>
                        'Sejak menggunakan Edutech, cara belajar saya jadi jauh lebih menyenangkan! Saya juga bisa mengakses kelas.',
                    'avatar' => '/images/user1.jpg',
                ])
            @endfor
        </div>
    </section>

    @include('components.footer')
@endsection
