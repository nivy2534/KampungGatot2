@props(['title', 'count', 'change', 'changeText', 'icon', 'isUp' => true])

<div class="frame-wrapper">
    <div class="total-pengunjung-blog-parent">
        <div class="total-pengunjung-blog">{{ $title }}</div>
        <div class="pengunjung-parent">
            <div class="pengunjung">
                <span class="span"><b>{{ $count }}</b><span class="span1"> </span></span>
                <span class="pengunjung1">Pengunjung</span>
            </div>
            <div class="{{ $isUp ? 'huge-iconbusinessoutlinecha-parent' : 'frame-group' }}">
                <img src="{{ asset('images/' . $icon) }}" class="huge-iconbusinessoutlinecha" alt="">
                <div class="div1">{{ $change }}</div>
                <div class="bulan-ini">{{ $changeText }}</div>
            </div>
        </div>
    </div>
</div>
