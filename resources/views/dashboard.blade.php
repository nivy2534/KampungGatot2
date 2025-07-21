@extends('layouts.app')

@section('content')
<div class="dashboard-admin">
    <div class="side-navbar-parent">
        @include('components.sidebar')

        <div class="body">
            @include('components.navbar')

            <div class="frame-parent">
                @component('components.card-stat', [
                    'title' => 'Total Pengunjung Blog',
                    'count' => '1.245',
                    'change' => '8.5%',
                    'changeText' => '+98 Bulan ini',
                    'icon' => 'chart-arrow-up.svg',
                    'isUp' => true
                ]) @endcomponent

                @component('components.card-stat', [
                    'title' => 'Total Pengunjung Barang',
                    'count' => '1.245',
                    'change' => '8.5%',
                    'changeText' => '+98 Bulan ini',
                    'icon' => 'chart-arrow-up.svg',
                    'isUp' => true
                ]) @endcomponent

                @component('components.card-stat', [
                    'title' => 'Total Pengunjung Galeri',
                    'count' => '87.530',
                    'change' => '15.2%',
                    'changeText' => '-1.320 Bulan ini',
                    'icon' => 'chart-arrow-down.svg',
                    'isUp' => false
                ]) @endcomponent
            </div>

            @include('components.recent-activity', ['activities' => [
                ['title' => 'Pengumuman baru “Jadwal Vaksinasi” Telah diupload', 'time' => '2 Jam yang lalu'],
                ['title' => 'Artikel blog "Kampung Gatot Meraih Adiwiyata 2020" telah diunggah', 'time' => '3 hari yang lalu'],
                ['title' => 'Produk "Kerajinan Tangan Anyaman Bambu" telah ditambahkan', 'time' => '5 hari yang lalu'],
                ['title' => 'Gambar baru ditambahkan ke galeri "Pemandangan Alam"', 'time' => '7 hari yang lalu']
            ]])
        </div>
    </div>
</div>

@include('components.logout-popup')
@endsection
