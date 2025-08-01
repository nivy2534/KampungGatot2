@extends('layouts.app')

@section('content')
    @include('components.header')

    {{-- Hero Section --}}
    <section class="relative h-64 px-4 sm:px-6 lg:px-8 text-white text-center overflow-hidden flex items-center justify-center"
           style="background-image: url('{{ asset('assets/img/blogheader.png') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 max-w-3xl mx-auto">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-3 leading-tight">
                {{ $title }}
            </h1>
            <p class="text-sm sm:text-base lg:text-lg text-blue-100 max-w-xl mx-auto leading-relaxed">
                Potret kehidupan, keindahan alam, dan semangat kebersamaan warga Desa Ngebruk
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
                        <label for="search-gallery" class="sr-only">Cari foto</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="search-gallery"
                                placeholder="Cari foto..."
                                class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-transparent transition-colors duration-200 text-sm"
                            >
                        </div>
                    </div>

                    {{-- Filter Buttons --}}
                    <div class="flex flex-wrap gap-2">
                        <button data-category="all" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-[#1B3A6D] text-white hover:bg-[#0f2a4f] hover:text-white transition-colors duration-200">
                            Semua
                        </button>
                        <button data-category="pemandangan_alam" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
                            Pemandangan Alam
                        </button>
                        <button data-category="kegiatan_warga" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
                            Kegiatan Warga
                        </button>
                        <button data-category="umkm_lokal" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium border border-gray-300 text-gray-700 hover:bg-[#1B3A6D] hover:text-white hover:border-[#1B3A6D] transition-colors duration-200">
                            UMKM Lokal
                        </button>
                    </div>
                </div>
            </div>

            {{-- Photos Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
                @forelse ($photos as $photo)
                    <div class="photo-card transition-all duration-300 cursor-pointer"
                         data-category="{{ strtolower(str_replace(' ', '_', $photo->category ?? 'uncategorized')) }}"
                         onclick="openPhotoModal({{ json_encode([
                             'id' => $photo->id,
                             'photo_name' => $photo->photo_name ?? 'Foto Galeri',
                             'photo_description' => $photo->photo_description ?? 'Deskripsi foto',
                             'image_path' => $photo->image_path ?? '/assets/img/blogthumb.png',
                             'photo_date' => \Carbon\Carbon::parse($photo->photo_date ?? now())->translatedFormat('d F Y'),
                             'category' => ucfirst(str_replace('_', ' ', $photo->category ?? 'Galeri')),
                             'author' => $photo->author->name ?? 'Admin'
                         ]) }})">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                <img src="{{ asset('storage/' . ($photo->image_path ?? '/assets/img/blogthumb.png')) }}"
                                     alt="{{ $photo->photo_description ?? 'Foto' }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                                <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-semibold text-gray-900 mb-1 line-clamp-2">
                                    {{ $photo->photo_name ?? 'Foto Galeri' }}
                                </h3>
                                <p class="text-xs text-gray-500 mb-2 line-clamp-2">
                                    {{ $photo->photo_description ?? 'Deskripsi foto' }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-400">
                                    <span>{{ \Carbon\Carbon::parse($photo->photo_date ?? now())->translatedFormat('d M Y') }}</span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full">
                                        {{ ucfirst(str_replace('_', ' ', $photo->category ?? 'Galeri')) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <div class="max-w-sm mx-auto">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-base font-medium text-gray-900 mb-1">Belum ada foto</h3>
                            <p class="text-sm text-gray-500">Foto galeri akan tampil di sini ketika sudah tersedia.</p>
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
            @if(count($photos) > 0)
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

    {{-- Photo Modal --}}
    <div id="photoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                {{-- Image Section --}}
                <div class="lg:w-2/3 bg-gray-100">
                    <div class="relative h-64 lg:h-96">
                        <img id="modalImage" src="" alt="" class="w-full h-full object-contain">
                        <button onclick="closePhotoModal()" class="absolute top-4 right-4 bg-white/80 hover:bg-white rounded-full p-2 transition-colors duration-200">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Details Section --}}
                <div class="lg:w-1/3 p-6 flex flex-col">
                    <div class="flex-1">
                        <h3 id="modalTitle" class="text-xl font-bold text-gray-900 mb-4">
                            <!-- Photo title will be inserted here -->
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-1">Deskripsi</h4>
                                <p id="modalDescription" class="text-sm text-gray-600 leading-relaxed">
                                    <!-- Photo description will be inserted here -->
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-1">Dipublikasikan oleh</h4>
                                <p id="modalAuthor" class="text-sm text-gray-600">
                                    <!-- Author name will be inserted here -->
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-1">Tanggal</h4>
                                <p id="modalDate" class="text-sm text-gray-600">
                                    <!-- Photo date will be inserted here -->
                                </p>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-1">Kategori</h4>
                                <span id="modalCategory" class="inline-block px-3 py-1 bg-[#1B3A6D] text-white text-xs rounded-full">
                                    <!-- Photo category will be inserted here -->
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Close Button --}}
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <button onclick="closePhotoModal()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const photoCards = document.querySelectorAll(".photo-card");
    const searchInput = document.getElementById("search-gallery");
    const noResultsMessage = document.getElementById("no-results");

    let currentFilter = "all";
    let currentSearch = "";

    // Filter functionality
    function filterCards() {
        let visibleCount = 0;

        photoCards.forEach(card => {
            const cardCategory = card.getAttribute("data-category");
            const cardText = card.textContent.toLowerCase();

            const matchesFilter = currentFilter === "all" || cardCategory === currentFilter;
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
        if (visibleCount === 0 && photoCards.length > 0) {
            noResultsMessage.classList.remove("hidden");
        } else {
            noResultsMessage.classList.add("hidden");
        }
    }

    // Filter button events
    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            currentFilter = btn.getAttribute("data-category");

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

        .photo-card {
            transition: transform 0.2s ease-in-out;
        }

        .photo-card:hover {
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

// Photo Modal Functions
function openPhotoModal(photoData) {
    const modal = document.getElementById('photoModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalAuthor = document.getElementById('modalAuthor');
    const modalDate = document.getElementById('modalDate');
    const modalCategory = document.getElementById('modalCategory');

    // Set modal content
    modalImage.src = '/storage/' + photoData.image_path;
    modalImage.alt = photoData.photo_name;
    modalTitle.textContent = photoData.photo_name;
    modalDescription.textContent = photoData.photo_description;
    modalAuthor.textContent = photoData.author;
    modalDate.textContent = photoData.photo_date;
    modalCategory.textContent = photoData.category;

    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePhotoModal() {
    const modal = document.getElementById('photoModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('photoModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePhotoModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePhotoModal();
    }
});
</script>
@endsection
