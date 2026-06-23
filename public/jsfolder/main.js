
        // Optional: Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            const carousel = bootstrap.Carousel.getInstance(document.getElementById('imageCarousel'));
            if (e.key === 'ArrowLeft') {
                carousel.prev();
            } else if (e.key === 'ArrowRight') {
                carousel.next();
            }
        });

        // Optional: Pause carousel on hover
        const carouselElement = document.getElementById('imageCarousel');
        const carousel = new bootstrap.Carousel(carouselElement, {
            interval: 5000,
            wrap: true
        });

        carouselElement.addEventListener('mouseenter', () => {
            carousel.pause();
        });

        carouselElement.addEventListener('mouseleave', () => {
            carousel.cycle();
        });
