@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex">
        <!-- Left Side - Image Section -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="absolute inset-0"
                style="background-image: url('{{ asset('assets/img/bg-login.jpg') }}'); background-size: cover; background-position: center;">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

            <div class="relative z-10 flex flex-col justify-start items-start p-12 text-white text-left">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <img src="{{ asset('assets/img/logo_tutwuri.png') }}" alt="Login Image"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <img src="{{ asset('assets/img/logo_unm.png') }}" alt="Login Image"
                            class="w-full h-full object-cover" />
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-2xl font-bold">Desa Ngebruk</h1>
                        <p class="text-sm text-white/80">Panel Admin</p>
                    </div>
                </div>

                <h2 class="text-4xl font-light leading-tight">
                    Mulai kelola dan kembangkan website Desa Ngebruk dengan mudah melalui panel admin
                </h2>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-12">
            <div class="max-w-md w-full space-y-8">
                <!-- Header - Mobile Logo (Hidden on Desktop) -->
                <div class="text-center lg:hidden mb-8">
                    <div class="flex justify-center items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-village text-white text-xl"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-800">Desa Ngebruk</h1>
                    </div>
                </div>

                <!-- Form Header -->
                <div class="text-left mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
                        Masuk
                    </h2>
                    <p class="text-gray-600">
                        Masuk ke akun Anda untuk melanjutkan
                    </p>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-2xl">
                    <form class="space-y-6" action="#" method="POST">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Email
                            </label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full pl-3 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-400"
                                placeholder="Masukkan alamat email...">
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Kata Sandi
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full pl-3 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 placeholder-gray-400"
                                    placeholder="Masukkan kata sandi...">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button id="togglePassword" type="button"
                                        class="text-gray-400 hover:text-gray-600 transition duration-200">
                                        <i id="toggleIcon" class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <label class="ml-2 block text-sm text-gray-700">
                                    Dilindungi dan bagian dari Kebijakan Privasi dan Ketentuan Penggunaan
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button id="submitBtn" type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                            Masuk
                        </button>
                    </form>
                    <!-- Register Link -->
                    <div class="mt-4 text-left">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="font-medium text-blue-600 hover:text-blue-500 transition duration-200">
                                Daftar
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-8">
                    <p class="text-xs text-gray-500">
                        © 2024 Desa Ngebruk. Semua hak dilindungi.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script>
        $(document).ready(function() {
            // Fungsi untuk toggle password visibility (tidak berubah)
            function togglePassword() {
                const $passwordField = $('#password');
                const $toggleIcon = $('#toggleIcon');
                if ($passwordField.attr('type') === 'password') {
                    $passwordField.attr('type', 'text');
                    $toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $passwordField.attr('type', 'password');
                    $toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            }

            // Listener untuk ikon mata (perlu ditambahkan jika belum ada)
            $('#togglePassword').on('click', function() {
                togglePassword();
            });

            // ==========================================================
            // BAGIAN YANG DIUBAH: Form Submission dengan Ajax
            // ==========================================================
            $('form').on('submit', function(e) {
                e.preventDefault();

                // 1. Ambil data dari form (tidak berubah)
                const email = $('#email').val();
                const password = $('#password').val();

                // Validasi sederhana di sisi client (tidak berubah)
                if (!email || !password) {
                    alert('Mohon isi semua field yang diperlukan!');
                    return;
                }

                // 2. Ubah tampilan tombol menjadi loading (tidak berubah)
                const $button = $('#submitBtn');
                $button.html('<i class="fas fa-spinner fa-spin mr-2"></i>Proses masuk ...').prop(
                    'disabled', true);

                // ==========================================================
                // BAGIAN YANG DIUBAH: Kirim data menggunakan $.ajax()
                // ==========================================================
                $.ajax({
                    url: '/login-post', // <-- GANTI DENGAN URL API ANDA
                    method: 'POST',
                    data: {
                        email: email,
                        password: password,
                    },
                    success: function(response) {

                        if (response.success) {
                            // Arahkan ke halaman login atau dashboard
                            window.location.href = '/dashboard'; // <-- Ganti sesuai kebutuhan
                        } else {
                            alert(
                                'Login gagal, coba lagi.'
                            ); // ganti menggunakan sweetalert lebih bagus

                            $button.html('Masuk');
                        }
                    },
                    error: function(jqXHR) {
                        // 5. Handle jika request GAGAL
                        console.error('Terjadi error:', jqXHR.responseJSON);

                        // Tampilkan pesan error dari server jika ada, jika tidak, tampilkan pesan umum
                        const errorMessage = jqXHR.responseJSON?.message ||
                            'Login gagal, coba lagi.';
                        alert(errorMessage);

                        // Kembalikan tombol ke keadaan semula agar user bisa mencoba lagi
                        $button.html('Masuk').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
