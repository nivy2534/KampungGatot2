@extends('layouts.app')

@section('content')
  @include('components.header')

  {{-- Hero Section --}}
  <section class="relative h-64 px-4 sm:px-6 lg:px-8 text-white text-center overflow-hidden flex items-center justify-center"
           style="background-image: url('{{ asset('assets/img/blogheader.png') }}'); background-size: cover; background-position: center;">
    <!-- Overlay Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#1B3A6D]/90 to-[#2563eb]/90"></div>
    <!-- Optional: extra dark overlay -->
    <div class="absolute inset-0 bg-black/30"></div>

    <div class="relative z-10 max-w-3xl mx-auto">
      <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-3 leading-tight">
        Katalog Kampung Ngebruk
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
            <button data-type="all" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-[#1B3A6D] text-white hover:bg-[#0f2a4f] hover:text-white transition-colors duration-200">
              Semua
            </button>
            <button data-type="event" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
              Event
            </button>
            <button data-type="produk" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
              Produk
            </button>
          </div>
        </div>
      </div>

      {{-- Products Grid --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
        @forelse($products as $product)
          <div class="event-card transition-all duration-300" data-type="{{ $product->type ?? 'produk' }}">
            <a href="{{ route('catalog.show', $product->slug) }}" class="block">
              @include('components.product-card', [
                'title' => $product->name,
                'image' => $product->image_url ? asset($product->image_url) : '/assets/img/belanja.png',
                'price' => $product->price,
                'type' => $product->type ?? 'produk',
                'seller' => $product->seller_name ?: $product->author_name,
                'description' => $product->description,
                'buttonText' => 'Lihat Detail'
              ])
            </a>
          </div>
        @empty
          <div class="col-span-full text-center py-8">
            <div class="max-w-sm mx-auto">
              <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 12v-6m-4 6v-6m8 6v-6m2 2h2a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6a2 2 0 012-2h2"></path>
              </svg>
              <h3 class="text-base font-medium text-gray-900 mb-1">Belum ada produk</h3>
              <p class="text-sm text-gray-500">Produk akan tampil di sini ketika sudah tersedia.</p>
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
      @if($products->hasPages())
        <div class="flex justify-center">
          {{ $products->links() }}
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
