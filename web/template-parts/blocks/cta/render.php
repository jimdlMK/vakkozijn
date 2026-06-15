<?php
$titel      = get_field('cta_titel');
$tekst      = get_field('cta_tekst');
$knop       = get_field('cta_knop');
$afbeelding = get_field('cta_afbeelding');
$img_uri    = get_stylesheet_directory_uri() . '/dist/images';
?>

<section class="mk-cta">

    <div class="mk-cta__huisstijl" aria-hidden="true">
        <img src="<?php echo esc_url( $img_uri . '/v-logo-huisstijl-green.svg' ); ?>" alt="" role="presentation">
    </div>

    <div class="mk-cta__inner">

        <div class="mk-cta__content">

            <?php if ( $titel ) : ?>
                <h2 class="mk-cta__titel"><?php echo esc_html( $titel ); ?></h2>
            <?php endif; ?>

            <?php if ( $tekst ) : ?>
                <p class="mk-cta__tekst"><?php echo nl2br( esc_html( $tekst ) ); ?></p>
            <?php endif; ?>

            <?php if ( $knop ) : ?>
                <a class="mk-btn mk-btn--dark"
                   href="<?php echo esc_url( $knop['url'] ); ?>"
                   <?php echo $knop['target'] ? 'target="' . esc_attr( $knop['target'] ) . '"' : ''; ?>>
                    <span class="mk-btn__label"><?php echo esc_html( $knop['title'] ); ?></span>
                    <span class="mk-btn__arrow-box">
                        <img src="<?php echo esc_url( $img_uri . '/Icon feather-arrow-right.svg' ); ?>" alt="">
                    </span>
                </a>
            <?php endif; ?>

        </div>

        <?php if ( $afbeelding ) : ?>
        <div class="mk-cta__afbeelding">
            <img src="<?php echo esc_url( $afbeelding['url'] ); ?>"
                 alt="<?php echo esc_attr( $afbeelding['alt'] ); ?>"
                 loading="eager">
        </div>
        <?php endif; ?>

    </div>

</section>
