(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var items = document.querySelectorAll('.mk-usp-rotator__item');
        if (items.length < 2) return;

        var current = 0;

        setInterval(function () {
            items[current].classList.remove('is-active');
            items[current].classList.add('is-leaving');

            current = (current + 1) % items.length;
            items[current].classList.add('is-active');

            var leaving = items[(current - 1 + items.length) % items.length];
            setTimeout(function () {
                leaving.classList.remove('is-leaving');
            }, 400);
        }, 5000);
    });
})();
