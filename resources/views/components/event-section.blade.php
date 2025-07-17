<section class="w-full flex flex-col gap-[29px] px-6 py-12">
    {{-- Title --}}
    <h2 class="text-[32px] font-medium leading-[40px] font-['Poppins'] text-black">
        Event Kampung Gatot
    </h2>

    {{-- Filters --}}
    <div class="flex flex-wrap gap-2">
        <button class="px-6 py-3 bg-[#1B3A6D] text-white rounded-full text-[16px] font-semibold leading-[24px] font-['Poppins']">
            Semua
        </button>
        @foreach (['Saat ini', 'Akan datang', 'Kemarin'] as $filter)
            <button class="px-6 py-3 border border-[#1B3A6D] text-black rounded-full text-[16px] font-normal leading-[24px] font-['Poppins']">
                {{ $filter }}
            </button>
        @endforeach
    </div>

    {{-- Event Cards --}}
    <div class="flex flex-wrap gap-5">
        @php
            $events = [
                ['title' => 'Jakarta - Surabaya', 'img' => 'https://placehold.co/310x234'],
                ['title' => 'Jakarta - Yogyakarta', 'img' => 'https://placehold.co/310x234'],
                ['title' => 'Jakarta - Denpasar, Bali', 'img' => 'https://placehold.co/310x234'],
                ['title' => 'Jakarta - Medan', 'img' => 'https://placehold.co/310x234'],
            ];
        @endphp

        @foreach ($events as $event)
            <div class="w-[310px] h-[346px] flex flex-col gap-4">
                {{-- Image with BIG DEALS label --}}
                <div class="w-full h-[234px] bg-white rounded-[12px] p-6 bg-cover bg-center relative"
                     style="background-image: url('{{ $event['img'] }}')">
                    <div class="absolute top-4 left-4 bg-[#F2F2F2] px-3 py-1 rounded text-[#33AD5C] text-[16px] font-bold font-['Plus Jakarta Sans']">
                        BIG DEALS
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex flex-col gap-2">
                    <div class="text-[#717171] text-[16px] font-medium leading-[24px] font-['Poppins']">
                        24 - 28 Sep 2025
                    </div>
                    <div class="text-black text-[20px] font-semibold leading-[28px] font-['Poppins']">
                        {{ $event['title'] }}
                    </div>
                    <div class="text-[#1B3A6D] text-[20px] font-semibold leading-[28px] font-['Poppins']">
                        Rp 275.000
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
