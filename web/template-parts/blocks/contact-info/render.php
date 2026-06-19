<?php
$titel   = get_field('ci_titel');
$knop    = get_field('ci_knop');
$link    = get_field('ci_link');
$img_uri = get_stylesheet_directory_uri() . '/dist/images';

// Contactgegevens uit theme options
$bedrijfsnaam = get_field('bedrijfsnaam', 'options');
$adres        = get_field('adres', 'options');
$postcode     = get_field('postcode', 'options');
$email        = get_field('email', 'options');
$telefoon     = get_field('telefoon', 'options');
$kvk          = get_field('kvk', 'options');

// Stream context voor inline SVG (socials)
global $stream_opts;
?>

<section class="mk-contact-info-block">
    <div class="mk-contact-info-block__inner">

        <!-- Kolom 1: titel, knop, link -->
        <div class="mk-contact-info-block__left">

            <?php if ( $titel ) : ?>
                <h2 class="mk-contact-info-block__titel"><?php echo esc_html( $titel ); ?></h2>
            <?php endif; ?>

            <div class="mk-contact-info-block__actions">

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

                <?php if ( $link ) : ?>
                <a class="mk-contact-info-block__link"
                   href="<?php echo esc_url( $link['url'] ); ?>"
                   <?php echo $link['target'] ? 'target="' . esc_attr( $link['target'] ) . '"' : ''; ?>>
                    <span><?php echo esc_html( $link['title'] ); ?></span>
                    <img src="<?php echo esc_url( $img_uri . '/Icon feather-arrow-right.svg' ); ?>" alt="">
                </a>
                <?php endif; ?>

            </div>
        </div>

        <!-- Kolom 2: contactgegevens + socials -->
        <div class="mk-contact-info-block__right">

            <div class="mk-contact-info-block__gegevens">

                <?php if ( $bedrijfsnaam ) : ?>
                    <strong class="mk-contact-info-block__bedrijf"><?php echo esc_html( $bedrijfsnaam ); ?></strong>
                <?php endif; ?>

                <?php if ( $adres ) : ?>
                    <span><?php echo esc_html( $adres ); ?></span>
                <?php endif; ?>

                <?php if ( $postcode ) : ?>
                    <span><?php echo esc_html( $postcode ); ?></span>
                <?php endif; ?>

                <?php if ( $email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                <?php endif; ?>

                <?php if ( $telefoon ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $telefoon) ); ?>"><?php echo esc_html( $telefoon ); ?></a>
                <?php endif; ?>

                <?php if ( $kvk ) : ?>
                    <span>KVK: <?php echo esc_html( $kvk ); ?></span>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>
