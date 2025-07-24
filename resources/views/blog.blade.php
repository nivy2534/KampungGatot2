@extends('layouts.app')

@section('content')
  {{-- Header --}}
  @include('components.header')

  {{-- Hero Section --}}
  <section class="bg-cover bg-center py-24 px-6 text-white text-center" style="background-image: url('/assets/img/bloghero.png')">
    <h1 class="text-4xl font-bold mb-2">Blog Kampung Gatot</h1>
    <p class="text-lg">Menjelajahi Cerita, Potensi, dan Kehidupan di Kampung Gatot.</p>
  </section>

  {{-- Filter & Search --}}
  <section class="py-10 px-[200px] w-full mx-auto">
    <div class="flex flex-col md:flex-col md:items-center justify-between gap-4 mb-8">
      <input type="text" placeholder="Cari" class="w-[700px] px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      <div class="flex flex-wrap gap-2">
        <button data-tag="all" class="filter-btn px-4 py-2 rounded-full text-sm bg-blue-600 text-white">Semua</button>
  <button data-tag="sejarah" class="filter-btn px-4 py-2 rounded-full text-sm border">Sejarah</button>
  <button data-tag="potensi_desa" class="filter-btn px-4 py-2 rounded-full text-sm border">Potensi Desa</button>
  <button data-tag="kabar_warga" class="filter-btn px-4 py-2 rounded-full text-sm border">Kabar Warga</button>
  <button data-tag="umkm_lokal" class="filter-btn px-4 py-2 rounded-full text-sm border">UMKM Lokal</button>
      </div>
    </div>

    {{-- Articles Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach ($blogs as $blog)
      <div class="blog-card" data-tag="{{ $blog['tag'] ?? 'uncategorized' }}">
            @include('components.article-card', [
              'title' => $blog['name'] ?? 'Judul tidak tersedia',
              'date' => \Carbon\Carbon::parse($blog['created_at'])->translatedFormat('d F Y'),
              'category' => \Illuminate\Support\Str::of($blog['tag'] ?? '')->replace('_',' ')->title(),
              'excerpt' => \Illuminate\Support\Str::limit($blog['description'], 100),
              'image' => $blog['image_url'] ?? '/assets/img/blogthumb.png'
            ])
          </div>
      @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-10 flex justify-center">
      <nav class="inline-flex items-center space-x-2">
        <button class="px-3 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">&laquo;</button>
        <button class="px-3 py-2 rounded-lg bg-blue-600 text-white">1</button>
        <button class="px-3 py-2 rounded-lg border hover:bg-gray-100">2</button>
        <button class="px-3 py-2 rounded-lg border hover:bg-gray-100">3</button>
        <button class="px-3 py-2 rounded-lg border hover:bg-gray-100">...</button>
        <button class="px-3 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">&raquo;</button>
      </nav>
    </div>
  </section>

  {{-- Footer --}}
  @include('components.footer')
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".filter-btn");
    const cards = document.querySelectorAll(".blog-card");

    buttons.forEach(btn => {
      btn.addEventListener("click", () => {
        const tag = btn.getAttribute("data-tag");

        buttons.forEach(b => b.classList.remove("bg-blue-600", "text-white"));
        btn.classList.add("bg-blue-600", "text-white");

        cards.forEach(card => {
          if (tag === "all" || card.getAttribute("data-tag") === tag) {
            card.style.display = "block";
          } else {
            card.style.display = "none";
          }
        });
      });
    });
  });
</script>
@endsection
