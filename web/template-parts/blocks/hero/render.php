<?php
$image         = get_field('hero_image');
$breadcrumb    = get_field('hero_breadcrumb');
$title_type    = get_field('hero_title_type');
$custom_title  = get_field('hero_custom_title');
$subtitle      = get_field('hero_subtitle');
$tekst         = get_field('hero_tekst');
$knop          = get_field('hero_knop');
$hoogte        = get_field('hero_hoogte') ?: 'groot';
$element_kleur = get_field('hero_element_kleur') ?: 'wit';
$img_uri       = get_stylesheet_directory_uri() . '/dist/images';

// Titel bepalen
if ( $title_type === 'custom' && $custom_title ) {
    $title = $custom_title;
} else {
    $title = get_the_title();
}

$classes = 'mk-hero';
if ( $image )                          $classes .= ' mk-hero--has-image';
if ( ! $image )                        $classes .= ' mk-hero--light-bg';
if ( $hoogte === 'subpagina' )         $classes .= ' mk-hero--subpagina';
if ( $hoogte === 'mini' )              $classes .= ' mk-hero--mini';
if ( $element_kleur === 'lichtgrijs' ) $classes .= ' mk-hero--element-lichtgrijs';
?>
<section class="<?php echo esc_attr( $classes ); ?>"
         <?php if ( $image ) : ?>
         style="background-image: url('<?php echo esc_url( $image['url'] ); ?>');"
         <?php else : ?>
         style="background-color: #F7F6F4;"
         <?php endif; ?>>

    <div class="mk-hero__overlay"></div>

    <div class="mk-hero__container">

        <?php if ( $breadcrumb && function_exists('mk_breadcrumbs') ) : ?>
            <div class="mk-hero__breadcrumb">
                <?php mk_breadcrumbs(); ?>
            </div>
        <?php endif; ?>

        <div class="mk-hero__content">

            <?php if ( $subtitle ) : ?>
                <span class="mk-hero__subtitle"><?php echo esc_html( $subtitle ); ?></span>
            <?php endif; ?>

            <?php if ( $title ) : ?>
                <h1 class="mk-hero__title"><?php echo esc_html( $title ); ?></h1>
            <?php endif; ?>

            <?php if ( $tekst ) : ?>
                <p class="mk-hero__tekst"><?php echo esc_html( $tekst ); ?></p>
            <?php endif; ?>

            <?php if ( $knop ) : ?>
                <a class="mk-btn"
                   href="<?php echo esc_url( $knop['url'] ); ?>"
                   <?php echo $knop['target'] ? 'target="' . esc_attr( $knop['target'] ) . '"' : ''; ?>>
                    <span class="mk-btn__label"><?php echo esc_html( $knop['title'] ); ?></span>
                    <span class="mk-btn__arrow-box">
                        <img src="<?php echo esc_url( $img_uri . '/Icon feather-arrow-right.svg' ); ?>" alt="">
                    </span>
                </a>
            <?php endif; ?>

        </div>
    </div>

    <div class="mk-hero__element">
        <img src="<?php echo esc_url( $img_uri . '/huisstijl-element-hero.svg' ); ?>" alt="" role="presentation">
    </div>

</section>