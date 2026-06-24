(function () {
    'use strict';

    function initProjectGallery(section) {
        var swiperEl = section.querySelector('.mk-project-gallery__swiper');
        if (!swiperEl) return;

        new Swiper(swiperEl, {
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 15,
            loop: true,
            speed: 500,
            navigation: {
                prevEl: section.querySelector('.mk-project-gallery__prev'),
                nextEl: section.querySelector('.mk-project-gallery__next'),
            },
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.mk-project-gallery').forEach(initProjectGallery);

        if (typeof GLightbox !== 'undefined') {
            GLightbox({ selector: '.glightbox' });
        }
    });
})();
