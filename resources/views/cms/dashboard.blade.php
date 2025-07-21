@extends('layouts.app')

@section('title', 'Dashboard - Kampung Gatot')

@section('content')
<div class="dashboard-container">
    {{-- Sidebar --}}
    <aside class="sidebar fixed top-0 left-0 h-full overflow-y-auto" id="sidebar">
        <div class="sidebar-header flex items-center gap-2 h-[70px]">
            <div class="logo-simple bg-[#297BBF] w-[60px] h-[60px] rounded-full flex items-center justify-center text-white font-bold text-[24px]">KG</div>
            <div class="brand-info">
                <h1 class="text-neutral-100 text-[18px] font-bold leading-7">Kampung Gatot</h1>
                <p class="text-neutral-100 text-xs leading-5">Panel Admin</p>
            </div>
        </div>

        <nav class="sidebar-nav flex flex-col justify-between h-full">
            <div class="nav-menu flex flex-col gap-6 mt-8">
                @php
                    $navItems = [
                        ['label' => 'Dashboard', 'icon' => 'home', 'active' => true],
                        ['label' => 'Kelola Blog', 'icon' => 'newspaper', 'active' => false],
                        ['label' => 'Kelola Barang', 'icon' => 'box', 'active' => false],
                        ['label' => 'Kelola Galeri', 'icon' => 'image', 'active' => false],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <div class="nav-item {{ $item['active'] ? 'active bg-[#0F203C]' : 'hover:bg-[rgba(15,32,60,0.5)]' }} p-4 rounded-lg cursor-pointer transition-all">
                        <div class="nav-item-content flex items-center gap-4">
                            <i class="lucide lucide-{{ $item['icon'] }} nav-icon text-white"></i>
                            <span class="nav-text {{ $item['active'] ? 'text-neutral-100 font-semibold' : 'text-[#D9D9D9] font-medium' }} text-base">{{ $item['label'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="logout-section mt-auto">
                <div class="logout-item hover:bg-[rgba(245,245,245,0.1)] p-4 rounded-lg cursor-pointer transition-all">
                    <div class="nav-item-content flex items-center gap-4">
                        <i class="lucide lucide-log-out nav-icon text-white"></i>
                        <span class="logout-text text-neutral-100 text-base font-medium">Logout</span>
                    </div>
                </div>
            </div>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="main-content flex flex-col ml-[318px]">
        <header class="top-header h-[90px] bg-[#F5F5F5] border-b border-[#D9D9D9] px-[50px] flex justify-between items-center">
            <div class="flex items-center gap-5">
                <button class="mobile-menu-btn hidden md:block" onclick="toggleSidebar()">
                    <i class="lucide lucide-menu"></i>
                </button>
                <h1 class="page-title text-[32px] font-semibold leading-10 text-[#080808]">Dashboard</h1>
            </div>
            <p class="welcome-text text-[20px] font-normal text-[#080808] leading-8">Selamat datang, Adrian</p>
        </header>

        <div class="content-area px-[50px] py-[43px] flex flex-col gap-[43px]">
            {{-- Stats Cards --}}
            <div class="stats-grid grid grid-cols-1 md:grid-cols-3 gap-[30px]">
                @foreach ([
                    ['title' => 'Total Pengunjung Blog', 'value' => '1.245', 'unit' => 'Pengunjung', 'change' => '+98 Bulan ini', 'percent' => '8.5%', 'direction' => 'up'],
                    ['title' => 'Total Pengunjung Barang', 'value' => '1.245', 'unit' => 'Pengunjung', 'change' => '+98 Bulan ini', 'percent' => '8.5%', 'direction' => 'up'],
                    ['title' => 'Total Pengunjung Galeri', 'value' => '87.530', 'unit' => 'Pengunjung', 'change' => '-1.320 Bulan ini', 'percent' => '15.2%', 'direction' => 'down'],
                ] as $stat)
                    <div class="stat-card bg-white border border-[#B8C2D2] rounded-lg overflow-hidden">
                        <div class="stat-content p-6 border-b border-[#E4E4E7]">
                            <div class="stat-title text-[#080808] font-[Plus Jakarta Sans] text-sm font-semibold mb-3">{{ $stat['title'] }}</div>
                            <div class="stat-value flex items-baseline gap-1 mb-2">
                                <span class="stat-number text-black font-[Plus Jakarta Sans] text-xl font-bold">{{ $stat['value'] }}</span>
                                <span class="stat-unit text-black font-[Plus Jakarta Sans] text-sm">{{ $stat['unit'] }}</span>
                            </div>
                            <div class="stat-change flex items-center gap-2">
                                <i class="lucide {{ $stat['direction'] === 'up' ? 'arrow-up' : 'arrow-down' }} change-icon {{ $stat['direction'] === 'up' ? 'text-green-600' : 'text-red-500' }}"></i>
                                <span class="change-percent {{ $stat['direction'] === 'up' ? 'text-green-600' : 'text-red-500' }} text-xs font-semibold">{{ $stat['percent'] }}</span>
                                <span class="change-text text-[#52525B] text-xs font-semibold">{{ $stat['change'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Activity Section --}}
            <div class="activity-section bg-white border border-[#B8C2D2] rounded-lg p-[30px]">
                <h2 class="activity-header text-black text-lg font-semibold mb-4">Aktivitas Terbaru</h2>

                @foreach ([
                    ['text' => 'Pengumuman baru "Jadwal Vaksinasi" Telah diupload', 'time' => '2 Jam yang lalu'],
                    ['text' => 'Artikel blog "Kampung Gatot Meraih Adiwiyata 2020" telah diunggah', 'time' => '3 hari yang lalu'],
                    ['text' => 'Produk "Kerajinan Tangan Anyaman Bambu" telah ditambahkan', 'time' => '5 hari yang lalu'],
                    ['text' => 'Gambar baru ditambahkan ke galeri "Pemandangan Alam"', 'time' => '7 hari yang lalu'],
                ] as $activity)
                    <div class="activity-item py-[14px] border-b border-[#D9D9D9] flex justify-between items-center rounded-lg hover:bg-gray-100 last:border-0">
                        <span class="activity-text text-black text-sm">{{ $activity['text'] }}</span>
                        <span class="activity-time text-gray-500 text-xs whitespace-nowrap">{{ $activity['time'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('mobile-open');
    }
    document.addEventListener('click', function (event) {
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.querySelector('.mobile-menu-btn');
        if (window.innerWidth <= 968 && !sidebar.contains(event.target) && !menuBtn.contains(event.target)) {
            sidebar.classList.remove('mobile-open');
        }
    });
</script>
@endpush
