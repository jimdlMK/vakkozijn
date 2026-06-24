<?php
$post_type = get_field('loop_post_type') ?: 'project-categorieen';
$aantal    = (int) ( get_field('loop_aantal') ?: 8 );
$kolommen  = (int) ( get_field('loop_kolommen') ?: 4 );
$img_uri   = get_stylesheet_directory_uri() . '/dist/images';

// ─── Modus: project categorieën als kaarten ──────────────────────────────────
if ( $post_type === 'project-categorieen' ) {
    $terms = get_terms([
        'taxonomy'   => 'project-categorie',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ]);

    if ( is_wp_error( $terms ) ) {
        echo '<!-- mk-loop debug: WP_Error: ' . esc_html( $terms->get_error_message() ) . ' -->';
        return;
    }

    if ( empty( $terms ) ) {
        echo '<!-- mk-loop debug: get_terms() geeft lege array terug voor taxonomy "project-categorie" -->';
        return;
    }
    ?>
    <div class="mk-loop mk-loop--type-deuren-kozijnen">
        <div class="swiper mk-loop__swiper">
            <div class="swiper-wrapper mk-loop__grid" data-grid="<?php echo esc_attr( $kolommen ); ?>">
                <?php foreach ( $terms as $term ) :
                    $afbeelding = get_field( 'pc_afbeelding', 'project-categorie_' . $term->term_id );
                    $img_url    = $afbeelding ? $afbeelding['sizes']['mk-loop-afbeelding'] ?? $afbeelding['url'] : '';
                    $img_alt    = $afbeelding ? $afbeelding['alt'] : $term->name;
                    $link       = home_url( '/projecten/?categorie=' . $term->slug );
                ?>
                <div class="swiper-slide">
                    <a href="<?php echo esc_url( $link ); ?>" class="mk-loop__card">
                        <?php if ( $img_url ) : ?>
                        <div class="mk-loop__image">
                            <img src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php echo esc_attr( $img_alt ); ?>"
                                 loading="lazy">
                        </div>
                        <?php endif; ?>
                        <div class="mk-loop__content">
                            <h3 class="mk-loop__title"><?php echo esc_html( $term->name ); ?></h3>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return;
}

// ─── Modus: projecten posts ───────────────────────────────────────────────────
$posts = get_posts([
    'post_type'      => 'projecten',
    'posts_per_page' => $aantal,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

if ( ! $posts ) return;
?>

<div class="mk-loop mk-loop--type-projecten">
    <div class="swiper mk-loop__swiper">
        <div class="swiper-wrapper mk-loop__grid" data-grid="<?php echo esc_attr( $kolommen ); ?>">
            <?php foreach ( $posts as $post ) :
                $id      = $post->ID;
                $title   = get_the_title( $id );
                $img_id  = get_post_thumbnail_id( $id );
                $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'mk-loop-afbeelding' ) : '';
                $img_alt = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : $title;
                $link    = get_permalink( $id );
            ?>
            <div class="swiper-slide">
                <a href="<?php echo esc_url( $link ); ?>" class="mk-loop__card">
                    <?php if ( $img_url ) : ?>
                    <div class="mk-loop__image">
                        <img src="<?php echo esc_url( $img_url ); ?>"
                             alt="<?php echo esc_attr( $img_alt ); ?>"
                             loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="mk-loop__content">
                        <h3 class="mk-loop__title"><?php echo esc_html( $title ); ?></h3>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
