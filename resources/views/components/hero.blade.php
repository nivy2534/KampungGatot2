<section class="relative w-full h-[85vh] overflow-hidden">
    <img src="{{ asset('assets/img/hero1.png') }}" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <div class="relative z-10 container mx-auto px-6 h-full flex items-center">
        <div class="max-w-2xl">
            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight text-white mb-4 font-['Plus Jakarta Sans']">
                Selamat Datang di Kampung Gatot
            </h1>
            <p class="text-base md:text-lg leading-relaxed text-white/90 mb-6 max-w-xl">
                Jelajahi keindahan alam, kearifan lokal, dan produk UMKM berkualitas dari masyarakat Kampung Gatot yang penuh dengan keramahan dan tradisi.
            </p>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="#umkm" class="inline-flex items-center justify-center bg-[#1B3A6D] text-white px-6 py-3 rounded-lg font-semibold font-['Poppins'] hover:bg-[#0f2a4f] transition-colors">
                    Jelajahi UMKM
                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.293 3.293a1 1 0 011.414 0L18 7.586a1 1 0 010 1.414l-4.293 4.293a1 1 0 01-1.414-1.414L14.586 9H4a1 1 0 110-2h10.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#event" class="inline-flex items-center justify-center bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-lg font-semibold font-['Poppins'] hover:bg-white/30 transition-colors border border-white/30">
                    Lihat Event
                </a>
            </div>
        </div>
    </div>
</section>
