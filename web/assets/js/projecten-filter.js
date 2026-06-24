(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var section  = document.querySelector('.mk-projecten-grid');
        var filter   = document.querySelector('[data-filter]');
        if (!section || !filter) return;

        var trigger    = filter.querySelector('.mk-projecten-filter__trigger');
        var label      = filter.querySelector('.mk-projecten-filter__label');
        var list       = filter.querySelector('.mk-projecten-filter__list');
        var options    = filter.querySelectorAll('.mk-projecten-filter__option');
        var grid       = section.querySelector('.mk-projecten-grid__inner');
        var pagination = section.querySelector('.mk-projecten-grid__pagination');
        var perPage    = section.dataset.perPage || 12;
        var current    = '';

        // ─── URL parameter bij pageload ──────────────────────────────────────
        var urlParams   = new URLSearchParams(window.location.search);
        var initFilter  = urlParams.get('categorie') || '';

        // ─── Dropdown open/dicht ─────────────────────────────────────────────
        function openDropdown() {
            filter.classList.add('is-open');
            trigger.setAttribute('aria-expanded', 'true');
        }

        function closeDropdown() {
            filter.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
        }

        trigger.addEventListener('click', function () {
            filter.classList.contains('is-open') ? closeDropdown() : openDropdown();
        });

        document.addEventListener('click', function (e) {
            if (!filter.contains(e.target)) closeDropdown();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeDropdown();
        });

        // ─── Optie selecteren ────────────────────────────────────────────────
        options.forEach(function (option) {
            option.addEventListener('click', function () {
                var value = this.dataset.value;
                if (value === current) { closeDropdown(); return; }

                // Actieve staat bijwerken
                options.forEach(function (o) {
                    o.classList.remove('mk-projecten-filter__option--active');
                    o.setAttribute('aria-selected', 'false');
                });
                this.classList.add('mk-projecten-filter__option--active');
                this.setAttribute('aria-selected', 'true');
                label.textContent = this.textContent.trim();
                current = value;

                closeDropdown();
                fetchProjecten(value);
            });
        });

        // ─── Activeer filter uit URL bij pageload ────────────────────────────
        if ( initFilter ) {
            options.forEach(function (o) {
                if ( o.dataset.value === initFilter ) {
                    o.classList.add('mk-projecten-filter__option--active');
                    o.setAttribute('aria-selected', 'true');
                    label.textContent = o.textContent.trim();
                } else {
                    o.classList.remove('mk-projecten-filter__option--active');
                    o.setAttribute('aria-selected', 'false');
                }
            });
            current = initFilter;
            fetchProjecten(initFilter);
        }

        // ─── AJAX fetch ──────────────────────────────────────────────────────
        function fetchProjecten(categorie) {
            section.classList.add('mk-projecten-grid--loading');

            var data = new FormData();
            data.append('action',    'mk_filter_projecten');
            data.append('nonce',     mkAjax.nonce);
            data.append('categorie', categorie);
            data.append('per_page',  perPage);

            fetch(mkAjax.url, { method: 'POST', body: data })
                .then(function (res) {
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    return res.text();
                })
                .then(function (html) {
                    grid.innerHTML = html;
                    if (pagination) {
                        pagination.style.display = categorie ? 'none' : '';
                    }
                    section.classList.remove('mk-projecten-grid--loading');
                })
                .catch(function (err) {
                    console.error('mk-filter fout:', err);
                    section.classList.remove('mk-projecten-grid--loading');
                });
        }
    });
})();
