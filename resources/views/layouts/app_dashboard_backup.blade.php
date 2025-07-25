<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @vite(['resources/css/app.css'])
    
    <style>
        /* Prevent horizontal overflow */
        html, body {
            overflow-x: hidden;
            height: 100%;
        }
        
        /* Sidebar specific styles */
        .sidebar-container {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
        }
        
        /* Main content area */
        .main-content {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        /* Custom scrollbar for webkit browsers */
        .main-content::-webkit-scrollbar {
            width: 6px;
        }
        
        .main-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .main-content::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        
        .main-content::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Ensure table is responsive */
        .table-container {
            min-height: 400px;
        }
        
        /* Compact spacing */
        .compact-spacing {
            line-height: 1.3;
        }
        
        /* Container utama */
        .dashboard-container {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            width: 100vw;
            max-width: 100vw;
        }
        
        /* Sidebar specific styles */
        .sidebar-container {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
        }
        
        /* Main content area - hilangkan semua padding/margin */
        .main-content {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            width: 100%;
            max-width: 100%;
        }
        
        /* Force remove any inherited padding/margin */
        .dashboard-container,
        .dashboard-container > *,
        .main-content,
        .main-content > * {
            box-sizing: border-box;
        }
        
        /* Navbar and footer full width */
        .navbar-container,
        .footer-container {
            width: 100vw !important;
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box;
            position: relative;
            left: 0;
            right: 0;
        }
        
        .navbar-container header,
        .footer-container footer {
            width: 100% !important;
            margin: 0 !important;
        }
        
        /* Ensure no container classes add unwanted constraints */
        .container,
        .max-w-7xl,
        .mx-auto,
        .max-w-screen-xl,
        .max-w-full {
            max-width: none !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            width: 100% !important;
        }
        
        /* Override any Tailwind responsive constraints */
        @media (min-width: 640px) {
            .sm\\:container { max-width: none !important; }
        }
        @media (min-width: 768px) {
            .md\\:container { max-width: none !important; }
        }
        @media (min-width: 1024px) {
            .lg\\:container { max-width: none !important; }
        }
        @media (min-width: 1280px) {
            .xl\\:container { max-width: none !important; }
        }
        
        /* Custom scrollbar for webkit browsers - hilangkan width scrollbar */
        .main-content::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
        
        .main-content::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .main-content::-webkit-scrollbar-thumb {
            background: transparent;
        }
        
        .main-content::-webkit-scrollbar-thumb:hover {
            background: transparent;
        }
        
        /* For Firefox */
        .main-content {
            scrollbar-width: none;
        }
        
        /* Ensure table is responsive */
        .table-container {
            min-height: 400px;
        }
        
        /* Compact spacing */
        .compact-spacing {
            line-height: 1.3;
        }
        
        /* Mobile sidebar animation */
        @media (max-width: 1023px) {
            .sidebar-container {
                position: fixed;
                z-index: 40;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Mobile sidebar overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:static inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out lg:transition-none sidebar-container">
            @include('components.dashboard.sidebar')
        </div>
        
        <div class="flex-1 flex flex-col min-w-0 main-content">
            @include('components.dashboard.navbar')
            <main class="flex-1 p-3 md:p-4">
                @yield('content')
            </main>
            @include('components.dashboard.footer')
        </div>
    </div>

    @vite('resources/js/app.js')

    @stack('prepend-script')
    @stack('addon-script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Mobile menu toggle
        $(document).ready(function() {
            const sidebar = $('#sidebar');
            const sidebarOverlay = $('#sidebar-overlay');
            const mobileMenuButton = $('#mobile-menu-button');

            // Toggle mobile menu
            mobileMenuButton.on('click', function() {
                sidebar.toggleClass('-translate-x-full');
                sidebarOverlay.toggleClass('hidden');
            });

            // Close mobile menu when clicking overlay
            sidebarOverlay.on('click', function() {
                sidebar.addClass('-translate-x-full');
                sidebarOverlay.addClass('hidden');
            });

            // Close mobile menu when pressing escape
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    sidebar.addClass('-translate-x-full');
                    sidebarOverlay.addClass('hidden');
                }
            });

            // Close mobile menu when window is resized to desktop
            $(window).on('resize', function() {
                if ($(window).width() >= 1024) {
                    sidebar.removeClass('-translate-x-full');
                    sidebarOverlay.addClass('hidden');
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
