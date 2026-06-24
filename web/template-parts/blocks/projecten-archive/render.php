<?php
$per_page = (int) ( get_field('pa_per_pagina') ?: 12 );
$paged    = max( 1, get_query_var('paged') ?: get_query_var('page') );
$img_uri  = get_stylesheet_directory_uri() . '/dist/images';

$terms = get_terms([
    'taxonomy'   => 'project-categorie',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

$query = new WP_Query([
    'post_type'      => 'projecten',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

if ( ! $query->have_posts() && empty( $terms ) ) return;
?>

<section class="mk-projecten-grid" data-per-page="<?php echo esc_attr( $per_page ); ?>">

    <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
    <div class="mk-projecten-grid__filter">
        <div class="mk-projecten-filter" data-filter>
            <button class="mk-projecten-filter__trigger" aria-expanded="false" aria-haspopup="listbox" type="button">
                <span class="mk-projecten-filter__label">Alle projecten</span>
                <span class="mk-projecten-filter__arrow" aria-hidden="true">
                    <img src="<?php echo esc_url( $img_uri . '/Icon feather-arrow-right.svg' ); ?>" alt="">
                </span>
            </button>
            <ul class="mk-projecten-filter__list" role="listbox">
                <li class="mk-projecten-filter__option mk-projecten-filter__option--active" data-value="" role="option" aria-selected="true">Alle projecten</li>
                <?php foreach ( $terms as $term ) : ?>
                <li class="mk-projecten-filter__option" data-value="<?php echo esc_attr( $term->slug ); ?>" role="option" aria-selected="false">
                    <?php echo esc_html( $term->name ); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

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
            'base'      => trailingslashit( get_permalink() ) . '%_%',
            'format'    => 'page/%#%/',
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
