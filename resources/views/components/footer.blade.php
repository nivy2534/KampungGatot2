<footer class="bg-gray-100 py-12 px-6">
  <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
    {{-- Logo + Info --}}
    <div>
      <img src="/images/logo-footer.png" alt="Logo" class="mb-2 w-20" />
      <p class="text-sm text-gray-600">
        Download aplikasi di Playstore.
      </p>
    </div>

    {{-- Navigation --}}
    <div>
      <h4 class="font-semibold mb-2">Page</h4>
      <ul class="text-sm space-y-1 text-gray-700">
        <li><a href="#">Home</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Galeri</a></li>
      </ul>
    </div>

    <div>
      <h4 class="font-semibold mb-2">Menu</h4>
      <ul class="text-sm space-y-1 text-gray-700">
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Artikel</a></li>
        <li><a href="#">Event</a></li>
      </ul>
    </div>

    <div>
      <h4 class="font-semibold mb-2">Dukungan</h4>
      <ul class="text-sm space-y-1 text-gray-700">
        <li><a href="#">Kebijakan</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Bantuan</a></li>
      </ul>
    </div>

    <div>
      <h4 class="font-semibold mb-2">Contact Us</h4>
      <p class="text-sm text-gray-700">081234567890</p>
      <p class="text-sm text-gray-700">info@desa.com</p>
    </div>
  </div>

  <p class="text-center text-sm text-gray-500 mt-10">
    © {{ date('Y') }}. All rights reserved.
  </p>
</footer>
