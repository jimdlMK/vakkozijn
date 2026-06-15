<?php

function mk_enqueue_fonts() {
    // Termina via Adobe Fonts (Typekit)
    wp_enqueue_style(
        'mk-font-termina',
        'https://use.typekit.net/num1qrx.css',
        array(),
        null
    );

    // Inter via Google Fonts
    wp_enqueue_style(
        'mk-font-inter',
        'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'mk_enqueue_fonts' );

function mk_enqueue_scripts() {
    wp_enqueue_script(
        'mk-projecten-slider',
        get_stylesheet_directory_uri() . '/dist/js/projecten-slider.js',
        ['swiper-js'],
        null,
        true
    );
    wp_enqueue_script(
        'mk-projecten-gallery',
        get_stylesheet_directory_uri() . '/dist/js/projecten-gallery.js',
        ['swiper-js', 'fancybox-js'],
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'mk_enqueue_scripts' );

?>
