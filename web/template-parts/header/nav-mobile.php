<?php
$phone    = get_field('telefoon', 'options');
$email    = get_field('email', 'options');
$img_uri  = get_stylesheet_directory_uri() . '/dist/images';
$logo_url = get_field('logo', 'options');
?>
<div class="mk-mobile-menu">
    <div class="mk-mobile-menu__inner">

        <div class="mk-mobile-menu__inner__top">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="mk-mobile-menu__inner__top__logo">
                <?php if ( $logo_url ) : ?>
                    <img src="<?php echo esc_url( $logo_url['url'] ); ?>" alt="<?php bloginfo('name'); ?>">
                <?php endif; ?>
            </a>
            <div class="mk-mobile-menu__inner__top__actions">
                <?php if ( $phone ) : ?>
                <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $phone) ); ?>" class="mk-mobile-menu__inner__top__phone" aria-label="Bellen">
                    <img src="<?php echo esc_url( $img_uri . '/phone-icon-black.svg' ); ?>" alt="">
                </a>
                <?php endif; ?>
                <div class="close">
                    <span class="lineone"></span>
                    <span class="linetwo"></span>
                </div>
            </div>
        </div>

        <div class="mk-mobile-menu__inner__menu">
            <?php wp_nav_menu( array(
                'menu'        => 'Hoofdmenu',
                'walker'      => new MK_Nav_Walker(),
                'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            ) ); ?>
        </div>

        <div class="mk-mobile-menu__inner__bottom">
            <div class="mk-mobile-menu__inner__bottom__contact">
                <?php if ( $phone ) : ?>
                <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $phone) ); ?>" class="mk-mobile-menu__inner__bottom__item">
                    <img src="<?php echo esc_url( $img_uri . '/phone-icon-black.svg' ); ?>" alt="">
                    <span><?php echo esc_html( $phone ); ?></span>
                </a>
                <?php endif; ?>
                <?php if ( $email ) : ?>
                <a href="mailto:<?php echo esc_attr( $email ); ?>" class="mk-mobile-menu__inner__bottom__item">
                    <img src="<?php echo esc_url( $img_uri . '/mail-icon-black.svg' ); ?>" alt="">
                    <span><?php echo esc_html( $email ); ?></span>
                </a>
                <?php endif; ?>
            </div>
            <div class="mk-mobile-menu__inner__bottom__socials">
                <?php get_template_part('template-parts/contact/socials'); ?>
            </div>
        </div>

    </div>
</div>
