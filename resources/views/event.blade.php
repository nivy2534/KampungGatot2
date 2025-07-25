@extends('layouts.app')

@section('content')
  @include('components.header')

  {{-- Hero Section --}}
  <section class="relative bg-gradient-to-br from-[#1B3A6D] to-[#2563eb] h-64 px-4 sm:px-6 lg:px-8 text-white text-center overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 max-w-3xl mx-auto">
      <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-3 leading-tight">
        Event & Belanja Kampung Ngebruk
      </h1>
      <p class="text-sm sm:text-base lg:text-lg text-blue-100 max-w-xl mx-auto leading-relaxed">
        Temukan event menarik dan produk unggulan dari Desa Ngebruk
      </p>
    </div>
  </section>

  {{-- Main Content --}}
  <section class="py-6 lg:py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto">
      
      {{-- Search & Filter Container --}}
      <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
          
          {{-- Search Input --}}
          <div class="flex-1 max-w-sm">
            <label for="search-event" class="sr-only">Cari event atau produk</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
              <input 
                type="text" 
                id="search-event"
                placeholder="Cari event atau produk..." 
                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-transparent transition-colors duration-200 text-sm"
              >
            </div>
          </div>

          {{-- Filter Buttons --}}
          <div class="flex flex-wrap gap-2">
            <button data-type="all" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-[#1B3A6D] text-white hover:bg-[#0f2a4f] transition-colors duration-200">
              Semua
            </button>
            <button data-type="event" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
              Event
            </button>
            <button data-type="produk" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
              Produk
            </button>
            <button data-type="kuliner" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
              Kuliner
            </button>
            <button data-type="kerajinan" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
              Kerajinan
            </button>
          </div>
        </div>
      </div>

      {{-- Events Grid --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
        @forelse($events as $event)
          <div class="event-card transition-all duration-300" data-type="{{ strtolower($event->event_type ?? 'event') }}">
            <a href="/produk-detail" class="block">
              <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                <div class="relative h-40 bg-gray-200 overflow-hidden">
                  <img src="{{ $event->event_image ?? '/assets/img/belanja.png' }}" 
                       alt="{{ $event->event_name }}" 
                       class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                  <div class="absolute top-3 left-3">
                    <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                      {{ strtoupper($event->event_type ?? 'EVENT') }}
                    </span>
                  </div>
                  @if($event->event_discount ?? false)
                    <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                      -{{ $event->event_discount }}%
                    </div>
                  @endif
                </div>
                <div class="p-4 space-y-2">
                  <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-500">
                      {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}
                    </p>
                    @if($event->event_location ?? false)
                      <span class="text-xs text-gray-400">
                        <svg class="inline w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $event->event_location }}
                      </span>
                    @endif
                  </div>
                  <h3 class="text-sm font-semibold text-gray-900 line-clamp-2">
                    {{ $event->event_name }}
                  </h3>
                  <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                      <span class="text-[#1B3A6D] text-lg font-bold">
                        Rp {{ number_format($event->event_price, 0, ',', '.') }}
                      </span>
                      @if($event->original_price ?? false)
                        <span class="text-gray-400 text-xs line-through">
                          Rp {{ number_format($event->original_price, 0, ',', '.') }}
                        </span>
                      @endif
                    </div>
                    @if($event->rating ?? false)
                      <div class="flex items-center gap-1 text-xs text-gray-500">
                        <svg class="w-3 h-3 fill-yellow-400" viewBox="0 0 24 24">
                          <path d="M12 2L14.97 8.72L22.29 9.64L17 14.89L18.36 22.13L12 18.52L5.64 22.13L7 14.89L1.71 9.64L9.03 8.72L12 2Z" />
                        </svg>
                        <span>{{ $event->rating }}</span>
                      </div>
                    @endif
                  </div>
                  @if($event->event_description ?? false)
                    <p class="text-xs text-gray-600 line-clamp-2">
                      {{ $event->event_description }}
                    </p>
                  @endif
                </div>
              </div>
            </a>
          </div>
        @empty
          <div class="col-span-full text-center py-8">
            <div class="max-w-sm mx-auto">
              <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12v-6m-4 6v-6m8 6v-6m2 2h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6a2 2 0 012-2h2"></path>
              </svg>
              <h3 class="text-base font-medium text-gray-900 mb-1">Belum ada event</h3>
              <p class="text-sm text-gray-500">Event dan produk akan tampil di sini ketika sudah tersedia.</p>
            </div>
          </div>
        @endforelse
      </div>

      {{-- No Results Message --}}
      <div id="no-results" class="hidden text-center py-8">
        <div class="max-w-sm mx-auto">
          <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          <h3 class="text-base font-medium text-gray-900 mb-1">Tidak ada hasil ditemukan</h3>
          <p class="text-sm text-gray-500">Coba ubah kata kunci pencarian atau filter kategori.</p>
        </div>
      </div>

      {{-- Pagination --}}
      @if(count($events) > 0)
        <div class="flex justify-center">
          <nav class="inline-flex items-center space-x-1 bg-white rounded-md shadow-sm border border-gray-200 p-1" aria-label="Pagination">
            <button class="inline-flex items-center px-2 py-1.5 rounded text-xs font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
              <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              Sebelumnya
            </button>
            
            <button class="inline-flex items-center px-2.5 py-1.5 rounded text-xs font-medium bg-[#1B3A6D] text-white shadow-sm">
              1
            </button>
            <button class="inline-flex items-center px-2.5 py-1.5 rounded text-xs font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200">
              2
            </button>
            <button class="inline-flex items-center px-2.5 py-1.5 rounded text-xs font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200">
              3
            </button>
            <span class="inline-flex items-center px-1.5 py-1.5 text-xs font-medium text-gray-500">
              ...
            </span>
            
            <button class="inline-flex items-center px-2 py-1.5 rounded text-xs font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors duration-200">
              Selanjutnya
              <svg class="h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </button>
          </nav>
        </div>
      @endif
    </div>
  </section>

  @include('components.footer')
  
<script>
document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const eventCards = document.querySelectorAll(".event-card");
    const searchInput = document.getElementById("search-event");
    const noResultsMessage = document.getElementById("no-results");
    
    let currentFilter = "all";
    let currentSearch = "";

    // Filter functionality
    function filterCards() {
        let visibleCount = 0;
        
        eventCards.forEach(card => {
            const cardType = card.getAttribute("data-type");
            const cardText = card.textContent.toLowerCase();
            
            const matchesFilter = currentFilter === "all" || cardType === currentFilter;
            const matchesSearch = currentSearch === "" || cardText.includes(currentSearch);
            
            if (matchesFilter && matchesSearch) {
                card.style.display = "block";
                card.classList.remove("fade-out");
                card.classList.add("fade-in");
                visibleCount++;
            } else {
                card.classList.remove("fade-in");
                card.classList.add("fade-out");
                setTimeout(() => {
                    if (card.classList.contains("fade-out")) {
                        card.style.display = "none";
                    }
                }, 150);
            }
        });
        
        // Show/hide no results message
        if (visibleCount === 0 && eventCards.length > 0) {
            noResultsMessage.classList.remove("hidden");
        } else {
            noResultsMessage.classList.add("hidden");
        }
    }

    // Filter button events
    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            currentFilter = btn.getAttribute("data-type");
            
            // Update button states
            filterButtons.forEach(b => {
                b.classList.remove("bg-[#1B3A6D]", "text-white");
                b.classList.add("border-gray-300", "text-gray-700");
            });
            
            btn.classList.remove("border-gray-300", "text-gray-700");
            btn.classList.add("bg-[#1B3A6D]", "text-white");
            
            filterCards();
        });
    });

    // Search functionality
    if (searchInput) {
        searchInput.addEventListener("input", function() {
            currentSearch = this.value.toLowerCase().trim();
            filterCards();
        });
        
        // Clear search on escape
        searchInput.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                this.value = "";
                currentSearch = "";
                filterCards();
            }
        });
    }

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        .fade-out {
            animation: fadeOut 0.15s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-5px);
            }
        }
        
        .event-card {
            transition: transform 0.2s ease-in-out;
        }
        
        .event-card:hover {
            transform: translateY(-2px);
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
