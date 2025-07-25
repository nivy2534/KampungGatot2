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
        <a href="{{ url('/dashboard') }}"
            class="{{ Request::is('dashboard') ? 'bg-primary' : '' }} px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-house mr-3" style="color: #ffffff;"></i> Dashboard
        </a>

        <a href="{{ url('/dashboard/blogs') }}"
            class="{{ Request::is('blogs') ? 'bg-primary' : '' }} px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-book mr-4" style="color: #ffffff;"></i> Kelola Blog
        </a>
        <a href="{{ url('/dashboard/products') }}"
            class="{{ Request::is('products') ? 'bg-primary' : '' }} px-4 py-4 hover:bg-primary rounded transition-colors duration-200">
            <i class="fa-solid fa-book mr-4" style="color: #ffffff;"></i> Kelola Barang
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

        Swal.fire({
            html: `
                <div class="flex flex-col items-center">
                    <img src="/assets/cms/logout.svg" alt="Logout" class="w-40 h-40 mb-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Aplikasi?</h2>
                    <p class="text-sm text-gray-600">Kamu yakin ingin keluar?<br>Semua data tetap aman dan bisa diakses kembali saat login.</p>
                </div>
            `,
            showCancelButton: true,
            showConfirmButton: true,
            customClass: {
                popup: 'rounded-xl px-6 py-8',
                cancelButton: ' w-full bg-red-500 text-white px-6 py-2 rounded font-semibold',
                confirmButton: ' w-full border border-red-500 text-red-500 px-6 py-2 rounded font-semibold',
                actions: ' w-full flex flex-col-reverse gap-3 mt-6'
            },
            buttonsStyling: false,
            confirmButtonText: 'Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('logout') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        window.location.href = "{{ route('login') }}";
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal', 'Logout gagal dilakukan.', 'error');
                    }
                });
            }
        });
    });
</script>
