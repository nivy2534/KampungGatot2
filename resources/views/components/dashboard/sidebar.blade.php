<aside class="w-72 md:w-80 text-white flex flex-col h-screen overflow-hidden bg-[#1B3A6D] shadow-xl">
    <!-- Header with improved spacing -->
    <div class="flex items-center space-x-2 p-3 md:p-4 border-b border-white/10">
        <div class="flex space-x-1.5">
            <div class="h-8 w-8 md:h-9 md:w-9 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                <img src="{{ asset('assets/img/logo_tutwuri.png') }}" class="h-6 w-6 md:h-7 md:w-7" alt="Logo Tutwuri">
            </div>
            <div class="h-8 w-8 md:h-9 md:w-9 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm">
                <img src="{{ asset('assets/img/logo_unm.png') }}" class="h-6 w-6 md:h-7 md:w-7" alt="Logo UNM">
            </div>
        </div>
        <div class="min-w-0 flex-1">
          <h1 class="text-sm md:text-base font-bold leading-tight truncate w-40 md:w-48">Kampung Gatot</h1>
            <p class="text-xs text-white/70 font-medium">Panel Admin</p>
        </div>
    </div>

    <!-- Navigation with improved styling -->
    <nav class="flex flex-col px-3 md:px-4 py-4 space-y-1 flex-1 overflow-y-auto">
        <div class="text-xs font-semibold text-white/60 uppercase tracking-wider mb-3 px-2">Menu Utama</div>

        <a href="{{ url('/dashboard') }}"
            class="nav-item {{ Request::is('dashboard') ? 'active' : '' }} flex items-center px-3 py-3 hover:bg-white/10 rounded-lg transition-all duration-200 group text-white">
            <i class="fa-solid fa-house mr-3 flex-shrink-0 text-sm"></i>
            <span class="truncate text-sm">Dashboard</span>
        </a>

        <a href="{{ url('/dashboard/blogs') }}"
            class="nav-item {{ Request::is('dashboard/blogs*') ? 'active' : '' }} flex items-center px-3 py-3 hover:bg-white/10 rounded-lg transition-all duration-200 group text-white">
            <i class="fas fa-newspaper mr-3 flex-shrink-0 text-sm"></i>
            <span class="text-sm">Kelola Blog</span>
        </a>

        <a href="{{ url('/dashboard/products') }}"
            class="nav-item {{ Request::is('dashboard/products*') ? 'active' : '' }} flex items-center px-3 py-3 hover:bg-white/10 rounded-lg transition-all duration-200 group text-white">
            <i class="fas fa-box mr-3 flex-shrink-0 text-sm"></i>
            <span class="text-sm">Kelola Produk</span>
        </a>

        <a href="{{ url('/dashboard/gallery') }}"
            class="nav-item {{ Request::is('dashboard/gallery*') ? 'active' : '' }} flex items-center px-3 py-3 hover:bg-white/10 rounded-lg transition-all duration-200 group text-white">
            <i class="fa-solid fa-image mr-3 flex-shrink-0 text-sm"></i>
            <span class="truncate text-sm">Kelola Galeri</span>
        </a>

        <div class="text-xs font-semibold text-white/60 uppercase tracking-wider mb-3 px-2 mt-6">Manajemen User</div>

        <a href="{{ url('/dashboard/user-approval') }}"
            class="nav-item {{ Request::is('dashboard/user-approval*') ? 'active' : '' }} flex items-center px-3 py-3 hover:bg-white/10 rounded-lg transition-all duration-200 group text-white">
            <i class="fas fa-user-check mr-3 flex-shrink-0 text-sm"></i>
            <span class="truncate text-sm">Persetujuan User</span>
            @php
                try {
                    $pendingCount = \App\Models\User::where('approval_status', 'pending')->count();
                } catch (\Exception $e) {
                    $pendingCount = 0;
                }
            @endphp
            @if($pendingCount > 0)
                <span class="ml-auto bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-medium">{{ $pendingCount }}</span>
            @endif
        </a>
    </nav>

    <!-- User info section -->
    <div class="px-3 md:px-4 py-3 border-t border-white/10">
        <div class="flex items-center space-x-3 mb-3">
            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-white/60">Administrator</p>
            </div>
        </div>

        <!-- Logout Button -->
        <button id="logout-button"
            class="flex items-center px-3 py-2.5 hover:bg-red-600/80 rounded-lg transition-all duration-200 group w-full text-left">
            <i class="fa-solid fa-right-from-bracket mr-3 flex-shrink-0 text-sm text-red-300 group-hover:text-white"></i>
            <span class="truncate text-sm font-medium text-red-300 group-hover:text-white">Logout</span>
        </button>
    </div>
</aside>

<style>
.nav-item.active {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-left: 3px solid rgba(255, 255, 255, 0.8);
}

.nav-item:hover {
    transform: translateX(2px);
}

.nav-item.active:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Custom scrollbar for sidebar */
nav::-webkit-scrollbar {
    width: 4px;
}

nav::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 2px;
}

nav::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
}

nav::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}
</style>

<script>
    $('#logout-button').on('click', function(e) {
        e.preventDefault();

        // Show loading state
        const $button = $(this);
        const originalContent = $button.html();
        $button.html('<i class="fas fa-spinner fa-spin mr-3 text-sm"></i><span class="text-sm font-medium">Memproses...</span>');
        $button.prop('disabled', true);

        Swal.fire({
            html: `
                <div class="flex flex-col items-center px-4">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-sign-out-alt text-red-500 text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2 text-center">Keluar dari Panel Admin?</h2>
                    <p class="text-sm text-gray-600 text-center mb-4">Anda yakin ingin keluar dari panel admin?<br>Semua data akan tetap aman.</p>
                </div>
            `,
            showCancelButton: true,
            showConfirmButton: true,
            customClass: {
                popup: 'rounded-2xl px-6 py-8 max-w-md shadow-2xl',
                cancelButton: 'bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold text-sm hover:bg-gray-300 transition-colors',
                confirmButton: 'bg-red-600 text-white px-6 py-3 rounded-lg font-semibold text-sm hover:bg-red-700 transition-colors ml-3',
                actions: 'flex justify-center gap-3 mt-6'
            },
            buttonsStyling: false,
            confirmButtonText: '<i class="fas fa-sign-out-alt mr-2"></i>Keluar',
            cancelButtonText: 'Batal',
            didOpen: () => {
                // Reset button state when modal opens
                $button.html(originalContent);
                $button.prop('disabled', false);
            },
            didClose: () => {
                // Reset button state when modal closes
                $button.html(originalContent);
                $button.prop('disabled', false);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading in confirm button
                Swal.update({
                    confirmButtonText: '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...'
                });

                $.ajax({
                    url: "{{ route('logout') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Logout',
                            text: 'Anda akan dialihkan ke halaman login...',
                            timer: 1500,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        }).then(() => {
                            window.location.href = "{{ route('login') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Logout',
                            text: 'Terjadi kesalahan saat logout. Silakan coba lagi.',
                            customClass: {
                                popup: 'rounded-2xl',
                                confirmButton: 'bg-red-600 text-white px-6 py-3 rounded-lg font-semibold'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }
        });
    });

    // Add subtle entrance animation for sidebar items
    $(document).ready(function() {
        $('.nav-item').each(function(index) {
            $(this).css({
                'opacity': '0',
                'transform': 'translateX(-20px)'
            }).delay(index * 100).animate({
                'opacity': '1'
            }, 300).css('transform', 'translateX(0)');
        });
    });
</script>
