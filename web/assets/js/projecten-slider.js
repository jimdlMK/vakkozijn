(function () {
    'use strict';

    function initProjectenSlider(section) {
        var swiperEl = section.querySelector('.mk-projecten-slider__swiper');
        if (!swiperEl) return;

        new Swiper(swiperEl, {
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 130,
            loop: true,
            speed: 500,
            navigation: {
                prevEl: section.querySelector('.mk-projecten-slider__prev'),
                nextEl: section.querySelector('.mk-projecten-slider__next'),
            },
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.mk-projecten-slider').forEach(initProjectenSlider);
    });
})();
