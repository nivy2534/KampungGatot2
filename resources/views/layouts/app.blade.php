<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kampung Gatot')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- SweetAlert2 for enhanced modals -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Page-specific styles -->
    @stack('styles')

    @stack('scripts')

    <!-- Page loading indicator -->
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #0f203c, #1B3A6D, #0f203c);
            background-size: 200% 100%;
            animation: loading 2s ease-in-out infinite;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .page-loading.active {
            opacity: 1;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .smooth-transition {
            transition: all 0.3s ease-in-out;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-gray-50 smooth-transition">
    <!-- Page loading indicator -->
    <div id="page-loading-bar" class="page-loading"></div>

    <!-- Main content with fade-in animation -->
    <div id="main-content" class="fade-in">
        @yield('content')
    </div>

    <!-- Scripts -->
    @stack('prepend-script')

    <!-- UX Manager -->
    <script src="{{ asset('resources/js/ux-manager.js') }}"></script>

    <!-- Global JavaScript Setup -->
    <script>
        // Configure AJAX globally
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            beforeSend: function() {
                // Show loading indicator for AJAX requests
                $('#page-loading-bar').addClass('active');
            },
            complete: function() {
                // Hide loading indicator
                setTimeout(() => {
                    $('#page-loading-bar').removeClass('active');
                }, 300);
            },
            error: function(xhr, status, error) {
                // Global error handler
                let message = 'Terjadi kesalahan. Silakan coba lagi.';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                } else if (xhr.status === 500) {
                    message = 'Terjadi kesalahan server. Silakan coba lagi.';
                } else if (xhr.status === 404) {
                    message = 'Halaman atau data tidak ditemukan.';
                } else if (xhr.status === 403) {
                    message = 'Anda tidak memiliki akses untuk melakukan tindakan ini.';
                }

                UX.showToast(message, 'error');
            }
        });

        // Enhanced form submission handling
        $(document).on('submit', 'form[data-ajax="true"]', function(e) {
            e.preventDefault();

            const form = $(this);
            const submitBtn = form.find('[type="submit"]');
            const formData = new FormData(this);

            // Show loading state
            UX.setButtonLoading(submitBtn[0], true);

            $.ajax({
                url: form.attr('action') || window.location.href,
                method: form.attr('method') || 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        UX.showToast(response.message || 'Berhasil!', 'success');

                        // Handle redirects
                        if (response.redirect) {
                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 1000);
                        }

                        // Reset form if needed
                        if (response.reset_form) {
                            form[0].reset();
                        }
                    } else {
                        UX.showToast(response.message || 'Terjadi kesalahan', 'error');
                    }
                },
                error: function(xhr) {
                    // Handle validation errors
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(field => {
                            UX.showFieldError(field, errors[field][0]);
                        });
                        UX.showToast('Silakan periksa form dan coba lagi', 'warning');
                    }
                },
                complete: function() {
                    UX.setButtonLoading(submitBtn[0], false);
                }
            });
        });

        // Auto-resize textareas
        $(document).on('input', 'textarea[data-auto-resize]', function() {
            UX.autoResizeTextarea(this);
        });

        // Smooth scrolling for anchor links
        $(document).on('click', 'a[href^="#"]', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 600);
            }
        });

        // Back to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        // Page visibility change handling
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'visible') {
                // Page became visible again
                UX.showToast('Selamat datang kembali!', 'info', 2000);
            }
        });

        // Initialize page
        $(document).ready(function() {
            // Add smooth transitions to elements
            $('.card, .btn, .form-control').addClass('smooth-transition');

            // Initialize counters if present
            $('.counter').each(function() {
                const target = parseInt($(this).data('target')) || 0;
                UX.animateCounter(this, target);
            });

            // Auto-focus first input on forms
            $('form .form-control:first').focus();
        });
    </script>

    @stack('addon-script')

    <!-- Back to top button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-primary text-white p-3 rounded-full shadow-lg hover:bg-primary/90 transition-all duration-300 opacity-0 invisible" onclick="$('html, body').animate({scrollTop: 0}, 600)">
        <i class="fas fa-arrow-up"></i>
    </button>
</body>

</html>
