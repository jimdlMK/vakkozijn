<?php
$aantal   = (int) ( get_field('ps_aantal') ?: 6 );
$titel    = get_field('ps_titel') ?: 'Recente projecten';
$img_uri  = get_stylesheet_directory_uri() . '/dist/images';



$projecten = get_posts([
    'post_type'      => 'projecten',
    'posts_per_page' => $aantal,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

if ( ! $projecten ) return;
?>

<section class="mk-projecten-slider">

    <div class="mk-projecten-slider__header">
        <h2 class="mk-projecten-slider__heading"><?php echo esc_html($titel); ?></h2>
        <a href="/projecten" class="mk-btn mk-projecten-slider__btn">
            <span class="mk-btn__label">Bekijk alle projecten</span>
            <span class="mk-btn__arrow-box">
                <img src="<?php echo esc_url($img_uri . '/Icon feather-arrow-right.svg'); ?>" alt="">
            </span>
        </a>
    </div>

    <div class="mk-projecten-slider__area">

        <div class="swiper mk-projecten-slider__swiper">
            <div class="swiper-wrapper">
                <?php foreach ($projecten as $project) :
                    $id       = $project->ID;
                    $link     = get_permalink($id);
                    $title    = get_the_title($id);
                    $img_id   = get_post_thumbnail_id($id);
                    $img_url  = $img_id ? wp_get_attachment_image_url($img_id, 'large') : '';
                    $img_alt  = $img_id ? get_post_meta($img_id, '_wp_attachment_image_alt', true) : $title;
                    $terms    = get_the_terms($id, 'project-categorie');
                ?>
                <div class="swiper-slide mk-projecten-slider__slide">
                    <a href="<?php echo esc_url($link); ?>" class="mk-projecten-slider__slide-inner">

                        <div class="mk-projecten-slider__image">
                            <?php if ( ! empty($terms) && ! is_wp_error($terms) ) : ?>
                                <div class="mk-projecten-slider__tags">
                                    <?php foreach ($terms as $term) : ?>
                                        <span class="mk-projecten-slider__tag"><?php echo esc_html($term->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( $img_url ) : ?>
                                <img src="<?php echo esc_url($img_url); ?>"
                                     alt="<?php echo esc_attr($img_alt); ?>">
                            <?php endif; ?>
                        </div>

                        <h3 class="mk-projecten-slider__title"><?php echo esc_html($title); ?></h3>

                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <button class="mk-projecten-slider__prev" aria-label="Vorige">
            <img src="<?php echo esc_url($img_uri . '/Icon feather-arrow-right.svg'); ?>" alt="">
        </button>
        <button class="mk-projecten-slider__next" aria-label="Volgende">
            <img src="<?php echo esc_url($img_uri . '/Icon feather-arrow-right.svg'); ?>" alt="">
        </button>

    </div>

</section>
