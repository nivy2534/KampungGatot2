{{-- Event Card Component --}}
@php
    use Carbon\Carbon;
    
    $startDate = Carbon::parse($event->event_start_date);
    $endDate = $event->event_end_date ? Carbon::parse($event->event_end_date) : null;
    
    // Format tanggal untuk tampilan
    if ($endDate && !$startDate->isSameDay($endDate)) {
        $dateDisplay = $startDate->format('d M') . ' - ' . $endDate->format('d M Y');
    } else {
        $dateDisplay = $startDate->format('d M Y');
    }
    
    // Tentukan status event
    $now = Carbon::now();
    $today = Carbon::today();
    
    if ($startDate->lte($now) && ($endDate ? $endDate->gte($today) : $startDate->gte($today))) {
        $status = 'Sedang Berlangsung';
        $statusColor = 'text-green-600 bg-green-50';
    } elseif ($startDate->gt($today)) {
        $status = 'Akan Datang';
        $statusColor = 'text-blue-600 bg-blue-50';
    } else {
        $status = 'Selesai';
        $statusColor = 'text-gray-600 bg-gray-50';
    }
    
    // Ambil gambar event
    $eventImage = $event->image_url ? asset($event->image_url) : asset('assets/img/belanja.png');
@endphp

<div class="w-full sm:w-[48%] lg:w-[23%] bg-white rounded-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    {{-- Image + Badge --}}
    <div class="relative">
        <img src="{{ $eventImage }}" alt="{{ $event->name }}" class="w-full h-40 object-cover">
        <div class="absolute top-2 left-2 px-2 py-1 rounded shadow text-xs font-bold {{ $statusColor }}">
            {{ $status }}
        </div>
    </div>

    {{-- Info --}}
    <div class="px-4 py-3 space-y-1">
        <p class="text-sm text-gray-600 font-semibold">{{ $dateDisplay }}</p>
        <h3 class="text-base font-bold text-gray-800 line-clamp-2">{{ $event->name }}</h3>
        @if($event->price > 0)
            <p class="text-lg font-bold text-blue-800">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
        @else
            <p class="text-lg font-bold text-green-600">Gratis</p>
        @endif
        
        {{-- Description Preview --}}
        @if($event->description)
            <p class="text-sm text-gray-500 line-clamp-2 mt-2">{{ Str::limit($event->description, 100) }}</p>
        @endif
        
        {{-- Contact Info --}}
        @if($event->seller_name)
            <div class="flex items-center mt-2 text-xs text-gray-500">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                {{ $event->seller_name }}
            </div>
        @endif
    </div>
    
    {{-- Action Button --}}
    <div class="px-4 pb-4">
        <a href="{{ route('catalog.show', $event->slug) }}" 
           class="block w-full text-center bg-[#1B3A6D] text-white py-2 rounded hover:bg-[#0f2a4f] transition-colors text-sm font-medium">
            Lihat Detail
        </a>
    </div>
</div>
