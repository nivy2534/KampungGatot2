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
            <div class="flex items-center space-x-3 pl-3 border-l border-gray-200">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
                
                <!-- User avatar -->
                <div class="w-8 h-8 md:w-10 md:h-10 bg-[#1B3A6D] rounded-full flex items-center justify-center">
                    <span class="text-white text-sm md:text-base font-semibold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </span>
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

/* Notification bell pulse */
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.notification-pulse {
    animation: pulse 2s infinite;
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

    // Add notification bell pulse effect
    setInterval(() => {
        $('.fa-bell').parent().addClass('notification-pulse');
        setTimeout(() => {
            $('.fa-bell').parent().removeClass('notification-pulse');
        }, 2000);
    }, 10000);
});
</script>
