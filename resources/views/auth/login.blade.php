@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex">
        <!-- Left Side - Image Section -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="absolute inset-0"
                style="background-image: url('{{ asset('assets/img/bg-login.jpg') }}'); background-size: cover; background-position: center;">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/30"></div>

            <div class="relative z-10 flex flex-col justify-start items-start p-12 text-white text-left max-w-lg">
                <!-- Logo Section -->
                <div class="flex items-center space-x-4 mb-10">
                    <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                        <img src="{{ asset('assets/img/logo_tutwuri.png') }}" alt="Logo Tutwuri"
                            class="w-10 h-10 object-contain" />
                    </div>
                    <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                        <img src="{{ asset('assets/img/logo_unm.png') }}" alt="Logo UNM"
                            class="w-10 h-10 object-contain" />
                    </div>
                    <div class="flex flex-col ml-2">
                        <h1 class="text-2xl font-bold text-white tracking-wide">Desa Ngebruk</h1>
                        <p class="text-sm text-white/90 font-medium">Panel Admin</p>
                    </div>
                </div>

                <!-- Main Text -->
                <div class="space-y-4">
                    <h2 class="text-4xl font-bold leading-tight text-white">
                        Kelola Website Desa dengan Mudah
                    </h2>
                    <p class="text-lg text-white/90 leading-relaxed font-light">
                        Mulai mengelola dan mengembangkan website Desa Ngebruk melalui panel admin yang modern dan user-friendly
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-8 lg:p-12 bg-white">
            <div class="max-w-md w-full space-y-6">
                <!-- Form Header -->
                <div class="text-left mb-6">
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-900 mb-2">
                        Masuk
                    </h2>
                    <p class="text-gray-600 text-sm">
                        Masuk ke akun Anda untuk melanjutkan
                    </p>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <form class="space-y-5" action="#" method="POST">
                        @csrf
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat Email
                            </label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-transparent transition duration-200 placeholder-gray-400 text-sm"
                                placeholder="Masukkan alamat email...">
                            <div id="email-error" class="hidden mt-1 text-sm text-red-600"></div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Kata Sandi
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="block w-full px-3 py-2.5 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-transparent transition duration-200 placeholder-gray-400 text-sm"
                                    placeholder="Masukkan kata sandi...">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button id="togglePassword" type="button"
                                        class="text-gray-400 hover:text-gray-600 transition duration-200 focus:outline-none">
                                        <i id="toggleIcon" class="fas fa-eye text-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="password-error" class="hidden mt-1 text-sm text-red-600"></div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center text-sm">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 text-[#1B3A6D] focus:ring-[#1B3A6D] border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-gray-700">
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button id="submitBtn" type="submit"
                            class="group relative w-full flex justify-center items-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#1B3A6D] hover:bg-[#1B3A6D]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B3A6D] transition duration-200 transform hover:scale-[1.01] active:scale-[0.99] shadow-md disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <svg id="loading-spinner" class="hidden animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span id="submit-text">Masuk</span>
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="mt-4 text-center space-y-3">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="font-medium text-[#1B3A6D] hover:text-[#1B3A6D]/80 transition duration-200">
                                Daftar sekarang
                            </a>
                        </p>
                        <p class="text-xs text-gray-500 border-t border-gray-100 pt-3">
                            Dengan masuk, Anda menyetujui 
                            <a href="#" class="text-[#1B3A6D] hover:underline font-medium">Kebijakan Privasi</a> dan 
                            <a href="#" class="text-[#1B3A6D] hover:underline font-medium">Ketentuan Penggunaan</a> kami.
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
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <script>
        $(document).ready(function() {
            // Toast notification function
            function showToast(message, type = 'info', duration = 5000) {
                const toastId = 'toast-' + Date.now();
                const iconMap = {
                    success: 'fas fa-check-circle text-green-500',
                    error: 'fas fa-exclamation-circle text-red-500',
                    warning: 'fas fa-exclamation-triangle text-yellow-500',
                    info: 'fas fa-info-circle text-[#1B3A6D]/80'
                };
                
                const bgMap = {
                    success: 'bg-green-50 border-green-200',
                    error: 'bg-red-50 border-red-200',
                    warning: 'bg-yellow-50 border-yellow-200',
                    info: 'bg-blue-50 border-blue-200'
                };

                const toast = $(`
                    <div id="${toastId}" class="transform translate-x-full opacity-0 transition-all duration-300 ease-out max-w-sm w-full ${bgMap[type]} border rounded-lg shadow-lg pointer-events-auto">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="${iconMap[type]}"></i>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">${message}</p>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <button onclick="removeToast('${toastId}')" class="inline-flex text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <i class="fas fa-times text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);

                $('#toast-container').append(toast);
                
                // Animate in
                setTimeout(() => {
                    $(`#${toastId}`).removeClass('translate-x-full opacity-0');
                }, 10);

                // Auto remove
                setTimeout(() => {
                    removeToast(toastId);
                }, duration);
            }

            // Remove toast function
            window.removeToast = function(toastId) {
                const toast = $(`#${toastId}`);
                toast.addClass('translate-x-full opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            };

            // Clear field errors
            function clearFieldErrors() {
                $('#email-error, #password-error').addClass('hidden').text('');
                $('#email, #password').removeClass('border-red-500').addClass('border-gray-300');
            }

            // Show field error
            function showFieldError(fieldId, message) {
                $(`#${fieldId}`).removeClass('border-gray-300').addClass('border-red-500');
                $(`#${fieldId}-error`).removeClass('hidden').text(message);
            }

            // Validate email format
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Set loading state
            function setLoadingState(loading) {
                const $button = $('#submitBtn');
                const $text = $('#submit-text');
                const $spinner = $('#loading-spinner');

                if (loading) {
                    $button.prop('disabled', true);
                    $text.text('Memproses...');
                    $spinner.removeClass('hidden');
                } else {
                    $button.prop('disabled', false);
                    $text.text('Masuk');
                    $spinner.addClass('hidden');
                }
            }

            // Input event listeners for real-time validation
            $('#email').on('input', function() {
                clearFieldErrors();
                const email = $(this).val().trim();
                
                if (email && !isValidEmail(email)) {
                    showFieldError('email', 'Format email tidak valid');
                }
            });

            $('#password').on('input', function() {
                clearFieldErrors();
                const password = $(this).val();
                
                if (password && password.length < 6) {
                    showFieldError('password', 'Kata sandi minimal 6 karakter');
                }
            });

            // Toggle password visibility
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

            $('#togglePassword').on('click', function() {
                togglePassword();
            });

            // Form submission
            $('form').on('submit', function(e) {
                e.preventDefault();
                clearFieldErrors();

                const email = $('#email').val().trim();
                const password = $('#password').val();
                let hasError = false;

                // Client-side validation
                if (!email) {
                    showFieldError('email', 'Email harus diisi');
                    hasError = true;
                } else if (!isValidEmail(email)) {
                    showFieldError('email', 'Format email tidak valid');
                    hasError = true;
                }

                if (!password) {
                    showFieldError('password', 'Kata sandi harus diisi');
                    hasError = true;
                } else if (password.length < 6) {
                    showFieldError('password', 'Kata sandi minimal 6 karakter');
                    hasError = true;
                }

                if (hasError) {
                    showToast('Mohon perbaiki kesalahan pada form', 'error');
                    return;
                }

                setLoadingState(true);

                $.ajax({
                    url: '/login-post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: 'POST',
                    data: {
                        email: email,
                        password: password,
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('Login berhasil! Mengalihkan...', 'success');
                            
                            // Smooth transition to dashboard
                            setTimeout(() => {
                                window.location.href = '/dashboard';
                            }, 1000);
                        } else {
                            setLoadingState(false);
                            showToast(response.message || 'Login gagal, silakan coba lagi', 'error');
                        }
                    },
                    error: function(jqXHR) {
                        setLoadingState(false);
                        
                        if (jqXHR.status === 422) {
                            // Validation errors
                            const errors = jqXHR.responseJSON?.errors || {};
                            
                            if (errors.email) {
                                showFieldError('email', errors.email[0]);
                            }
                            if (errors.password) {
                                showFieldError('password', errors.password[0]);
                            }
                            
                            showToast('Silakan perbaiki kesalahan pada form', 'error');
                        } else if (jqXHR.status === 401) {
                            showToast('Email atau kata sandi salah', 'error');
                        } else if (jqXHR.status === 429) {
                            showToast('Terlalu banyak percobaan, coba lagi nanti', 'warning');
                        } else {
                            const errorMessage = jqXHR.responseJSON?.message || 'Terjadi kesalahan, silakan coba lagi';
                            showToast(errorMessage, 'error');
                        }
                    }
                });
            });

            // Add subtle entrance animations
            setTimeout(() => {
                $('.min-h-screen').addClass('opacity-100');
            }, 100);
        });
    </script>
@endpush
