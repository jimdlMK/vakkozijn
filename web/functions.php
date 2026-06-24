<?php
    require get_stylesheet_directory() . '/assets/functions/theme-setup.php';
    require get_stylesheet_directory() . '/assets/functions/enqueue-scripts.php';
    require get_stylesheet_directory() . '/assets/functions/custom-functions.php';
    require get_stylesheet_directory() . '/assets/functions/blogs-registrations.php';
    require get_stylesheet_directory() . '/assets/functions/custom-post-types.php';
    require get_stylesheet_directory() . '/assets/functions/nav-walker.php';
    add_theme_support('align-wide');

    // Maakt /projecten/page/2/ werkend voor de projecten-page met custom WP_Query
    add_action('init', function() {
        add_rewrite_rule(
            '^projecten/page/([0-9]+)/?$',
            'index.php?pagename=projecten&paged=$matches[1]',
            'top'
        );
    }, 20);


    add_action( 'after_setup_theme', 'mk_custom_image_sizes' );
function mk_custom_image_sizes() {
    // Voor het Loop blok (4:3 verhouding, bijv. 660x495 voor retina scherpte)
    add_image_size( 'mk-loop-afbeelding', 660, 495, true ); 

    // Voor het Team blok (55:74 verhouding, bijv. 440x592 voor retina scherpte)
    add_image_size( 'mk-team-portret', 440, 592, true ); 
}
    
?>