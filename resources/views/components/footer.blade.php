<footer class="bg-gray-100 py-12 px-6">
  <div class="container mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8">
      {{-- Logo + Info --}}
      <div class="lg:col-span-2">
        <div class="flex items-center gap-3 mb-4">
          <img src="{{ asset('assets/img/logo_tutwuri.png') }}" alt="Logo" class="w-12 h-12" />
          <img src="{{ asset('assets/img/logo_berdampak.png') }}" alt="Logo" class="w-12 h-12" />
          <img src="{{ asset('assets/img/logo_unm.png') }}" alt="Logo" class="w-12 h-12" />
          <!-- <div>
            <h3 class="font-bold text-lg text-gray-900">Kampung Gatot</h3>
            <p class="text-sm text-gray-600">Kecamatan Sumberpucung</p>
          </div> -->
        </div>
        <p class="text-sm text-gray-600 mb-4 max-w-sm">
          Jelajahi keindahan alam, kearifan lokal, dan produk UMKM berkualitas dari masyarakat Kampung Gatot yang penuh dengan keramahan dan tradisi.
        </p>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-400 hover:text-[#1B3A6D] transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-[#1B3A6D] transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
            </svg>
          </a>
          <a href="#" class="text-gray-400 hover:text-[#1B3A6D] transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.1.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
            </svg>
          </a>
        </div>
      </div>

      {{-- Navigation --}}
      <div>
        <h4 class="font-semibold mb-4 text-gray-900">Halaman</h4>
        <ul class="text-sm space-y-2 text-gray-700">
          <li><a href="/" class="hover:text-[#1B3A6D] transition-colors">Beranda</a></li>
          <li><a href="/blog" class="hover:text-[#1B3A6D] transition-colors">Blog</a></li>
          <li><a href="/galeri" class="hover:text-[#1B3A6D] transition-colors">Galeri</a></li>
          <li><a href="/event" class="hover:text-[#1B3A6D] transition-colors">Belanja</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-semibold mb-4 text-gray-900">Kategori</h4>
        <ul class="text-sm space-y-2 text-gray-700">
          <li><a href="#" class="hover:text-[#1B3A6D] transition-colors">UMKM Lokal</a></li>
          <li><a href="#" class="hover:text-[#1B3A6D] transition-colors">Event</a></li>
          <li><a href="#" class="hover:text-[#1B3A6D] transition-colors">Berita Desa</a></li>
          <li><a href="#" class="hover:text-[#1B3A6D] transition-colors">Galeri Foto</a></li>
        </ul>
      </div>

      <div>
        <h4 class="font-semibold mb-4 text-gray-900">Kontak</h4>
        <div class="text-sm space-y-3 text-gray-700">
          <div class="flex items-start gap-2">
            <svg class="w-4 h-4 mt-0.5 text-[#1B3A6D] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Kampung Gatot, Desa Ngebruk, Kecamatan Sumberpucung, Kabupaten Malang</span>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#1B3A6D] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            <span>081234567890</span>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#1B3A6D] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span>info@desangebruk.id</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Bagian bawah -->
    <div class="bg-[#0f1e34] py-4">
      <div class="">
        <div class="lg:col-span-2 flex flex-wrap items-center justify-start gap-4">
          <!-- Logo-list -->
          <div class="flex items-center gap-4">
            <img src="{{ asset('assets/img/logo_tutwuri.png') }}" alt="Logo 1" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_berdampak.png') }}" alt="Logo 2" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_unm.png') }}" alt="Logo 3" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_bima.png') }}" alt="Logo 4" class="h-10 w-10 rounded-full object-contain">
            <img src="{{ asset('assets/img/logo_gatot.png') }}" alt="Logo 5" class="h-10 w-10 rounded-full object-contain">
          </div>
          <p class="text-black text-sm ml-4">
            Dikembangkan oleh Tim MMD FILKOM 49 Tahun 2025
          </p>
        </div>
      </div>
    </div>

  </div>
</footer>
