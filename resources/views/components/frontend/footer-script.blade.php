<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"
    integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- Toaster     --}}
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{{ asset('js/frontend/site.js') }}"> </script>


@stack('frontendscripts')    

<script>
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 2,
            },
        },
    });
</script>
<script>
    // GSAP Animations for floating decorations

    // Arrow: rotate slightly back and forth
    gsap.to(".dec-arrow", {
        rotation: 10,
        duration: 2,
        yoyo: true,
        repeat: -1,
        ease: "power1.inOut"
    });

    // Donut: bounce up and down
    gsap.to(".dec-donut", {
        y: -10,
        duration: 1.5,
        yoyo: true,
        repeat: -1,
        ease: "power1.inOut"
    });

    // Star: scale in and out like pulsing
    gsap.to(".dec-star", {
        scale: 1.2,
        duration: 1,
        yoyo: true,
        repeat: -1,
        ease: "power1.inOut"
    });

    // Stamp/Lock: float up and down slowly
    gsap.to(".dec-stamp-lock", {
        y: -15,
        rotation: 5,
        duration: 3,
        yoyo: true,
        repeat: -1,
        ease: "power1.inOut"
    });

    // Squiggle: rotate and move slightly
    gsap.to(".dec-squiggle", {
        rotation: 15,
        x: 15,
        duration: 2.5,
        yoyo: true,
        repeat: -1,
        ease: "power1.inOut"
    });

    // Dot animations
    gsap.to(".dec-dot-small-blue", {
        x: 10,
        duration: 2,
        yoyo: true,
        repeat: -1,
        ease: "power1.inOut"
    });

    gsap.to(".dec-dot-big-pink", {
        scale: 1.3,
        duration: 1.5,
        yoyo: true,
        repeat: -1,
        ease: "sine.inOut"
    });
</script>
