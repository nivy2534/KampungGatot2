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
            <nav class="hidden lg:flex items-center space-x-8">
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
                    <div class="hidden lg:flex items-center gap-3">
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
                       class="hidden lg:inline-flex items-center justify-center px-4 py-2 bg-[#1B3A6D] text-white text-sm font-semibold rounded-lg hover:bg-[#0f2a4f] focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-colors duration-200">
                        Login
                    </a>
                @endauth

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-toggle" 
                        class="lg:hidden relative inline-flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-all duration-200"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        aria-label="Toggle navigation menu">
                    <!-- Hamburger Lines -->
                    <div class="hamburger-container">
                        <span class="hamburger-line top"></span>
                        <span class="hamburger-line middle"></span>
                        <span class="hamburger-line bottom"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation Overlay --}}
    <div id="mobile-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden opacity-0 transition-opacity duration-300"></div>

    {{-- Mobile Navigation Menu --}}
    <div id="mobile-menu" 
         class="lg:hidden fixed top-16 left-0 right-0 bg-white shadow-lg z-50 transform -translate-y-full transition-transform duration-300 ease-out"
         role="navigation"
         aria-label="Mobile navigation">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <!-- Navigation Links -->
            <div class="space-y-2 mb-6">
                <a href="{{ url('/') }}"
                   class="mobile-nav-link {{ Request::is('/') ? 'active' : '' }}"
                   aria-current="{{ Request::is('/') ? 'page' : 'false' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Home</span>
                </a>
                <a href="{{ route('blog') }}"
                   class="mobile-nav-link {{ Request::is('blog') ? 'active' : '' }}"
                   aria-current="{{ Request::is('blog') ? 'page' : 'false' }}">
                    <i class="fas fa-blog w-5"></i>
                    <span>Blog</span>
                </a>
                <a href="{{ url('/galeri') }}"
                   class="mobile-nav-link {{ Request::is('galeri') ? 'active' : '' }}"
                   aria-current="{{ Request::is('galeri') ? 'page' : 'false' }}">
                    <i class="fas fa-images w-5"></i>
                    <span>Galeri</span>
                </a>
                <a href="{{ url('/event') }}"
                   class="mobile-nav-link {{ Request::is('event') ? 'active' : '' }}"
                   aria-current="{{ Request::is('event') ? 'page' : 'false' }}">
                    <i class="fas fa-shopping-bag w-5"></i>
                    <span>Belanja</span>
                </a>
            </div>

            <!-- Authentication Section -->
            <div class="border-t border-gray-200 pt-6">
                @auth
                    <!-- Mobile User Profile -->
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-[#1B3A6D] rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <a href="{{ route('dashboard') }}"
                           class="mobile-action-btn bg-[#1B3A6D] text-white hover:bg-[#0f2a4f]">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                        <button id="mobile-logout-btn"
                                class="mobile-action-btn bg-red-600 text-white hover:bg-red-700">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </div>
                @else
                    <a href="/login"
                       class="mobile-action-btn bg-[#1B3A6D] text-white hover:bg-[#0f2a4f]">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
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

/* Hamburger Animation */
.hamburger-container {
    position: relative;
    width: 20px;
    height: 14px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.hamburger-line {
    width: 100%;
    height: 2px;
    background-color: currentColor;
    border-radius: 1px;
    transition: all 0.3s ease;
    transform-origin: center;
}

.hamburger-line.top {
    transform: translateY(0) rotate(0deg);
}

.hamburger-line.middle {
    opacity: 1;
}

.hamburger-line.bottom {
    transform: translateY(0) rotate(0deg);
}

/* Active state for hamburger */
#mobile-menu-toggle.active .hamburger-line.top {
    transform: translateY(6px) rotate(45deg);
}

#mobile-menu-toggle.active .hamburger-line.middle {
    opacity: 0;
}

#mobile-menu-toggle.active .hamburger-line.bottom {
    transform: translateY(-6px) rotate(-45deg);
}

/* Mobile Navigation Styles */
.mobile-nav-link {
    @apply flex items-center space-x-3 px-4 py-3 text-base font-medium text-gray-700 rounded-lg transition-all duration-200 hover:text-[#1B3A6D] hover:bg-gray-50;
}

.mobile-nav-link.active {
    @apply text-[#1B3A6D] font-semibold bg-blue-50;
}

.mobile-action-btn {
    @apply w-full flex items-center justify-center space-x-2 px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2;
}

/* Mobile menu overlay animation */
#mobile-overlay {
    transition: opacity 0.3s ease;
}

#mobile-overlay.show {
    opacity: 1;
}

/* Mobile menu slide animation */
#mobile-menu {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#mobile-menu.show {
    transform: translateY(0);
}

/* Prevent body scroll when mobile menu is open */
body.mobile-menu-open {
    overflow: hidden;
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

/* Responsive text visibility */
@media (max-width: 640px) {
    .brand-section h1 {
        font-size: 0.75rem;
    }
    .brand-section p {
        font-size: 0.65rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu elements
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileOverlay = document.getElementById('mobile-overlay');
    
    let isMenuOpen = false;

    // Toggle mobile menu
    function toggleMobileMenu() {
        isMenuOpen = !isMenuOpen;
        
        // Update button state
        mobileToggle.classList.toggle('active', isMenuOpen);
        mobileToggle.setAttribute('aria-expanded', isMenuOpen);
        
        if (isMenuOpen) {
            // Show menu
            mobileOverlay.classList.remove('hidden');
            mobileMenu.classList.add('show');
            mobileOverlay.classList.add('show');
            document.body.classList.add('mobile-menu-open');
        } else {
            // Hide menu
            mobileMenu.classList.remove('show');
            mobileOverlay.classList.remove('show');
            document.body.classList.remove('mobile-menu-open');
            
            // Hide overlay after animation
            setTimeout(() => {
                if (!isMenuOpen) {
                    mobileOverlay.classList.add('hidden');
                }
            }, 300);
        }
    }

    // Close mobile menu
    function closeMobileMenu() {
        if (isMenuOpen) {
            toggleMobileMenu();
        }
    }

    // Event listeners
    if (mobileToggle) {
        mobileToggle.addEventListener('click', toggleMobileMenu);
    }

    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            closeMobileMenu();
        }
    });

    // Close menu on window resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024 && isMenuOpen) {
            closeMobileMenu();
        }
    });

    // Close menu when clicking mobile nav links
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Small delay to allow navigation
            setTimeout(closeMobileMenu, 150);
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
});
</script>

