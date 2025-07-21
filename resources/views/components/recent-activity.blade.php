<div class="body-inner">
    <div class="aktivitas-terbaru-parent">
        <div class="aktivitas-terbaru">Aktivitas Terbaru</div>

        @foreach ($activities as $activity)
        <div class="pengumuman-baru-jadwal-vaksin-parent">
            <div class="pengunjung">{{ $activity['title'] }}</div>
            <div class="jam-yang-lalu">{{ $activity['time'] }}</div>
        </div>
        @endforeach

    </div>
</div>
