<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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

        // Mobile sidebar toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        // Close sidebar when clicking overlay
        document.getElementById('sidebar-overlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
</body>

</html>
