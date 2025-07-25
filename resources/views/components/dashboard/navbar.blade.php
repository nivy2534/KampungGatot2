<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex justify-between items-center px-4 md:px-6 py-3">
        <div class="flex items-center space-x-3">
            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="lg:hidden p-1.5 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>
            
            <div class="min-w-0 flex-1">
                <h1 class="text-lg md:text-xl font-bold text-gray-900 truncate">Dashboard</h1>
            </div>
        </div>
        
        <div class="flex items-center space-x-2 md:space-x-3">
            <span class="hidden sm:block text-xs md:text-sm text-gray-600 truncate">
                Selamat datang, <span class="font-medium">{{ Auth::user()->name }}</span>
            </span>
            <div class="w-7 h-7 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-user text-gray-600 text-xs"></i>
            </div>
        </div>
    </div>
</header>
