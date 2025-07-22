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
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        @include('components.dashboard.sidebar')
        <div class="flex-1 flex flex-col">
            @include('components.dashboard.navbar')
            <main class="p-6 flex-1">
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
    </script>
</body>

</html>
