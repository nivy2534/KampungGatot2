<aside class="w-96 text-white flex flex-col p-5 space-y-6 shadow-lg p-8"
    style="background-color: rgb(27, 58, 109) !important;">
    <div class="flex items-center space-x-3 mb-4">
        <img src="{{ asset('assets/img/logo_tutwuri.png') }}" class="h-12 w-12" alt="Logo">
        <img src="{{ asset('assets/img/logo_unm.png') }}" class="h-12 w-12" alt="Logo">
        <div>
            <h1 class="text-xl font-bold leading-tight">Kampung Gatot</h1>
            <p class="text-sm text-white/80">Panel Admin</p>
        </div>
    </div>
    <nav class="flex flex-col space-y-2 mt-4">
        <a href="#" class="px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-house mr-3" style="color: #ffffff;"></i> Dashboard
        </a>

        <a href="{{ url('/blogs') }}" class="px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-book mr-4" style="color: #ffffff;"></i> Kelola Blog
        </a>
        <a href="#" class="px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-cart-flatbed mr-3" style="color: #ffffff;"></i> Kelola Barang
        </a>
        <a href="#" class="px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-image mr-4" style="color: #ffffff;"></i> Kelola Galeri
        </a>
        <a href="javascript:void()" id="logout-button"
            class="px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-right-from-bracket mr-4" style="color: #ffffff;"></i> Logout
        </a>
    </nav>
</aside>

<script>
    $('#logout-button').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('logout') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                window.location.href = "{{ route('login') }}"; // redirect ke halaman login
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Gagal logout!');
            }
        });
    });
</script>
