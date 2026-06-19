(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var el = document.querySelector('.mk-team__swiper');
        if (!el) return;

        new Swiper(el, {
            slidesPerView: 1,
            spaceBetween: 24,
            // We zetten de basis (desktop/default) op false/uit:
            loop: false, 
            autoplay: false,
            pagination: {
                el: '.mk-team__pagination',
                clickable: true,
            },
            breakpoints: {
                // Tot en met 640px (mobiel) zetten we alles AAN
                0: {
                    enabled: true,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                },
                // Vanaf 641px (desktop) zetten we Swiper UIT
                641: {
                    enabled: false,
                    loop: false,
                },
            },
        });
    });
})();