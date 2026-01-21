document.addEventListener('DOMContentLoaded', () => {
    const carouselContainer = document.querySelector('.carousel-container');
    const carousel = document.querySelector('.carousel');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');

    if (carousel && carouselContainer && prevButton && nextButton) {
        const cardWidth = 368 + 32; // card width (18rem = 288px) + gap (2rem = 32px)
        
        console.log('Carousel container found:', carouselContainer);
        console.log('Carousel found:', carousel);
        console.log('Container scrollWidth:', carouselContainer.scrollWidth);
        console.log('Container clientWidth:', carouselContainer.clientWidth);
        console.log('Buttons found:', prevButton, nextButton);
        
        nextButton.addEventListener('click', () => {
            console.log('Next button clicked, scrolling by:', cardWidth);
            carouselContainer.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
            setTimeout(updateButtonStates, 300);
        });

        prevButton.addEventListener('click', () => {
            console.log('Prev button clicked, scrolling by:', -cardWidth);
            carouselContainer.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
            setTimeout(updateButtonStates, 300);
        });

        carouselContainer.addEventListener('scroll', () => {
            updateButtonStates();
        });

        function updateButtonStates() {
            const maxScrollLeft = carouselContainer.scrollWidth - carouselContainer.clientWidth;
            const isAtEnd = carouselContainer.scrollLeft >= maxScrollLeft - 10;
            const isAtStart = carouselContainer.scrollLeft <= 10;

            console.log('Scroll position:', carouselContainer.scrollLeft, 'Max:', maxScrollLeft, 'AtStart:', isAtStart, 'AtEnd:', isAtEnd);

            // Disable/Enable buttons based on scroll position
            nextButton.disabled = isAtEnd;
            prevButton.disabled = isAtStart;
        }

        updateButtonStates();
    } else {
        console.log('Carousel elements not found:', { carousel, carouselContainer, prevButton, nextButton });
    }
});
