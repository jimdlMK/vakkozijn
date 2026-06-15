<?php
$companyname   = get_field('bedrijfsnaam', 'options');
$footer_tekst  = get_field('footer_tekst', 'options');
$logo_url      = get_field('logo', 'option');
$current_year  = date('Y');
?>
<footer class="mk-footer">

    <div class="mk-footer__container">
        <div class="mk-footer__container__inner">

            <!-- Kolom 1: Bezoek ons -->
            <div class="mk-footer__col mk-footer__col--contact">
                <h4 class="mk-footer__col__title">Bezoek ons</h4>
                <?php get_template_part('template-parts/contact/contact-info'); ?>
            </div>

            <!-- Kolom 2: Informatie + Socials -->
            <div class="mk-footer__col mk-footer__col--info">
                <h4 class="mk-footer__col__title">Informatie</h4>
                <?php if ( $footer_tekst ) : ?>
                    <p class="mk-footer__col__tekst"><?php echo wp_kses_post( $footer_tekst ); ?></p>
                <?php endif; ?>
                <?php get_template_part('template-parts/contact/socials'); ?>
            </div>

            <!-- Kolom 3: Logo -->
            <div class="mk-footer__col mk-footer__col--logo">
                <?php if ( $logo_url ) : ?>
                    <a href="<?php echo esc_url( home_url('/') ); ?>">
                        <img src="<?php echo esc_url( $logo_url['url'] ); ?>" alt="<?php bloginfo('name'); ?>" class="mk-footer__logo">
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Footer bottom -->
    <div class="mk-footer__bottom">
        <div class="mk-footer__bottom__inner">

            <div class="mk-footer__bottom__left">
                <span class="mk-footer__bottom__copyright">
                    &copy; <?php echo esc_html( $current_year ); ?> <?php echo esc_html( $companyname ); ?>
                </span>
                <nav class="mk-footer__bottom__links">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer_menu',
                        'menu'           => 'Footermenu',
                        'container'      => false,
                        'menu_class'     => 'mk-footer__bottom__links__list',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) ); ?>
                </nav>
            </div>

            <div class="mk-footer__bottom__right">
                <span class="mk-footer__bottom__credit">
                    Gerealiseerd door: <a href="https://www.mediakanjers.nl" target="_blank" rel="noopener noreferrer">Mediakanjers</a>
                </span>
            </div>

        </div>
    </div>

</footer>
