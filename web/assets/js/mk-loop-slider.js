document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper === 'undefined') return;

    var containers = document.querySelectorAll('.mk-loop--type-deuren-kozijnen .mk-loop__swiper');
    if (!containers.length) return;

    var swipers = [];

    function initSwipers() {
        containers.forEach(function (el, i) {
            if (window.innerWidth <= 980) {
                if (!swipers[i]) {
                    swipers[i] = new Swiper(el, {
                        slidesPerView: 1.2,
                        spaceBetween: 16,
                        grabCursor: true,
                        autoplay: {
                            delay: 3500,
                            disableOnInteraction: false,
                        },
                    });
                }
            } else {
                if (swipers[i]) {
                    swipers[i].destroy(true, true);
                    swipers[i] = null;
                }
            }
        });
    }

    initSwipers();
    window.addEventListener('resize', initSwipers);
});
