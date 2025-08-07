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
                        <h1 class="text-2xl font-bold text-white tracking-wide">Kampung Gatot</h1>
                        <p class="text-sm text-white/90 font-medium">Panel Admin</p>
                    </div>
                </div>

                <!-- Main Text -->
                <div class="space-y-4">
                    <h2 class="text-4xl font-bold leading-tight text-white">
                        Bergabung dengan Sistem Kami
                    </h2>
                    <p class="text-lg text-white/90 leading-relaxed font-light">
                        Daftar sekarang untuk mendapatkan akses ke panel admin dan mulai mengelola website Kampung Gatot
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
                        Daftar
                    </h2>
                    <p class="text-gray-600 text-sm">
                        Buat akun baru untuk mengakses panel admin
                    </p>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <form class="space-y-5" action="#" method="POST">
                        @csrf
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Lengkap
                            </label>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B3A6D] focus:border-transparent transition duration-200 placeholder-gray-400 text-sm"
                                placeholder="Masukkan nama lengkap...">
                            <div id="name-error" class="hidden mt-1 text-sm text-red-600"></div>
                        </div>

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
                                <input id="password" name="password" type="password" autocomplete="new-password"
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
                            <div class="mt-1 text-xs text-gray-500">
                                Minimal 8 karakter, mengandung huruf dan angka
                            </div>
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="flex items-start text-sm">
                            <input id="agree" name="agree" type="checkbox"
                                class="h-4 w-4 mt-1 text-[#1B3A6D] focus:ring-[#1B3A6D] border-gray-300 rounded transition duration-200">
                            <label for="agree" class="ml-2 block text-gray-700 leading-5">
                                Saya setuju dengan
                                <a href="#" class="text-[#1B3A6D] hover:underline font-medium">Ketentuan Penggunaan</a> dan
                                <a href="#" class="text-[#1B3A6D] hover:underline font-medium">Kebijakan Privasi</a>
                            </label>
                        </div>
                        <div id="agree-error" class="hidden text-sm text-red-600"></div>

                        <!-- Submit Button -->
                        <button id="submitBtn" type="submit" disabled
                            class="group relative w-full flex justify-center items-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed transition duration-200 transform disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <svg id="loading-spinner" class="hidden animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span id="submit-text">Daftar</span>
                        </button>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-4 text-center space-y-3">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="font-medium text-[#1B3A6D] hover:text-[#1B3A6D]/80 transition duration-200">
                                Masuk sekarang
                            </a>
                        </p>
                        <p class="text-xs text-gray-500 border-t border-gray-100 pt-3">
                            Dengan mendaftar, Anda menyetujui
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

                setTimeout(() => {
                    $(`#${toastId}`).removeClass('translate-x-full opacity-0');
                }, 10);

                setTimeout(() => {
                    removeToast(toastId);
                }, duration);
            }

            window.removeToast = function(toastId) {
                const toast = $(`#${toastId}`);
                toast.addClass('translate-x-full opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            };

            // Clear field errors
            function clearFieldErrors() {
                $('#email-error, #password-error, #name-error, #agree-error').addClass('hidden').text('');
                $('#email, #password, #name').removeClass('border-red-500').addClass('border-gray-300');
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

            // Validate password strength
            function validatePassword(password) {
                const minLength = password.length >= 8;
                const hasLetter = /[a-zA-Z]/.test(password);
                const hasNumber = /\d/.test(password);

                return {
                    isValid: minLength && hasLetter && hasNumber,
                    minLength,
                    hasLetter,
                    hasNumber
                };
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
                    const isChecked = $('#agree').is(':checked');
                    $button.prop('disabled', !isChecked);
                    $text.text('Daftar');
                    $spinner.addClass('hidden');
                }
            }

            // Toggle button based on checkbox
            function toggleButton($checkbox) {
                const $button = $('#submitBtn');
                if ($checkbox.is(':checked')) {
                    $button.prop('disabled', false)
                        .removeClass('bg-gray-200 text-gray-400 cursor-not-allowed')
                        .addClass('bg-[#1B3A6D] hover:bg-[#1B3A6D]/90 text-white shadow-md transform hover:scale-[1.01] active:scale-[0.99]');
                } else {
                    $button.prop('disabled', true)
                        .removeClass('bg-[#1B3A6D] hover:bg-[#1B3A6D]/90 text-white shadow-md transform hover:scale-[1.01] active:scale-[0.99]')
                        .addClass('bg-gray-200 text-gray-400 cursor-not-allowed');
                }
            }

            // Real-time validation
            $('#name').on('input', function() {
                clearFieldErrors();
                const name = $(this).val().trim();

                if (name && name.length < 2) {
                    showFieldError('name', 'Nama minimal 2 karakter');
                }
            });

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
                const validation = validatePassword(password);

                if (password && !validation.isValid) {
                    let message = 'Kata sandi harus: ';
                    const requirements = [];

                    if (!validation.minLength) requirements.push('minimal 8 karakter');
                    if (!validation.hasLetter) requirements.push('mengandung huruf');
                    if (!validation.hasNumber) requirements.push('mengandung angka');

                    message += requirements.join(', ');
                    showFieldError('password', message);
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

            $('#agree').on('change', function() {
                toggleButton($(this));
                clearFieldErrors();
            });

            // Form submission
            $('form').on('submit', function(e) {
                e.preventDefault();
                clearFieldErrors();

                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val();
                const agree = $('#agree').is(':checked');
                let hasError = false;

                // Client-side validation
                if (!name) {
                    showFieldError('name', 'Nama harus diisi');
                    hasError = true;
                } else if (name.length < 2) {
                    showFieldError('name', 'Nama minimal 2 karakter');
                    hasError = true;
                }

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
                } else {
                    const validation = validatePassword(password);
                    if (!validation.isValid) {
                        let message = 'Kata sandi harus: ';
                        const requirements = [];

                        if (!validation.minLength) requirements.push('minimal 8 karakter');
                        if (!validation.hasLetter) requirements.push('mengandung huruf');
                        if (!validation.hasNumber) requirements.push('mengandung angka');

                        message += requirements.join(', ');
                        showFieldError('password', message);
                        hasError = true;
                    }
                }

                if (!agree) {
                    $('#agree-error').removeClass('hidden').text('Anda harus menyetujui ketentuan penggunaan');
                    hasError = true;
                }

                if (hasError) {
                    showToast('Mohon perbaiki kesalahan pada form', 'error');
                    return;
                }

                setLoadingState(true);

                $.ajax({
                    url: '/register',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: 'POST',
                    data: {
                        name: name,
                        email: email,
                        password: password,
                    },
                    success: function(response) {
                        if (response.success) {
                            showToast('Pendaftaran berhasil! Akun Anda akan diaktifkan setelah mendapat persetujuan dari administrator.', 'success');

                            // Show additional info about approval process
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Menunggu Persetujuan',
                                    html: `
                                        <div class="text-left">
                                            <p class="mb-3">Pendaftaran Anda telah berhasil disubmit!</p>
                                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-3">
                                                <p class="text-sm font-medium text-blue-800 mb-2">Langkah Selanjutnya:</p>
                                                <ul class="text-sm text-blue-700 space-y-1">
                                                    <li>• Administrator akan meninjau permintaan Anda</li>
                                                    <li>• Anda akan mendapat konfirmasi via email</li>
                                                    <li>• Setelah disetujui, Anda dapat login</li>
                                                </ul>
                                            </div>
                                            <p class="text-sm text-gray-600">Proses persetujuan biasanya memakan waktu 1-2 hari kerja.</p>
                                        </div>
                                    `,
                                    customClass: {
                                        confirmButton: 'bg-[#1B3A6D] hover:bg-[#152f5a] text-white px-6 py-2 rounded-lg font-medium'
                                    },
                                    buttonsStyling: false,
                                    confirmButtonText: 'Mengerti'
                                }).then(() => {
                                    window.location.href = '/login';
                                });
                            }, 2000);
                        } else {
                            setLoadingState(false);
                            showToast(response.message || 'Pendaftaran gagal, silakan coba lagi', 'error');
                        }
                    },
                    error: function(jqXHR) {
                        setLoadingState(false);

                        if (jqXHR.status === 422) {
                            const errors = jqXHR.responseJSON?.errors || {};

                            if (errors.name) {
                                showFieldError('name', errors.name[0]);
                            }
                            if (errors.email) {
                                showFieldError('email', errors.email[0]);
                            }
                            if (errors.password) {
                                showFieldError('password', errors.password[0]);
                            }

                            showToast('Silakan perbaiki kesalahan pada form', 'error');
                        } else if (jqXHR.status === 409) {
                            showToast('Email sudah terdaftar, silakan gunakan email lain', 'warning');
                        } else {
                            const errorMessage = jqXHR.responseJSON?.message || 'Terjadi kesalahan, silakan coba lagi';
                            showToast(errorMessage, 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
