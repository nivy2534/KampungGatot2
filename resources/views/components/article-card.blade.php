<div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
  <div class="relative h-36 bg-gray-200 overflow-hidden">
    <img src="{{ $image ?? 'https://placehold.co/350x200/e2e8f0/1B3A6D?text=Article' }}" alt="{{ $title ?? 'Article' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
  </div>
  
  <div class="p-4 space-y-2">
    <span class="inline-block text-xs font-semibold text-white bg-[#1B3A6D] px-2 py-1 rounded-full">{{ $category ?? 'Artikel' }}</span>
    
    <h3 class="text-base font-bold text-gray-900 leading-tight group-hover:text-[#1B3A6D] transition-colors">
      {{ $title ?? 'Judul Artikel' }}
    </h3>
    
    @if(isset($excerpt))
    <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">{{ $excerpt }}</p>
    @endif
    
    <div class="flex items-center gap-2 text-xs text-gray-500 pt-1">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#1B3A6D]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16" />
      </svg>
      <span>{{ $date ?? '8 Juli 2025' }}</span>
    </div>
    
    <div class="pt-2">
      <button class="text-[#1B3A6D] font-semibold text-sm hover:text-[#0f2a4f] transition-colors inline-flex items-center gap-1 group">
        Baca Selengkapnya
        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
      </button>
    </div>
  </div>
</div>
