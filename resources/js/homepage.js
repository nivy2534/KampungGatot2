// Homepage interactive elements

document.addEventListener("DOMContentLoaded", function () {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Mobile menu functionality
    const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener("click", function () {
            mobileMenu.classList.toggle("hidden");
            mobileMenu.classList.toggle("flex");

            // Toggle hamburger icon
            const icon = this.querySelector("svg");
            if (mobileMenu.classList.contains("flex")) {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            } else {
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            }
        });
    }

    // Event filter functionality
    const filterButtons = document.querySelectorAll("#event .flex button");
    if (filterButtons.length > 0) {
        filterButtons.forEach((button) => {
            button.addEventListener("click", function () {
                // Remove active class from all buttons
                filterButtons.forEach((btn) => {
                    btn.classList.remove("bg-[#1B3A6D]", "text-white");
                    btn.classList.add(
                        "border",
                        "border-[#1B3A6D]",
                        "text-[#1B3A6D]"
                    );
                });

                // Add active class to clicked button
                this.classList.add("bg-[#1B3A6D]", "text-white");
                this.classList.remove(
                    "border",
                    "border-[#1B3A6D]",
                    "text-[#1B3A6D]"
                );

                // Here you would typically filter the events
                // For now, we'll just log the filter
                console.log("Filter:", this.textContent);
            });
        });
    }

    // Lazy loading for images
    const images = document.querySelectorAll('img[src*="placehold.co"]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;
                // Add fade-in effect
                img.style.opacity = "0";
                img.style.transition = "opacity 0.3s ease-in-out";

                setTimeout(() => {
                    img.style.opacity = "1";
                }, 100);

                observer.unobserve(img);
            }
        });
    });

    images.forEach((img) => imageObserver.observe(img));

    // Add scroll effect to header
    const header = document.querySelector("header");
    if (header) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 100) {
                header.classList.add("backdrop-blur-md", "bg-[#F5F5F5]/90");
                header.classList.remove("bg-[#F5F5F5]");
            } else {
                header.classList.remove("backdrop-blur-md", "bg-[#F5F5F5]/90");
                header.classList.add("bg-[#F5F5F5]");
            }
        });
    }

    // Add animation to cards on scroll
    const cards = document.querySelectorAll(".grid > div, .space-y-6 > div");
    const cardObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        },
        {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        }
    );

    cards.forEach((card) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(20px)";
        card.style.transition =
            "opacity 0.6s ease-out, transform 0.6s ease-out";
        cardObserver.observe(card);
    });
});
