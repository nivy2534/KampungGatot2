<header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
    <div class="flex justify-between items-center px-4 md:px-6 py-3">
        <div class="flex items-center space-x-3">
            <!-- Mobile menu button with improved styling -->
            <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#1B3A6D] transition-all duration-200">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>

            <div class="min-w-0 flex-1">
                <h1 class="text-lg md:text-xl font-bold text-gray-900 truncate">Dashboard</h1>
                <p class="text-xs text-gray-500 hidden sm:block">Panel Administrasi Desa Ngebruk</p>
            </div>
        </div>

        <!-- Right side with user info and notifications -->
        <div class="flex items-center space-x-3 md:space-x-4">
            <!-- Notifications bell -->
            <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1B3A6D]">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            <!-- User info section -->
            <div class="relative" id="user-dropdown">
                <button id="user-dropdown-button"
                        class="flex items-center space-x-3 px-2 py-1.5 bg-white hover:bg-gray-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-colors duration-200 pl-3 border-l border-gray-200">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <!-- Profile Picture -->
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-[#1B3A6D] rounded-full flex items-center justify-center">
                        <span class="text-white text-sm md:text-base font-semibold">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </span>
                    </div>
                    <!-- Dropdown Arrow -->
                    <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200" id="dropdown-arrow"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="user-dropdown-menu"
                     class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50 opacity-0 invisible transition-all duration-200 ease-in-out">
                    <!-- User Info Header -->
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-[#1B3A6D] rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">
                                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Administrator' }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="{{ url('/') }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-home mr-3 text-[#1B3A6D]"></i>
                            Kembali ke Halaman Utama
                        </a>
                        <button id="logout-dropdown-btn"
                                class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress bar for page loading -->
    <div id="page-loading-bar" class="hidden h-0.5 bg-[#1B3A6D] opacity-0 transition-opacity duration-300"></div>
</header>

<style>
/* Loading bar animation */
@keyframes loading {
    0% { width: 0%; }
    50% { width: 70%; }
    100% { width: 100%; }
}

.loading-active {
    animation: loading 1s ease-in-out;
}

/* Mobile menu button hover effect */
#mobile-menu-button:hover i {
    transform: scale(1.1);
}

/* User dropdown styles */
#user-dropdown-button {
    transition: all 0.2s ease;
}

#user-dropdown-button:hover {
    background-color: rgba(0, 0, 0, 0.05);
}

#user-dropdown-menu {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(10px);
    transition: opacity 200ms ease-in-out !important;
    transform: none !important;
    animation: none !important;
}

#user-dropdown-menu.dropdown-opening {
    opacity: 1 !important;
    visibility: visible !important;
}

#user-dropdown-menu.dropdown-closing {
    opacity: 0 !important;
}

.rotate-180 {
    transform: rotate(180deg);
}
</style>

<script>
$(document).ready(function() {
    // Add loading bar functionality
    function showLoadingBar() {
        $('#page-loading-bar').removeClass('hidden').addClass('opacity-100 loading-active');
    }

    function hideLoadingBar() {
        $('#page-loading-bar').removeClass('loading-active').addClass('opacity-0');
        setTimeout(() => {
            $('#page-loading-bar').addClass('hidden');
        }, 300);
    }

    // Show loading bar on navigation
    $('a[href]').on('click', function(e) {
        const href = $(this).attr('href');
        if (href && href !== '#' && href !== 'javascript:void(0)' && !href.startsWith('mailto:') && !href.startsWith('tel:')) {
            showLoadingBar();
        }
    });

    // Hide loading bar when page loads
    $(window).on('load', function() {
        hideLoadingBar();
    });

    // Add entrance animation
    $('header').css({
        'transform': 'translateY(-100%)',
        'opacity': '0'
    }).animate({
        'opacity': '1'
    }, 300).css('transform', 'translateY(0)');

    // User dropdown functionality
    const userDropdownButton = document.getElementById('user-dropdown-button');
    const userDropdownMenu = document.getElementById('user-dropdown-menu');
    const dropdownArrow = document.getElementById('dropdown-arrow');

    if (userDropdownButton && userDropdownMenu) {
        let isDropdownOpen = false;

        function openDropdown() {
            isDropdownOpen = true;
            userDropdownMenu.classList.remove('dropdown-closing');
            userDropdownMenu.classList.add('dropdown-opening');
            userDropdownMenu.style.visibility = 'visible';
            if (dropdownArrow) dropdownArrow.classList.add('rotate-180');
        }

        function closeDropdown() {
            isDropdownOpen = false;
            userDropdownMenu.classList.remove('dropdown-opening');
            userDropdownMenu.classList.add('dropdown-closing');
            if (dropdownArrow) dropdownArrow.classList.remove('rotate-180');
            
            // Tunggu transisi selesai baru ubah visibility
            setTimeout(() => {
                if (!isDropdownOpen) {
                    userDropdownMenu.style.visibility = 'hidden';
                    userDropdownMenu.classList.remove('dropdown-closing');
                }
            }, 200);
        }

        userDropdownButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (isDropdownOpen) {
                closeDropdown();
            } else {
                openDropdown();
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (isDropdownOpen && !userDropdownButton.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                closeDropdown();
            }
        });

        // Close dropdown when pressing escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isDropdownOpen) {
                closeDropdown();
            }
        });
    }

    // Logout functionality from dropdown
    $('#logout-dropdown-btn').on('click', function(e) {
        e.preventDefault();

        // Show loading state
        const $button = $(this);
        const originalContent = $button.html();
        $button.html('<i class="fas fa-spinner fa-spin mr-2 text-sm"></i>Memproses...');
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
                            showConfirmButton: false,
                            timer: 1200
                        });
                        setTimeout(function() {
                            window.location.href = '/login';
                        }, 1200);
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Logout',
                            text: 'Terjadi kesalahan saat logout. Silakan coba lagi.',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    });
});
</script>
