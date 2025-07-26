<div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
  <div class="relative h-40 bg-gray-200 overflow-hidden">
    <img src="{{ $image ?? 'https://placehold.co/280x160/e2e8f0/1B3A6D?text=Product' }}" alt="{{ $title ?? 'Product' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
    
    @if(isset($status))
    <div class="absolute top-3 left-3">
      <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
        {{ strtoupper($status) }}
      </span>
    </div>
    @endif
    
    @if(isset($discount))
    <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
      -{{ $discount }}%
    </div>
    @endif
  </div>
  
  <div class="p-4 space-y-2">
    <h3 class="text-gray-900 text-base font-bold line-clamp-2 group-hover:text-[#1B3A6D] transition-colors">
      {{ $title ?? 'Product Title' }}
    </h3>
    
    <div class="flex items-center gap-2">
      <span class="text-[#1B3A6D] text-lg font-bold">
        Rp {{ isset($price) ? number_format($price, 0, ',', '.') : '0' }}
      </span>
      @if(isset($originalPrice) && $originalPrice > $price)
      <span class="text-gray-400 text-sm line-through">
        Rp {{ number_format($originalPrice, 0, ',', '.') }}
      </span>
      @endif
    </div>
    
    @if(isset($seller))
    <div class="flex items-center gap-1 text-sm text-gray-500">
      <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
      </svg>
      <span>{{ $seller }}</span>
    </div>
    @endif
    
    @if(isset($rating) && isset($reviews))
    <div class="flex items-center gap-1 text-sm text-gray-500">
      <svg class="w-4 h-4 fill-yellow-400" viewBox="0 0 24 24">
        <path d="M12 2L14.97 8.72L22.29 9.64L17 14.89L18.36 22.13L12 18.52L5.64 22.13L7 14.89L1.71 9.64L9.03 8.72L12 2Z" />
      </svg>
      <span>{{ $rating }}</span>
      <span>({{ $reviews }} ulasan)</span>
    </div>
    @endif
    
    @if(isset($description))
    <p class="text-xs text-gray-600 line-clamp-2">{{ $description }}</p>
    @endif
    
    <div class="pt-2">
      <button class="w-full bg-[#1B3A6D] text-white py-2 rounded-lg font-semibold hover:bg-[#0f2a4f] transition-colors text-sm">
        {{ $buttonText ?? 'Lihat Detail' }}
      </button>
    </div>
  </div>
</div>

<style>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
