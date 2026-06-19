<?php

function mk_enqueue_fonts() {
    wp_enqueue_style(
        'mk-font-termina',
        'https://use.typekit.net/num1qrx.css',
        array(),
        null
    );
    wp_enqueue_style(
        'mk-font-inter',
        'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'mk_enqueue_fonts' );

function mk_enqueue_scripts() {
    // Swiper laden zodat scripts.min.js (loop-slider, projecten-slider, gallery) Swiper kan gebruiken
    wp_enqueue_script( 'swiper-js' );

    // GLightbox voor lightbox op project galerij
    wp_enqueue_style( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3/dist/css/glightbox.min.css', [], '3' );
    wp_enqueue_script( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3/dist/js/glightbox.min.js', [], '3', true );
}
add_action( 'wp_enqueue_scripts', 'mk_enqueue_scripts' );



