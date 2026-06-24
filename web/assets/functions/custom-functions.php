<?php

// ─── AJAX: projecten filteren op categorie ────────────────────────────────────
function mk_ajax_filter_projecten() {
    $slug     = isset( $_POST['categorie'] ) ? sanitize_text_field( $_POST['categorie'] ) : '';
    $per_page = isset( $_POST['per_page'] )  ? (int) $_POST['per_page']                  : 12;
    $img_uri  = get_stylesheet_directory_uri() . '/dist/images';

    $args = [
        'post_type'      => 'projecten',
        'posts_per_page' => $slug ? -1 : $per_page,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    if ( $slug ) {
        $args['tax_query'] = [[
            'taxonomy' => 'project-categorie',
            'field'    => 'slug',
            'terms'    => $slug,
        ]];
    }

    $query = new WP_Query( $args );

    if ( ! $query->have_posts() ) {
        echo '<p class="mk-projecten-grid__empty">Geen projecten gevonden.</p>';
        wp_die();
    }

    while ( $query->have_posts() ) : $query->the_post();
        $link    = get_permalink();
        $title   = get_the_title();
        $img_id  = get_post_thumbnail_id();
        $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
        $img_alt = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : $title;
        ?>
        <a href="<?php echo esc_url( $link ); ?>" class="mk-projecten-grid__card">
            <?php if ( $img_url ) : ?>
            <div class="mk-projecten-grid__image">
                <img src="<?php echo esc_url( $img_url ); ?>"
                     alt="<?php echo esc_attr( $img_alt ); ?>"
                     loading="lazy">
            </div>
            <?php endif; ?>
            <div class="mk-projecten-grid__content">
                <h3 class="mk-projecten-grid__title"><?php echo esc_html( $title ); ?></h3>
            </div>
        </a>
        <?php
    endwhile;
    wp_reset_postdata();
    wp_die();
}
add_action( 'wp_ajax_mk_filter_projecten',        'mk_ajax_filter_projecten' );
add_action( 'wp_ajax_nopriv_mk_filter_projecten', 'mk_ajax_filter_projecten' );

// ─── AJAX URL beschikbaar maken in JS ─────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function() {
    wp_localize_script( 'mk-main-script', 'mkAjax', [
        'url'   => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'mk_filter_projecten' ),
    ]);
});

// ─── Breadcrumbs ──────────────────────────────────────────────────────────────
function mk_breadcrumbs() {
    $sep = '<span class="mk-breadcrumbs-sep"> > </span>';

    echo '<nav class="mk-breadcrumbs" aria-label="Kruimelpad">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">Home</a>';

    if ( is_singular( 'projecten' ) ) {
        echo $sep;
        echo '<a href="' . esc_url( home_url( '/projecten/' ) ) . '">Projecten</a>';
        echo $sep;
        echo '<strong>' . esc_html( get_the_title() ) . '</strong>';
    } elseif ( ! is_front_page() ) {
        $ancestors = is_page() ? array_reverse( get_post_ancestors( get_the_ID() ) ) : [];
        foreach ( $ancestors as $ancestor ) {
            echo $sep;
            echo '<a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a>';
        }
        echo $sep;
        echo '<strong>' . esc_html( get_the_title() ) . '</strong>';
    }

    echo '</nav>';
}
