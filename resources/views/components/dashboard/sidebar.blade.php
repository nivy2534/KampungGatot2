<aside class="w-56 md:w-60 text-white flex flex-col h-screen overflow-hidden"
    style="background-color: rgb(27, 58, 109) !important;">
    <div class="flex items-center space-x-2 p-3 md:p-4 border-b border-white/10">
        <div class="flex space-x-1.5">
            <img src="{{ asset('assets/img/logo_tutwuri.png') }}" class="h-8 w-8 md:h-9 md:w-9 flex-shrink-0" alt="Logo Tutwuri">
            <img src="{{ asset('assets/img/logo_unm.png') }}" class="h-8 w-8 md:h-9 md:w-9 flex-shrink-0" alt="Logo UNM">
        </div>
        <div class="min-w-0 flex-1">
            <h1 class="text-sm md:text-base font-semibold leading-tight truncate">Kampung Gatot</h1>
            <p class="text-xs text-white/70">Panel Admin</p>
        </div>
    </div>
    
    <nav class="flex flex-col px-3 md:px-4 py-4 space-y-1 flex-1 overflow-hidden">

        <a href="{{ url('/dashboard') }}"
            class="{{ Request::is('dashboard') ? 'bg-primary' : '' }} flex items-center px-3 py-2.5 hover:bg-primary rounded-md transition-colors duration-200 group text-white">
            <i class="fa-solid fa-house mr-2.5 flex-shrink-0 text-sm text-white"></i> 
            <span class="truncate text-sm text-white">Dashboard</span>
        </a>

        <a href="{{ url('/dashboard/blogs') }}"
            class="{{ Request::is('blogs*') ? 'bg-primary' : '' }} flex items-center px-3 py-2.5 hover:bg-primary rounded-md transition-colors duration-200 group text-white">
            <i class="fas fa-newspaper w-4 text-center mr-3 text-white"></i>
            <span class="text-sm text-white">Kelola Blog</span>
        </a>

        <a href="{{ url('/dashboard/products') }}"
            class="{{ Request::is('products*') ? 'bg-primary' : '' }} flex items-center px-3 py-2.5 hover:bg-primary rounded-md transition-colors duration-200 group text-white">
            <i class="fas fa-box w-4 text-center mr-3 text-white"></i>
            <span class="text-sm text-white">Kelola Produk</span>
        </a>
        <a href="#" class="flex items-center px-3 py-2.5 hover:bg-primary rounded-md transition-colors duration-200 group text-white">
            <i class="fa-solid fa-image mr-2.5 flex-shrink-0 text-sm text-white"></i> 
            <span class="truncate text-sm text-white">Kelola Galeri</span>
        </a>
    </nav>
        
    <!-- Logout Button - Fixed at bottom -->
    <div class="p-3 md:p-4 border-t border-white/10">
        <a href="javascript:void()" id="logout-button"
            class="flex items-center px-3 py-2.5 hover:bg-red-600 rounded-md transition-colors duration-200 group w-full">
            <i class="fa-solid fa-right-from-bracket mr-2.5 flex-shrink-0 text-sm" style="color: #ffffff;"></i> 
            <span class="truncate text-sm">Logout</span>
        </a>
    </div>
</aside>

<script>
    $('#logout-button').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
            html: `
                <div class="flex flex-col items-center px-4">
                    <img src="/assets/cms/logout.svg" alt="Logout" class="w-32 h-32 md:w-40 md:h-40 mb-4">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-2 text-center">Keluar dari Aplikasi?</h2>
                    <p class="text-sm text-gray-600 text-center">Kamu yakin ingin keluar?<br>Semua data tetap aman dan bisa diakses kembali saat login.</p>
                </div>
            `,
            showCancelButton: true,
            showConfirmButton: true,
            customClass: {
                popup: 'rounded-xl px-4 py-6 md:px-6 md:py-8 max-w-sm md:max-w-md',
                cancelButton: 'w-full bg-red-500 text-white px-4 py-2 md:px-6 md:py-2 rounded font-semibold text-sm md:text-base',
                confirmButton: 'w-full border border-red-500 text-red-500 px-4 py-2 md:px-6 md:py-2 rounded font-semibold text-sm md:text-base',
                actions: 'w-full flex flex-col-reverse gap-3 mt-4 md:mt-6'
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
