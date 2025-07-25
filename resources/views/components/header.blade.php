<header class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-sm border-b border-gray-200 shadow-sm">
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
                {{-- Login Button (Desktop) --}}
                <a href="/login"
                   class="hidden lg:inline-flex items-center justify-center px-4 py-2 bg-[#1B3A6D] text-white text-sm font-semibold rounded-lg hover:bg-[#0f2a4f] focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-colors duration-200">
                    Login
                </a>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-toggle" 
                        class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-colors duration-200"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        aria-label="Toggle navigation menu">
                    <svg class="w-6 h-6 hamburger-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6 close-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation Menu --}}
        <div id="mobile-menu" 
             class="lg:hidden hidden border-t border-gray-200 bg-white/95 backdrop-blur-sm"
             role="navigation"
             aria-label="Mobile navigation">
            <div class="py-4 space-y-1">
                <a href="{{ url('/') }}"
                   class="mobile-nav-link {{ Request::is('/') ? 'active' : '' }}"
                   aria-current="{{ Request::is('/') ? 'page' : 'false' }}">
                    Home
                </a>
                <a href="{{ route('blog') }}"
                   class="mobile-nav-link {{ Request::is('blog') ? 'active' : '' }}"
                   aria-current="{{ Request::is('blog') ? 'page' : 'false' }}">
                    Blog
                </a>
                <a href="{{ url('/galeri') }}"
                   class="mobile-nav-link {{ Request::is('galeri') ? 'active' : '' }}"
                   aria-current="{{ Request::is('galeri') ? 'page' : 'false' }}">
                    Galeri
                </a>
                <a href="{{ url('/event') }}"
                   class="mobile-nav-link {{ Request::is('event') ? 'active' : '' }}"
                   aria-current="{{ Request::is('event') ? 'page' : 'false' }}">
                    Belanja
                </a>
                
                {{-- Mobile Login Button --}}
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <a href="/login"
                       class="block w-full px-4 py-3 bg-[#1B3A6D] text-white text-center font-semibold rounded-lg hover:bg-[#0f2a4f] focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:ring-offset-2 transition-colors duration-200">
                        Login
                    </a>
                </div>
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

/* Mobile Navigation Styles */
.mobile-nav-link {
    @apply block px-4 py-3 text-base font-medium text-gray-700 rounded-lg transition-all duration-300 hover:text-[#1B3A6D] hover:bg-gray-50;
    position: relative;
}

.mobile-nav-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    width: 0;
    height: 60%;
    background: #1B3A6D;
    border-radius: 0 4px 4px 0;
    transition: all 0.3s ease;
    transform: translateY(-50%);
}

.mobile-nav-link:hover::before {
    width: 3px;
}

.mobile-nav-link.active {
    @apply text-[#1B3A6D] font-semibold bg-blue-50;
}

.mobile-nav-link.active::before {
    width: 4px;
    transition: width 0.4s ease;
}

/* Mobile menu animation */
#mobile-menu {
    transition: all 0.3s ease-in-out;
    transform-origin: top;
}

#mobile-menu.show {
    @apply block;
    animation: slideDown 0.3s ease-out;
}

#mobile-menu.hide {
    animation: slideUp 0.3s ease-in;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-10px);
    }
}

/* Header glass effect */
header {
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

/* Backdrop blur fallback */
@supports not (backdrop-filter: blur(12px)) {
    header {
        @apply bg-white;
    }
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

/* Smooth transitions for mobile text visibility */
.brand-section h1,
.brand-section p {
    animation: textSlideIn 0.5s ease-out;
}

@keyframes textSlideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');
    const hamburgerIcon = toggle?.querySelector('.hamburger-icon');
    const closeIcon = toggle?.querySelector('.close-icon');
    
    if (toggle && menu && hamburgerIcon && closeIcon) {
        let isOpen = false;
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            isOpen = !isOpen;
            
            // Update ARIA attributes
            toggle.setAttribute('aria-expanded', isOpen.toString());
            
            if (isOpen) {
                // Show menu
                menu.classList.remove('hidden');
                menu.classList.add('show');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
            } else {
                // Hide menu
                menu.classList.add('hide');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                
                // Restore body scroll
                document.body.style.overflow = '';
                
                // Remove menu after animation
                setTimeout(() => {
                    menu.classList.add('hidden');
                    menu.classList.remove('show', 'hide');
                }, 300);
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (isOpen && !toggle.contains(e.target) && !menu.contains(e.target)) {
                toggle.click();
            }
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) {
                toggle.click();
            }
        });
        
        // Close menu when window is resized to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024 && isOpen) {
                toggle.click();
            }
        });
        
        // Handle navigation link clicks in mobile menu
        const mobileNavLinks = menu.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (isOpen) {
                    // Small delay to allow page navigation
                    setTimeout(() => {
                        if (toggle) toggle.click();
                    }, 150);
                }
            });
        });
    }
});
</script>
