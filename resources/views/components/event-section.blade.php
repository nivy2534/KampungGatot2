<section id="event" class="py-12 px-6 bg-gray-50">
    <div class="container mx-auto">
        {{-- Title --}}
        <div class="text-center mb-8">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">
                Event Kampung Gatot
            </h2>
            <p class="text-base text-gray-600 max-w-xl mx-auto">
                Ikuti berbagai kegiatan menarik dan acara yang diselenggarakan di Kampung Gatot
            </p>
        </div>

        {{-- Filters --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button class="px-4 py-2 bg-[#1B3A6D] text-white rounded-full text-sm font-semibold font-['Poppins'] hover:bg-[#0f2a4f] transition-colors">
                Semua
            </button>
            @foreach (['Saat ini', 'Akan datang', 'Kemarin'] as $filter)
                <button class="px-4 py-2 border border-[#1B3A6D] text-[#1B3A6D] rounded-full text-sm font-medium font-['Poppins'] hover:bg-[#1B3A6D] hover:text-white transition-colors">
                    {{ $filter }}
                </button>
            @endforeach
        </div>

        {{-- Event Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @php
                $events = [
                    ['title' => 'Festival Budaya Kampung Gatot', 'img' => 'https://placehold.co/300x180/e2e8f0/1B3A6D?text=Festival+Budaya', 'price' => 'Gratis', 'date' => '24 - 28 Sep 2025'],
                    ['title' => 'Pameran Produk UMKM Lokal', 'img' => 'https://placehold.co/300x180/f1f5f9/1B3A6D?text=Pameran+UMKM', 'price' => 'Rp 15.000', 'date' => '15 - 17 Okt 2025'],
                    ['title' => 'Workshop Kerajinan Tradisional', 'img' => 'https://placehold.co/300x180/f8fafc/1B3A6D?text=Workshop', 'price' => 'Rp 75.000', 'date' => '5 - 7 Nov 2025'],
                    ['title' => 'Pasar Tani Organik', 'img' => 'https://placehold.co/300x180/e2e8f0/1B3A6D?text=Pasar+Tani', 'price' => 'Gratis', 'date' => '12 - 14 Nov 2025'],
                ];
            @endphp

            @foreach ($events as $event)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                    {{-- Image with label --}}
                    <div class="relative h-40 bg-gray-200 overflow-hidden">
                        <img src="{{ $event['img'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full">
                            <span class="text-[#33AD5C] text-xs font-bold font-['Plus Jakarta Sans']">POPULER</span>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-4 space-y-2">
                        <div class="text-gray-500 text-sm font-medium">
                            {{ $event['date'] }}
                        </div>
                        <h3 class="text-gray-900 text-base font-bold leading-tight">
                            {{ $event['title'] }}
                        </h3>
                        <div class="text-[#1B3A6D] text-lg font-bold">
                            {{ $event['price'] }}
                        </div>
                        <button class="w-full mt-3 bg-[#1B3A6D] text-white py-2 rounded-lg font-semibold hover:bg-[#0f2a4f] transition-colors text-sm">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
