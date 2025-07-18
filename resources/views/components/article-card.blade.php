<div class="bg-white rounded-lg shadow-md overflow-hidden">
  <img src="{{ $image }}" alt="Thumbnail" class="w-full h-48 object-cover">
  <div class="p-4">
    <span class="text-sm font-semibold text-white bg-[#1B3A6D] px-[8px] py-[6px] rounded-3xl">{{ $category ?? 'Kategori' }}</span>
    <h3 class="mt-2 font-bold text-md">{{ $title ?? 'judul' }}</h3>
    <p class="text-sm text-gray-600 mt-1">{{ $excerpt ?? 'sampul' }}</p>
    <div class="mt-3 text-xs text-gray-500 flex items-center gap-1">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16" />
      </svg>
      <span>{{ $date ?? '8 Juli 2025' }}</span>
    </div>
  </div>
</div>
