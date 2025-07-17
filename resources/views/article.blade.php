@extends('layouts.app')

@section('content')
  {{-- Header --}}
  @include('components.header')

  {{-- Article Header --}}
  <section class="text-center py-16 px-4 max-w-4xl mx-auto">
    <span class="text-sm font-semibold text-white bg-[#1B3A6D] px-[8px] py-[6px] rounded-3xl">Sejarah</span>
    <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-2 mt-4 ">Asal–Usul Nama dan Sejarah Berdirinya Desa Ngebruk</h1>
    <p class="text-gray-500 text-sm">8 Juli 2025</p>
  </section>

  {{-- Hero Image --}}
  <section class="px-4 max-w-4xl mx-auto mb-10">
    <img src="/assets/img/articlethumb.png" alt="Foto Artikel" class="w-full rounded-xl object-cover">
  </section>

  {{-- Article Body --}}
  <section class="px-4 max-w-4xl mx-auto text-justify text-gray-700 space-y-6 leading-relaxed mb-20">
    <p>Setiap nama tempat seringkali menyimpan cerita dan sejarah yang mendalam, begitu pula dengan Desa Ngebruk...</p>

    <h2 class="text-xl font-semibold mt-6">Awal Mula Pemerintahan Desa</h2>
    <p>Seiring berjalannya waktu, komunitas yang menetap di sekitar sendang tersebut semakin besar...</p>
    <ul class="list-disc pl-6 space-y-2">
      <li>Pemerintahan pertama dibentuk sekitar abad ke-18.</li>
      <li>Struktur awal terdiri dari seorang pemimpin dan beberapa tetua adat.</li>
      <li>Fokus utama pemerintahan adalah mengatur irigasi pertanian dan menjaga keamanan.</li>
    </ul>

    <h2 class="text-xl font-semibold mt-6">Peninggalan Sejarah</h2>
    <p>Hingga kini, beberapa peninggalan dari masa lalu masih bisa kita jumpai...</p>
  </section>

  {{-- Related Articles --}}
  <section class="px-4 max-w-6xl mx-auto mb-20">
    <h2 class="text-2xl font-bold mb-6 text-center">Baca Juga Blog Lainnya</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      @for ($i = 0; $i < 3; $i++)
        @include('components.article-card', [
          'title' => 'Potensi Pertanian Organik di Lahan Subur Ngebruk',
          'date' => '8 Juli 2025',
          'category' => 'Potensi Desa',
          'excerpt' => 'Menilik bagaimana pertanian organik dapat berkembang di lahan subur desa kami.',
          'image' => '/assets/img/articlethumb.png'
        ])
      @endfor
    </div>
  </section>

  {{-- Footer --}}
  @include('components.footer')
@endsection
