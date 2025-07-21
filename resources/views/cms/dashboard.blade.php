@extends('layouts.app_dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded">
            <p class="text-sm text-gray-600">Total Pengunjung Blog</p>
            <h2 class="text-2xl font-bold">1.245</h2>
            <p class="text-xs text-green-500">⬆ 8.5% +88 Bulan ini</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <p class="text-sm text-gray-600">Total Pengunjung Barang</p>
            <h2 class="text-2xl font-bold">1.245</h2>
            <p class="text-xs text-green-500">⬆ 8.5% +88 Bulan ini</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <p class="text-sm text-gray-600">Total Pengunjung Galeri</p>
            <h2 class="text-2xl font-bold text-red-500">87.530</h2>
            <p class="text-xs text-red-500">⬇ 15.2% -1.320 Bulan ini</p>
        </div>
    </div>

    <div class="bg-white shadow rounded p-4">
        <h3 class="text-md font-semibold mb-2">Aktivitas Terbaru</h3>
        <ul class="divide-y divide-gray-200 text-sm">
            <li class="py-2 flex justify-between">Pengumuman baru "Jadwal Vaksinasi" Telah diupload <span
                    class="text-gray-500">2 Jam yang lalu</span></li>
            <li class="py-2 flex justify-between">Artikel blog "Kampung Gatot Meraih Adiwiyata 2020" telah diunggah <span
                    class="text-gray-500">3 hari yang lalu</span></li>
            <li class="py-2 flex justify-between">Produk "Kerajinan Tangan Anyaman Bambu" telah ditambahkan <span
                    class="text-gray-500">5 hari yang lalu</span></li>
            <li class="py-2 flex justify-between">Gambar baru ditambahkan ke galeri "Pemandangan Alam" <span
                    class="text-gray-500">7 hari yang lalu</span></li>
        </ul>
    </div>
@endsection
