<section id="event" class="py-12 px-6 bg-gray-50">
    <div class="container mx-auto max-w-7xl">
        {{-- Header: Title + Filter --}}
        <div class="mb-8 px-2">
            {{-- Title --}}
            <div class="mb-4">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">
                    Event Kampung Gatot
                </h2>
                <p class="text-base text-gray-600 max-w-xl">
                    Ikuti berbagai kegiatan menarik dan acara yang diselenggarakan di Kampung Gatot
                </p>
            </div>

            {{-- Filters --}}
            <div class="flex flex-wrap justify-start gap-2">
                <button class="px-4 py-2 bg-[#1B3A6D] text-white rounded-full text-sm font-semibold font-['Poppins'] hover:bg-[#0f2a4f] transition-colors">
                    Semua
                </button>
                @foreach (['Saat ini', 'Akan datang', 'Kemarin'] as $filter)
                    <button class="px-4 py-2 border border-[#1B3A6D] text-[#1B3A6D] rounded-full text-sm font-medium font-['Poppins'] hover:bg-[#1B3A6D] hover:text-white transition-colors">
                        {{ $filter }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Event Cards --}}
        <div class="px-2">
            @php
                $cards = [
                    ['title' => 'Gatot basah', 'img' => 'assets/img/gal1.png', 'price' => 'Rp 20.000', 'date' => '24 - 28 Sep 2025', 'type' => 'Event'],
                    ['title' => 'Pameran Produk UMKM Lokal', 'img' => 'assets/img/gal2.png', 'price' => 'Rp 20.000', 'date' => '24 - 28 Sep 2025', 'type' => 'Event'],
                    ['title' => 'Keripik Singkong Pedas', 'img' => 'assets/img/gal3.png', 'price' => 'Rp 75.000', 'date' => 'Kadaluarsa dalam 1 hari', 'type' => 'Produk'],
                    ['title' => 'Sambal Botol Homemade', 'img' => 'assets/img/gal4.png', 'price' => 'Rp 75.000', 'date' => 'Kadaluarsa dalam 1 hari', 'type' => 'Produk'],
                ];
            @endphp

            <div class="flex flex-wrap gap-5">
                @foreach ($cards as $card)
                    <div class="w-full sm:w-[48%] lg:w-[23%] bg-white rounded-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        {{-- Image + Badge --}}
                        <div class="relative">
                            <img src="{{ asset($card['img']) }}" alt="{{ $card['title'] }}" class="w-full h-40 object-cover">
                            <div class="absolute top-2 left-2 bg-white px-2 py-1 rounded shadow text-green-600 text-xs font-bold">
                                {{ $card['type'] }}
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="px-4 py-3 space-y-1">
                            <p class="text-sm text-gray-600 font-semibold">{{ $card['date'] }}</p>
                            <h3 class="text-base font-bold text-gray-800">{{ $card['title'] }}</h3>
                            <p class="text-lg font-bold text-blue-800">{{ $card['price'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
