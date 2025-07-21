<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
</body>

</html>
