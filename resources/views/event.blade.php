@extends('layouts.app')

@section('content')
  @include('components.header')

  <!-- Hero Section -->
  <section class="bg-cover bg-center py-24" style="background-image: url('/assets/img/shopthumb.png');">
    <div class="container mx-auto text-center text-white">
      <h1 class="text-4xl font-bold">Event Kampung Ngebruk</h1>
      <p class="mt-2 text-lg">Menjelajah Cerita, Potensi, dan Kehidupan di Desa Ngebruk.</p>
    </div>
  </section>

  <!-- Event Grid -->
  <section class="py-12 px-4 md:px-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
      @forelse($events as $event)
        <a href="/produk-detail">
          <div class="bg-white rounded-lg shadow hover:shadow-lg overflow-hidden">
            <img src="/assets/img/belanja.png" alt="Event" class="w-full h-48 object-cover"> <!-- You can replace this with dynamic image path later -->
            <div class="p-4">
              <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">EVENT</span>
              <p class="text-sm text-gray-500 mt-2">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</p>
              <h3 class="font-semibold mt-1">{{ $event->event_name }}</h3>
              <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($event->event_price, 0, ',', '.') }}</p>
            </div>
          </div>
        </a>
      @empty
        <p class="col-span-4 text-center text-gray-500">Belum ada event tersedia.</p>
      @endforelse
    </div>
  </section>

  @include('components.footer')
@endsection
