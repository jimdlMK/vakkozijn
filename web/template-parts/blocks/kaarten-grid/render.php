<?php
$kolommen = get_field('kg_kolommen') ?: '3';

$posts = get_posts([
    'post_type'      => 'deuren-kozijnen',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if ( empty( $posts ) ) return;
?>

<section class="mk-kaarten-grid mk-kaarten-grid--cols-<?php echo esc_attr( $kolommen ); ?>">
    <div class="mk-kaarten-grid__inner">
        <?php foreach ( $posts as $post ) :
            $id    = $post->ID;
            $titel = get_the_title( $id );
            $link  = get_field( 'deuren_link', $id );
            $url    = is_array( $link ) ? $link['url']              : $link;
            $target = is_array( $link ) ? ( $link['target'] ?: '_blank' ) : '_blank';
            $img_id = get_post_thumbnail_id( $id );

            if ( ! $url || ! $img_id ) continue;
        ?>
        <a href="<?php echo esc_url( $url ); ?>"
           class="mk-kaarten-grid__card"
           target="<?php echo esc_attr( $target ); ?>"
           rel="noopener">

            <div class="mk-kaarten-grid__image">
                <?php echo wp_get_attachment_image( $img_id, 'large', false, [
                    'alt' => esc_attr( $titel ),
                ] ); ?>
            </div>

            <div class="mk-kaarten-grid__content">
                <h3 class="mk-kaarten-grid__title"><?php echo esc_html( $titel ); ?></h3>
            </div>

        </a>
        <?php endforeach; ?>
    </div>
</section>
