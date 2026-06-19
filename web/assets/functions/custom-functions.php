<?php

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
