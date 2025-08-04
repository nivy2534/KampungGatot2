<footer class="bg-[#13294D] text-[#E8EBF0] py-12 px-6">
  <div class="container mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8">
      {{-- Logo + Info --}}
      <div class="lg:col-span-2">
        <div class="flex items-center gap-3 mb-4">
          <img src="{{ asset('assets/img/logo_tutwuri.png') }}" alt="Logo" class="w-12 h-12" />
          <img src="{{ asset('assets/img/logo_berdampak.png') }}" alt="Logo" class="w-12 h-12" />
          <img src="{{ asset('assets/img/logo_unm.png') }}" alt="Logo" class="w-12 h-12" />
        </div>
        <p class="text-sm mb-4 max-w-sm">
          Jelajahi keindahan alam, kearifan lokal, dan produk UMKM berkualitas dari masyarakat Kampung Gatot yang penuh dengan keramahan dan tradisi.
        </p>
      </div>

      {{-- Navigation --}}
      <div>
        <h4 class="font-semibold mb-4">Halaman</h4>
        <ul class="text-sm space-y-2">
          <li><a href="/" class="hover:text-white transition-colors">Beranda</a></li>
          <li><a href="/blog" class="hover:text-white transition-colors">Blog</a></li>
          <li><a href="/galeri" class="hover:text-white transition-colors">Galeri</a></li>
          <li><a href="/event" class="hover:text-white transition-colors">Belanja</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-semibold mb-4">Kategori</h4>
        <ul class="text-sm space-y-2">
          <li><a href="{{ route('blog', ['tag' => 'umkm_lokal']) }}" class="hover:text-white transition-colors">UMKM Lokal</a></li>
          <li><a href="{{ route('blog', ['tag' => 'kabar_warga']) }}" class="hover:text-white transition-colors">Kabar Warga</a></li>
          <li><a href="{{ route('blog', ['tag' => 'potensi_desa']) }}" class="hover:text-white transition-colors">Potensi Desa</a></li>
          <li><a href="{{ route('blog', ['tag' => 'sejarah']) }}" class="hover:text-white transition-colors">Sejarah</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-semibold mb-4">Kontak</h4>
        <div class="text-sm space-y-3">
          <div class="flex items-start gap-2">
            <svg class="w-4 h-4 mt-0.5 text-[#E8EBF0] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Kampung Gatot, Desa Ngebruk, Kecamatan Sumberpucung, Kabupaten Malang</span>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#E8EBF0] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            <span>081234567890</span>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#E8EBF0] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>info@desangebruk.id</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Bagian bawah -->
    <div class="bg-[#0F203C] py-4">
      <div class="">
        <div class="lg:col-span-2 flex flex-wrap items-center justify-start gap-4">
          <div class="flex items-center gap-4">
            <img src="{{ asset('assets/img/logo_tutwuri.png') }}" alt="Logo 1" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_berdampak.png') }}" alt="Logo 2" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_unm.png') }}" alt="Logo 3" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_bima.png') }}" alt="Logo 4" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_gatot.png') }}" alt="Logo 5" class="h-10 w-10 rounded-full object-contain">
          </div>
        </div>
      </div>
    </div>

  </div>
</footer>
