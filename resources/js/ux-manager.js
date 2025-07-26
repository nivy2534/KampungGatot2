/**
 * Global UX JavaScript Library
 * Handles common UX patterns, animations, and state management
 */

class UXManager {
    constructor() {
        this.toastContainer = null;
        this.loadingOverlay = null;
        this.init();
    }

    init() {
        this.createToastContainer();
        this.setupGlobalEvents();
        this.initializeAnimations();
    }

    // Toast Notification System
    createToastContainer() {
        if (!document.getElementById("toast-container")) {
            const container = document.createElement("div");
            container.id = "toast-container";
            container.className = "fixed top-4 right-4 z-50 space-y-2";
            document.body.appendChild(container);
            this.toastContainer = container;
        }
    }

    showToast(message, type = "info", duration = 5000) {
        const toastId = "toast-" + Date.now();
        const iconMap = {
            success: "fas fa-check-circle text-green-500",
            error: "fas fa-exclamation-circle text-red-500",
            warning: "fas fa-exclamation-triangle text-yellow-500",
            info: "fas fa-info-circle text-blue-500",
        };

        const bgMap = {
            success: "bg-green-50 border-green-200",
            error: "bg-red-50 border-red-200",
            warning: "bg-yellow-50 border-yellow-200",
            info: "bg-blue-50 border-blue-200",
        };

        const toast = document.createElement("div");
        toast.id = toastId;
        toast.className = `transform translate-x-full opacity-0 transition-all duration-300 ease-out max-w-sm w-full ${bgMap[type]} border rounded-lg shadow-lg pointer-events-auto`;

        toast.innerHTML = `
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="${iconMap[type]}"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-900">${message}</p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button onclick="UX.removeToast('${toastId}')" class="inline-flex text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;

        this.toastContainer.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove("translate-x-full", "opacity-0");
        }, 10);

        // Auto remove
        setTimeout(() => {
            this.removeToast(toastId);
        }, duration);

        return toastId;
    }

    removeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add("translate-x-full", "opacity-0");
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }
    }

    // Loading Overlay System
    showLoading(message = "Memuat...") {
        if (this.loadingOverlay) {
            this.hideLoading();
        }

        this.loadingOverlay = document.createElement("div");
        this.loadingOverlay.id = "global-loading";
        this.loadingOverlay.className =
            "fixed inset-0 bg-white/80 backdrop-blur-sm z-50 flex items-center justify-center";

        this.loadingOverlay.innerHTML = `
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
                <p class="text-gray-600 text-sm">${message}</p>
            </div>
        `;

        document.body.appendChild(this.loadingOverlay);

        // Animate in
        setTimeout(() => {
            this.loadingOverlay.classList.add("opacity-100");
        }, 10);
    }

    hideLoading() {
        if (this.loadingOverlay) {
            this.loadingOverlay.classList.add("opacity-0");
            setTimeout(() => {
                if (this.loadingOverlay && this.loadingOverlay.parentNode) {
                    this.loadingOverlay.parentNode.removeChild(
                        this.loadingOverlay
                    );
                }
                this.loadingOverlay = null;
            }, 300);
        }
    }

    // Form Validation System
    validateForm(formElement, rules = {}) {
        let isValid = true;
        const errors = {};

        // Clear previous errors
        this.clearFormErrors(formElement);

        // Validate each field
        Object.keys(rules).forEach((fieldName) => {
            const field = formElement.querySelector(`[name="${fieldName}"]`);
            const rule = rules[fieldName];

            if (!field) return;

            const value = field.value.trim();
            let fieldErrors = [];

            // Required validation
            if (rule.required && !value) {
                fieldErrors.push(rule.required);
            }

            // Min length validation
            if (rule.minLength && value.length < rule.minLength.value) {
                fieldErrors.push(rule.minLength.message);
            }

            // Email validation
            if (rule.email && value && !this.isValidEmail(value)) {
                fieldErrors.push(rule.email);
            }

            // Custom validation
            if (rule.custom && value) {
                const customResult = rule.custom(value);
                if (customResult !== true) {
                    fieldErrors.push(customResult);
                }
            }

            if (fieldErrors.length > 0) {
                this.showFieldError(fieldName, fieldErrors[0]);
                errors[fieldName] = fieldErrors;
                isValid = false;
            }
        });

        return { isValid, errors };
    }

    showFieldError(fieldName, message) {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (!field) return;

        // Add error class to field
        field.classList.remove("border-gray-300");
        field.classList.add("border-red-500");

        // Create or update error message
        const errorId = `${fieldName}-error`;
        let errorEl = document.getElementById(errorId);

        if (!errorEl) {
            errorEl = document.createElement("div");
            errorEl.id = errorId;
            errorEl.className = "mt-1 text-sm text-red-600";
            field.parentNode.appendChild(errorEl);
        }

        errorEl.textContent = message;
        errorEl.classList.remove("hidden");
    }

    clearFormErrors(formElement) {
        // Clear field error states
        const fields = formElement.querySelectorAll("input, textarea, select");
        fields.forEach((field) => {
            field.classList.remove("border-red-500");
            field.classList.add("border-gray-300");
        });

        // Clear error messages
        const errorElements = formElement.querySelectorAll('[id$="-error"]');
        errorElements.forEach((el) => {
            el.classList.add("hidden");
            el.textContent = "";
        });
    }

    // Utility Functions
    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Button State Management
    setButtonLoading(button, loading = true, text = "Memproses...") {
        if (typeof button === "string") {
            button = document.querySelector(button);
        }

        if (!button) return;

        if (loading) {
            button.disabled = true;
            const originalText =
                button.dataset.originalText || button.textContent;
            button.dataset.originalText = originalText;

            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ${text}
            `;
        } else {
            button.disabled = false;
            const originalText = button.dataset.originalText || "Submit";
            button.innerHTML = originalText;
        }
    }

    // Animations
    initializeAnimations() {
        // Add entrance animations to elements with specific classes
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate-fade-in");
                }
            });
        });

        // Observe elements that should animate on scroll
        document.querySelectorAll(".animate-on-scroll").forEach((el) => {
            observer.observe(el);
        });
    }

    // Smooth Page Transitions
    setupGlobalEvents() {
        // Handle smooth page transitions
        document.addEventListener("click", (e) => {
            const link = e.target.closest("a[href]");
            if (link && this.shouldHandleTransition(link)) {
                e.preventDefault();
                this.smoothTransition(link.href);
            }
        });

        // Handle form submissions with better UX
        document.addEventListener("submit", (e) => {
            const form = e.target;
            if (form.dataset.uxEnhanced !== "false") {
                this.enhanceFormSubmission(form, e);
            }
        });
    }

    shouldHandleTransition(link) {
        const href = link.getAttribute("href");
        return (
            href &&
            href !== "#" &&
            href !== "javascript:void(0)" &&
            !href.startsWith("mailto:") &&
            !href.startsWith("tel:") &&
            !link.target &&
            !link.dataset.noTransition
        );
    }

    smoothTransition(url) {
        this.showLoading("Memuat halaman...");

        // Add small delay for better perceived performance
        setTimeout(() => {
            window.location.href = url;
        }, 500);
    }

    enhanceFormSubmission(form, event) {
        const submitButton = form.querySelector('[type="submit"]');
        if (submitButton) {
            this.setButtonLoading(submitButton, true);
        }
    }

    // Confirmation Dialogs
    confirm(options = {}) {
        return new Promise((resolve) => {
            const defaults = {
                title: "Konfirmasi",
                message: "Apakah Anda yakin?",
                confirmText: "Ya",
                cancelText: "Batal",
                type: "warning",
            };

            const config = { ...defaults, ...options };

            if (typeof Swal !== "undefined") {
                Swal.fire({
                    title: config.title,
                    text: config.message,
                    icon: config.type,
                    showCancelButton: true,
                    confirmButtonText: config.confirmText,
                    cancelButtonText: config.cancelText,
                    customClass: {
                        popup: "rounded-2xl",
                        confirmButton:
                            "bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary/90 transition-colors",
                        cancelButton:
                            "bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors ml-3",
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    resolve(result.isConfirmed);
                });
            } else {
                // Fallback to native confirm
                resolve(confirm(`${config.title}\n\n${config.message}`));
            }
        });
    }

    // Counter Animation
    animateCounter(element, target, duration = 2000) {
        if (typeof element === "string") {
            element = document.querySelector(element);
        }

        if (!element) return;

        const start = parseInt(element.textContent) || 0;
        const increment = (target - start) / (duration / 16);
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString();
        }, 16);
    }

    // Debounce utility
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Auto-resize textareas
    autoResizeTextarea(textarea) {
        if (typeof textarea === "string") {
            textarea = document.querySelector(textarea);
        }

        if (!textarea) return;

        textarea.style.height = "auto";
        textarea.style.height = textarea.scrollHeight + "px";
    }
}

// Initialize global UX manager
const UX = new UXManager();

// Make it globally available
window.UX = UX;

// Add CSS animations
const style = document.createElement("style");
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }
    
    .btn-loading {
        opacity: 0.7;
        pointer-events: none;
    }
    
    .transition-all-smooth {
        transition: all 0.3s ease-in-out;
    }
`;
document.head.appendChild(style);
