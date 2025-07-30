<!-- Social Media Popup -->
<div id="socialMediaPopup" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm hidden">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm relative transform transition-all duration-300 scale-95 opacity-0" id="popupContent">
        <!-- Close Button -->
        <button onclick="closeSocialPopup()" class="absolute top-4 right-4 w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors z-10">
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="p-6 text-center">
            <!-- Header -->
            <h2 class="text-xl font-bold text-gray-900 mb-3">Ikuti Sosial Media Kami</h2>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                Kunjungi media sosial kami untuk info terbaru, cerita inspiratif, dan konten menarik lainnya dari Kampung Gatot.
            </p>

            <!-- Social Media Icons -->
            <div class="flex items-center justify-center gap-4 mb-4">
                <!-- TikTok -->
                <a href="{{ config('social.tiktok') }}" target="_blank"
                   class="w-20 h-20 border border-gray-300 rounded-xl flex items-center justify-center bg-white hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none">
                        <path d="M19.321 5.562a5.124 5.124 0 0 1-.443-.258 6.228 6.228 0 0 1-1.137-.966c-.849-.966-1.347-2.264-1.347-3.657V0H13.01v16.966c0 .414-.047.822-.138 1.215a3.738 3.738 0 0 1-.277.959c-.464 1.036-1.49 1.759-2.715 1.759-1.65 0-2.988-1.338-2.988-2.988s1.338-2.988 2.988-2.988c.31 0 .608.047.89.134V11.8a6.25 6.25 0 0 0-.89-.065c-3.394 0-6.147 2.753-6.147 6.147s2.753 6.147 6.147 6.147 6.147-2.753 6.147-6.147V7.819a9.072 9.072 0 0 0 5.158 1.598v-3.18a5.195 5.195 0 0 1-1.863-.675z" fill="#000"/>
                    </svg>
                </a>

                <!-- YouTube -->
                <a href="{{ config('social.youtube') }}" target="_blank"
                   class="w-20 h-20 border border-gray-300 rounded-xl flex items-center justify-center bg-white hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="{{ config('social.instagram') }}" target="_blank"
                   class="w-20 h-20 border border-gray-300 rounded-xl flex items-center justify-center bg-white hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="currentColor" stroke-width="2"/>
                        <path d="m16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" stroke="currentColor" stroke-width="2"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>

            <p class="text-xs text-gray-400">Terima kasih telah mengunjungi website Kampung Gatot</p>
        </div>
    </div>
</div>

<script>
let socialPopupShown = false;

function showSocialPopup() {
    // Check if popup has been shown in this session
    if (sessionStorage.getItem('socialPopupShown')) {
        return;
    }

    // Don't show on admin dashboard pages
    if (window.location.pathname.includes('/dashboard')) {
        return;
    }

    const popup = document.getElementById('socialMediaPopup');
    const content = document.getElementById('popupContent');

    if (popup && content) {
        popup.classList.remove('hidden');

        // Animate popup appearance
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 50);

        // Mark as shown for this session
        sessionStorage.setItem('socialPopupShown', 'true');
        socialPopupShown = true;

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }
}

function closeSocialPopup() {
    const popup = document.getElementById('socialMediaPopup');
    const content = document.getElementById('popupContent');

    if (popup && content) {
        // Animate popup disappearance
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            popup.classList.add('hidden');
            // Restore body scroll
            document.body.style.overflow = '';
        }, 300);
    }
}

// Close popup when clicking outside
document.addEventListener('click', function(e) {
    const popup = document.getElementById('socialMediaPopup');
    const content = document.getElementById('popupContent');

    if (popup && content && e.target === popup) {
        closeSocialPopup();
    }
});

// Close popup with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSocialPopup();
    }
});

// Show popup after page load (delay for better UX)
document.addEventListener('DOMContentLoaded', function() {
    @if(config('social.show_popup'))
        setTimeout(showSocialPopup, {{ config('social.popup_delay') }}); // Show after configured delay
    @endif
});
</script>

<style>
/* Popup animations */
#socialMediaPopup {
    backdrop-filter: blur(8px);
}

#popupContent {
    animation-duration: 0.3s;
    animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Social media button hover effects */
#socialMediaPopup a:hover {
    transform: translateY(-1px);
}

/* Responsive adjustments */
@media (max-width: 480px) {
    #popupContent {
        margin: 1rem;
        max-width: calc(100vw - 2rem);
    }
}
</style>
