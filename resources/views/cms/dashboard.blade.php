@extends('layouts.app_dashboard')

@php($page = 'dashboard')
@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <!-- Card 1: Blog Visitors -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-1">Total Pengunjung Blog</p>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">1.245</h2>
                    <div class="flex items-center text-xs">
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fa-solid fa-arrow-up mr-1 text-xs"></i>
                            8.5%
                        </span>
                        <span class="ml-2 text-gray-500">+88 Bulan ini</span>
                    </div>
                </div>
                <div class="flex-shrink-0 ml-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-book text-blue-600 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Product Visitors -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-1">Total Pengunjung Barang</p>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">1.245</h2>
                    <div class="flex items-center text-xs">
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fa-solid fa-arrow-up mr-1 text-xs"></i>
                            8.5%
                        </span>
                        <span class="ml-2 text-gray-500">+88 Bulan ini</span>
                    </div>
                </div>
                <div class="flex-shrink-0 ml-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-shopping-bag text-green-600 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Gallery Visitors -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-1">Total Pengunjung Galeri</p>
                    <h2 class="text-xl md:text-2xl font-bold text-red-600 mb-2">87.530</h2>
                    <div class="flex items-center text-xs">
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fa-solid fa-arrow-down mr-1 text-xs"></i>
                            15.2%
                        </span>
                        <span class="ml-2 text-gray-500">-1.320 Bulan ini</span>
                    </div>
                </div>
                <div class="flex-shrink-0 ml-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-image text-purple-600 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-4 md:px-6 py-4 border-b border-gray-200">
            <h3 class="text-base font-semibold text-gray-900">Aktivitas Terbaru</h3>
        </div>
        <div class="divide-y divide-gray-200">
            <div class="px-4 md:px-6 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-1 sm:space-y-0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-900 font-medium">Pengumuman baru "Jadwal Vaksinasi" Telah diupload</p>
                </div>
                <span class="text-xs text-gray-500 flex-shrink-0">2 Jam yang lalu</span>
            </div>
            <div class="px-4 md:px-6 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-1 sm:space-y-0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-900 font-medium">Artikel blog "Kampung Gatot Meraih Adiwiyata 2020" telah diunggah</p>
                </div>
                <span class="text-xs text-gray-500 flex-shrink-0">3 hari yang lalu</span>
            </div>
            <div class="px-4 md:px-6 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-1 sm:space-y-0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-900 font-medium">Produk "Kerajinan Tangan Anyaman Bambu" telah ditambahkan</p>
                </div>
                <span class="text-xs text-gray-500 flex-shrink-0">5 hari yang lalu</span>
            </div>
            <div class="px-4 md:px-6 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-1 sm:space-y-0">
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-900 font-medium">Gambar baru ditambahkan ke galeri "Pemandangan Alam"</p>
                </div>
                <span class="text-xs text-gray-500 flex-shrink-0">7 hari yang lalu</span>
            </div>
        </div>
    </div>
@endsection
