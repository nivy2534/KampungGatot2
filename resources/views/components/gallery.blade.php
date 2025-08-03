<section class="py-16 px-6 bg-white">
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-start gap-12">
        {{-- Kiri: Teks dan CTA --}}
        <div class="flex-1 space-y-6">
            <p class="text-sm text-[#4B4B4B] font-medium tracking-wide">GALERI</p>
            <h2 class="text-3xl font-bold text-black leading-snug">Potret Kehidupan dan Keindahan Desa</h2>
            <p class="text-base text-gray-700 leading-relaxed">
                Lihat momen istimewa, tradisi, dan keindahan alam Kampung Gatot yang terekam dalam setiap gambar.
            </p>
            <a href="/galeri" class="inline-flex items-center gap-2 bg-[#1B3A6D] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#0f2a4f] transition-all">
                Lihat Selengkapnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        {{-- Kanan: 2x2 Galeri Grid --}}
        <div class="w-full lg:w-[700px] grid grid-cols-2 gap-4">
            @php
                $galleryItems = [
                    ['img' => 'assets/img/gal1.jpeg', 'title' => 'Sosialisasi UMKM'],
                    ['img' => 'assets/img/gal2.jpeg', 'title' => 'Foto Bersama UMKM'],
                    ['img' => 'assets/img/gal3.jpeg', 'title' => 'Barsih Desa'],
                    ['img' => 'assets/img/gal4.jpeg', 'title' => 'Praktik'],
                ];
            @endphp

            @foreach ($galleryItems as $item)
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    <img src="{{ asset($item['img']) }}" alt="{{ $item['title'] }}"
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/60"></div>
                    <div class="absolute bottom-3 left-4 text-white font-semibold text-sm md:text-base">
                        {{ $item['title'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
