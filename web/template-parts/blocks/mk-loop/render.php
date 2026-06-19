<?php
$post_type = get_field('loop_post_type') ?: 'deuren-kozijnen';
$aantal    = (int) ( get_field('loop_aantal') ?: 8 );
$kolommen  = (int) ( get_field('loop_kolommen') ?: 4 );
$img_uri   = get_stylesheet_directory_uri() . '/dist/images';

$posts = get_posts([
    'post_type'      => $post_type,
    'posts_per_page' => $aantal,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if ( ! $posts ) return;
?>

<div class="mk-loop mk-loop--type-<?php echo esc_attr( $post_type ); ?>">
    <div class="swiper mk-loop__swiper">
        <div class="swiper-wrapper mk-loop__grid" data-grid="<?php echo esc_attr( $kolommen ); ?>">
            <?php foreach ( $posts as $post ) :
                $id      = $post->ID;
                $link    = get_permalink( $id );
                $title   = get_the_title( $id );
                $img_id  = get_post_thumbnail_id( $id );
                $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'mk-loop-afbeelding' ) : '';
                $img_alt = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : $title;
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
