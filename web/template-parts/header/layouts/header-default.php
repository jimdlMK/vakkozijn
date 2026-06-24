<?php
$phone      = get_field('telefoon', 'options');
$email      = get_field('email', 'options');
$img_uri    = get_stylesheet_directory_uri() . '/dist/images';
$logo_url   = get_field('logo', 'options');
$usp_actief = get_field('usp_actief', 'options');
$usps       = get_field('usps', 'options');
?>
<header class="mk-header">

    <div class="mk-header__topbar">
        <div class="mk-header__topbar__inner">
            <?php if ( $usp_actief && ! empty( $usps ) ) : ?>
            <div class="mk-header__topbar__usp">
                <img src="<?php echo esc_url( $img_uri . '/V-logo.svg' ); ?>" alt="" class="mk-header__topbar__usp__icon">
                <div class="mk-usp-rotator">
                    <?php foreach ( $usps as $index => $usp ) : ?>
                    <span class="mk-usp-rotator__item<?php echo $index === 0 ? ' is-active' : ''; ?>">
                        <?php echo esc_html( $usp['usp_tekst'] ); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="mk-header__topbar__contact">
                <?php if ( $phone ) : ?>
                    <a href="tel:<?php echo esc_attr( $phone ); ?>" class="mk-header__topbar__contact__item">
                        <img src="<?php echo esc_url( $img_uri . '/phone-icon-black.svg' ); ?>" alt="" class="mk-header__topbar__contact__icon">
                        <span><?php echo esc_html( $phone ); ?></span>
                    </a>
                <?php endif; ?>
                <?php if ( $email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>" class="mk-header__topbar__contact__item">
                        <img src="<?php echo esc_url( $img_uri . '/mail-icon-black.svg' ); ?>" alt="" class="mk-header__topbar__contact__icon">
                        <span><?php echo esc_html( $email ); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mk-header__main">
        <div class="mk-header__main__inner">
            <div class="mk-header__main__logo">
                <a href="<?php echo esc_url( home_url('/') ); ?>">
                    <?php if ( $logo_url ) : ?>
                        <img src="<?php echo esc_url( $logo_url['url'] ); ?>" alt="<?php bloginfo('name'); ?>">
                    <?php endif; ?>
                </a>
            </div>
            <div class="mk-header__main__nav">
                <?php get_template_part('template-parts/header/nav-main'); ?>
                <div class="mk-header__mobile-actions">
                    <?php if ( $phone ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $phone) ); ?>" class="mk-header__mobile-phone" aria-label="Bellen">
                        <img src="<?php echo esc_url( $img_uri . '/phone-icon-black.svg' ); ?>" alt="">
                    </a>
                    <?php endif; ?>
                    <div class="open-mobile-menu">
                        <span class="lineone"></span>
                        <span class="linetwo"></span>
                        <span class="linethree"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<?php if ( $phone ) : ?>
<a class="mk-floating-btn" href="/contact" aria-label="Bel voor een offerte">
    <span class="mk-floating-btn__icon">
        <span>
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/phone-icon-black.svg' ); ?>" alt="Bel voor een offerte">
        </span>
    </span>
    <span class="mk-floating-btn__label">Neem contact op</span>
</a>
<?php endif; ?>
