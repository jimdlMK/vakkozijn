<?php
$per_page = (int) ( get_field('pa_per_pagina') ?: 4 );
$paged    = max( 1, get_query_var('paged') ?: get_query_var('page') );
$img_uri  = get_stylesheet_directory_uri() . '/dist/images';

$query = new WP_Query([
    'post_type'      => 'projecten',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

if ( ! $query->have_posts() ) return;
?>

<section class="mk-projecten-grid">
    <div class="mk-projecten-grid__inner">
        <?php while ( $query->have_posts() ) : $query->the_post();
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
        <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php if ( $query->max_num_pages > 1 ) : ?>
    <nav class="mk-projecten-grid__pagination" aria-label="Paginering">
        <?php
        echo paginate_links([
            'base'      => add_query_arg( 'paged', '%#%', get_permalink() ),
            'format'    => '',
            'total'     => $query->max_num_pages,
            'current'   => $paged,
            'type'      => 'list',
            'prev_text' => '',
            'next_text' => '<img src="' . esc_url( $img_uri . '/Icon feather-arrow-right.svg' ) . '" alt="Volgende">',
            'mid_size'  => 2,
        ]);
        ?>
    </nav>
    <?php endif; ?>
</section>
