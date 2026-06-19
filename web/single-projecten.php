<?php get_header(); ?>

<div id="main-content">

<?php
$img_uri_hero = get_stylesheet_directory_uri() . '/dist/images';
?>
<section class="mk-hero mk-hero--subpagina mk-hero--element mk-hero--light-bg" style="background-color: #F7F6F4; min-height: 240px !important;">

    <div class="mk-hero__overlay" style="background: none; "></div>

    <div class="mk-hero__container" style="padding-bottom: 80px; padding-top: 32px; justify-content: flex-end;">

        <?php if ( function_exists('mk_breadcrumbs') ) : ?>
            <div class="mk-hero__breadcrumb" style="top: 32px;">
                <?php mk_breadcrumbs(); ?>
            </div>
        <?php endif; ?>

        <div class="mk-hero__content">
            <h1 class="mk-hero__title" style="color: #000000; line-height: 1.2;">Onze projecten</h1>
        </div>

    </div>

    <div class="mk-hero__element" style="height: 80px;">
        <img src="<?php echo esc_url( $img_uri_hero . '/huisstijl-element-hero.svg' ); ?>" alt="" role="presentation">
    </div>

</section>

<?php while ( have_posts() ) : the_post();
    $img_uri = get_stylesheet_directory_uri() . '/dist/images';
    $terms   = get_the_terms( get_the_ID(), 'project-categorie' );
    $gallery = get_field( 'project_gallery' );
?>

<article class="mk-project-single">

    <div class="mk-project-single__header">
        <div class="mk-project-single__header-inner">

            <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
            <div class="mk-project-single__tags">
                <?php foreach ( $terms as $term ) : ?>
                <span class="mk-project-single__tag"><?php echo esc_html( $term->name ); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <h1 class="mk-project-single__title"><?php the_title(); ?></h1>

            <div class="mk-project-single__content">
                <?php the_content(); ?>
            </div>

        </div>
    </div>

    <?php if ( ! empty( $gallery ) ) : ?>
    <div class="mk-project-gallery">

        <div class="mk-project-gallery__nav">
            <button class="mk-project-gallery__prev" aria-label="Vorige">
                <img src="<?php echo esc_url( $img_uri . '/Icon feather-arrow-right.svg' ); ?>" alt="">
            </button>
            <button class="mk-project-gallery__next" aria-label="Volgende">
                <img src="<?php echo esc_url( $img_uri . '/Icon feather-arrow-right.svg' ); ?>" alt="">
            </button>
        </div>

        <div class="swiper mk-project-gallery__swiper">
            <div class="swiper-wrapper">
                <?php foreach ( $gallery as $image ) : ?>
                <div class="swiper-slide mk-project-gallery__slide">
                    <a href="<?php echo esc_url( $image['url'] ); ?>"
                       class="glightbox"
                       data-gallery="gallery-<?php echo get_the_ID(); ?>"
                       <?php if ( $image['caption'] ) : ?>data-description="<?php echo esc_attr( $image['caption'] ); ?>"<?php endif; ?>>
                        <img src="<?php echo esc_url( isset( $image['sizes']['large'] ) ? $image['sizes']['large'] : $image['url'] ); ?>"
                             alt="<?php echo esc_attr( $image['alt'] ); ?>">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <?php endif; ?>

</article>

<?php endwhile; ?>
</div>

<?php get_footer(); ?>
