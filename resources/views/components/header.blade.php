<header class="sticky top-0 z-50 w-full bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-18">
            {{-- Brand Section --}}
            <div class="brand-section flex items-center gap-3 shrink-0 min-w-0">
                <img src="{{ asset('assets/img/logo_ngebruk.png') }}" 
                     alt="Logo Desa Ngebruk" 
                     class="w-10 h-10 lg:w-12 lg:h-12 object-contain flex-shrink-0" />
                <div class="flex flex-col justify-center min-w-0">
                    <h1 class="text-gray-900 text-xs lg:text-sm font-bold font-['Inter'] leading-tight truncate">
                        Desa Ngebruk
                    </h1>
                    <p class="text-gray-600 text-xs lg:text-xs font-normal font-['Inter'] leading-tight truncate">
                        Kecamatan Sumberpucung
                    </p>
                </div>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}"
                   class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                   aria-current="{{ Request::is('/') ? 'page' : 'false' }}">
                    Home
                </a>
                <a href="{{ route('blog') }}"
                   class="nav-link {{ Request::is('blog') ? 'active' : '' }}"
                   aria-current="{{ Request::is('blog') ? 'page' : 'false' }}">
                    Blog
                </a>
                <a href="{{ url('/galeri') }}"
                   class="nav-link {{ Request::is('galeri') ? 'active' : '' }}"
                   aria-current="{{ Request::is('galeri') ? 'page' : 'false' }}">
                    Galeri
                </a>
                <a href="{{ url('/event') }}"
                   class="nav-link {{ Request::is('event') ? 'active' : '' }}"
                   aria-current="{{ Request::is('event') ? 'page' : 'false' }}">
                    Belanja
                </a>
            </nav>

            {{-- Action Section --}}
            <div class="flex items-center gap-4">
                {{-- Authentication Buttons (Desktop) --}}
                @auth
                    <div class="hidden md:flex items-center gap-3">
                        <!-- User Profile Dropdown -->
                        <div class="relative" id="user-dropdown">
                            <button id="user-dropdown-button" 
                                    class="flex items-center space-x-3 px-2 py-1.5 bg-white hover:bg-gray-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-colors duration-200">
                                <!-- Profile Picture -->
                                <div class="w-8 h-8 bg-[#1B3A6D] rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <!-- User Info -->
                                <div class="flex flex-col items-start">
                                    <span class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</span>
                                    <span class="text-xs text-gray-500">Admin</span>
                                </div>
                                <!-- Dropdown Arrow -->
                                <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200" id="dropdown-arrow"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="user-dropdown-menu" 
                                 class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50 hidden opacity-0 transform scale-95 transition-all duration-200">
                                <!-- User Info Header -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-[#1B3A6D] rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-2">
                                    <a href="{{ route('dashboard') }}" 
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-tachometer-alt mr-3 text-[#1B3A6D]"></i>
                                        Dashboard
                                    </a>
                                    <button id="dropdown-logout-btn" 
                                            class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        Logout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/login"
                       class="hidden md:inline-flex items-center justify-center px-4 py-2 bg-[#1B3A6D] text-white text-sm font-semibold rounded-lg hover:bg-[#0f2a4f] focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-colors duration-200">
                        Login
                    </a>
                @endauth

                {{-- Mobile Menu Toggle --}}
                <button id="mobile-menu-toggle" 
                        class="md:hidden p-2 rounded-lg text-gray-600 hover:text-[#1B3A6D] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] transition-all duration-200"
                        aria-expanded="false"
                        aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Overlay --}}
    <div id="mobile-overlay" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 transition-all duration-300" style="opacity: 0; visibility: hidden; pointer-events: none;"></div>

    {{-- Mobile Side Menu --}}
    <div id="mobile-menu" class="md:hidden fixed top-0 right-0 h-full w-80 max-w-sm bg-white shadow-xl z-50 transition-transform duration-300 ease-out" style="transform: translateX(100%);">
        <div class="flex flex-col h-full">
            {{-- Mobile Menu Header --}}
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/img/logo_ngebruk.png') }}" 
                         alt="Logo Desa Ngebruk" 
                         class="w-8 h-8 object-contain" />
                    <div>
                        <h2 class="text-sm font-bold text-gray-900">Desa Ngebruk</h2>
                        <p class="text-xs text-gray-500">Kecamatan Sumberpucung</p>
                    </div>
                </div>
                <button id="mobile-menu-close" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- Mobile Navigation Links --}}
            <nav class="flex-1 px-4 py-6">
                <div class="space-y-2">
                    <a href="{{ url('/') }}" 
                       class="mobile-nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="fas fa-home text-lg"></i>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('blog') }}" 
                       class="mobile-nav-link {{ Request::is('blog') ? 'active' : '' }}">
                        <i class="fas fa-blog text-lg"></i>
                        <span>Blog</span>
                    </a>
                    <a href="{{ url('/galeri') }}" 
                       class="mobile-nav-link {{ Request::is('galeri') ? 'active' : '' }}">
                        <i class="fas fa-images text-lg"></i>
                        <span>Galeri</span>
                    </a>
                    <a href="{{ url('/event') }}" 
                       class="mobile-nav-link {{ Request::is('event') ? 'active' : '' }}">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <span>Belanja</span>
                    </a>
                </div>
            </nav>

            {{-- Mobile User Section --}}
            <div class="border-t border-gray-200 p-4">
                @auth
                    <div class="mb-4">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-12 h-12 bg-[#1B3A6D] rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <a href="{{ route('dashboard') }}" 
                               class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <i class="fas fa-tachometer-alt mr-3 text-[#1B3A6D]"></i>
                                Dashboard
                            </a>
                            <button id="mobile-logout-btn" 
                                    class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Logout
                            </button>
                        </div>
                    </div>
                @else
                    <a href="/login" 
                       class="flex items-center justify-center px-4 py-3 bg-[#1B3A6D] text-white rounded-lg hover:bg-[#0f2a4f] transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<style>
/* Navigation Styles */
.nav-link {
    @apply relative px-4 py-2 text-sm font-medium text-gray-700 rounded-md transition-all duration-300 hover:text-[#1B3A6D];
    position: relative;
}

.nav-link::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    width: 0;
    height: 2px;
    background: #1B3A6D;
    border-radius: 1px;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::before {
    width: 60%;
}

.nav-link.active {
    @apply text-[#1B3A6D] font-semibold;
}

.nav-link.active::before {
    width: 80%;
    transition: width 0.4s ease;
}

/* Brand section responsive animation */
.brand-section {
    animation: brandFadeIn 0.6s ease-out;
}

@keyframes brandFadeIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Logo hover effect */
.brand-section img {
    transition: transform 0.3s ease;
}

.brand-section:hover img {
    transform: scale(1.05) rotate(2deg);
}

/* Mobile Navigation Styles */
.mobile-nav-link {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    color: #374151;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    font-weight: 500;
}

.mobile-nav-link i {
    width: 20px;
    margin-right: 12px;
    color: #6b7280;
}

.mobile-nav-link:hover {
    background-color: #f3f4f6;
    color: #1B3A6D;
}

.mobile-nav-link:hover i {
    color: #1B3A6D;
}

.mobile-nav-link.active {
    background-color: #eff6ff;
    color: #1B3A6D;
    font-weight: 600;
}

.mobile-nav-link.active i {
    color: #1B3A6D;
}

/* Mobile overlay and menu animations */
/* Removed conflicting CSS classes - using inline styles in JS for better control */

/* Prevent body scroll when mobile menu is open */
body.mobile-menu-open {
    overflow: hidden;
}

/* Hamburger icon animation */
#mobile-menu-toggle.active svg {
    transform: rotate(90deg);
}
</style>

<script>
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, initializing mobile menu...');
        
        // Namespace untuk mencegah konflik
        if (window.mobileMenuInitialized) {
            console.log('Mobile menu already initialized, skipping...');
            return;
        }
        
        // Mobile menu elements
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const mobileClose = document.getElementById('mobile-menu-close');
        
        console.log('Elements found:', {
            toggle: !!mobileToggle,
            menu: !!mobileMenu, 
            overlay: !!mobileOverlay,
            close: !!mobileClose
        });
        
        // Check if elements exist
        if (!mobileToggle || !mobileMenu || !mobileOverlay) {
            console.error('Required mobile menu elements not found!');
            return;
        }
        
        let isMobileMenuOpen = false;
        
        // Mark as initialized
        window.mobileMenuInitialized = true;

    // Simple toggle function
    function openMenu() {
        console.log('Opening menu...');
        isMobileMenuOpen = true;
        mobileOverlay.style.visibility = 'visible';
        mobileOverlay.style.opacity = '1';
        mobileOverlay.style.pointerEvents = 'auto';
        mobileMenu.style.transform = 'translateX(0)';
        mobileToggle.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMenu() {
        console.log('Closing menu...');
        isMobileMenuOpen = false;
        mobileOverlay.style.opacity = '0';
        mobileOverlay.style.pointerEvents = 'none';
        mobileMenu.style.transform = 'translateX(100%)';
        mobileToggle.classList.remove('active');
        document.body.style.overflow = '';
        setTimeout(() => {
            if (!isMobileMenuOpen) {
                mobileOverlay.style.visibility = 'hidden';
            }
        }, 300);
    }
    
    // Single event listener for toggle dengan proteksi tambahan
    mobileToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation(); // Prevent other handlers
        
        console.log('=== TOGGLE CLICKED ===');
        console.log('Current state before:', isMobileMenuOpen);
        console.log('Event target:', e.target);
        console.log('Current target:', e.currentTarget);
        
        if (isMobileMenuOpen) {
            console.log('Will close menu');
            closeMenu();
        } else {
            console.log('Will open menu');
            openMenu();
        }
        
        console.log('State after:', isMobileMenuOpen);
        console.log('===================');
        
        return false; // Extra prevention
    }, true); // Use capture phase to get event first
    
    // Close button
    if (mobileClose) {
        mobileClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Close button clicked');
            if (isMobileMenuOpen) {
                closeMenu();
            }
        });
    }
    
    // Overlay click - only when visible
    mobileOverlay.addEventListener('click', function(e) {
        console.log('Overlay click detected, menu open:', isMobileMenuOpen);
        if (isMobileMenuOpen && e.target === mobileOverlay) {
            console.log('Closing via overlay click');
            closeMenu();
        }
    });
    
    // Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMobileMenuOpen) {
            console.log('Escape pressed');
            closeMenu();
        }
    });
    
    // Resize handler
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && isMobileMenuOpen) {
            console.log('Resize to desktop');
            closeMenu();
        }
    });
    
    // Nav links
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            console.log('Nav link clicked');
            if (isMobileMenuOpen) {
                setTimeout(() => closeMenu(), 100);
            }
        });
    });

    // Desktop dropdown menu functionality
    const userDropdownButton = document.getElementById('user-dropdown-button');
    const userDropdownMenu = document.getElementById('user-dropdown-menu');
    const dropdownArrow = document.getElementById('dropdown-arrow');
    
    if (userDropdownButton && userDropdownMenu) {
        let isDropdownOpen = false;

        function toggleDropdown() {
            isDropdownOpen = !isDropdownOpen;
            
            if (isDropdownOpen) {
                userDropdownMenu.classList.remove('hidden', 'opacity-0', 'scale-95');
                userDropdownMenu.classList.add('opacity-100', 'scale-100');
                dropdownArrow?.classList.add('rotate-180');
            } else {
                userDropdownMenu.classList.remove('opacity-100', 'scale-100');
                userDropdownMenu.classList.add('opacity-0', 'scale-95');
                dropdownArrow?.classList.remove('rotate-180');
                
                setTimeout(() => {
                    if (!isDropdownOpen) {
                        userDropdownMenu.classList.add('hidden');
                    }
                }, 200);
            }
        }

        userDropdownButton.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleDropdown();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            if (isDropdownOpen) {
                toggleDropdown();
            }
        });
    }

    // Logout functionality
    function handleLogout() {
        if (confirm('Apakah Anda yakin ingin logout?')) {
            fetch('/logout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '/login';
                } else {
                    alert('Logout gagal, silakan coba lagi');
                }
            })
            .catch(error => {
                console.error('Logout error:', error);
                alert('Terjadi kesalahan saat logout');
            });
        }
    }

    // Logout button event listeners
    const dropdownLogoutBtn = document.getElementById('dropdown-logout-btn');
    const mobileLogoutBtn = document.getElementById('mobile-logout-btn');
    
    if (dropdownLogoutBtn) {
        dropdownLogoutBtn.addEventListener('click', handleLogout);
    }
    
    if (mobileLogoutBtn) {
        mobileLogoutBtn.addEventListener('click', handleLogout);
    }
    
    }); // End of DOMContentLoaded
})(); // End of IIFE
</script>

