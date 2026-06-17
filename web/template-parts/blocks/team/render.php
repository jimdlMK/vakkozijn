<?php
$titel      = get_field('team_titel');
$medewerkers = get_field('team_medewerkers');
$afbeelding = get_field('team_afbeelding');
$img_uri    = get_stylesheet_directory_uri() . '/dist/images';
?>

<section class="mk-team">
    <div class="mk-team__inner">

        <div class="mk-team__left">

            <?php if ( $titel ) : ?>
                <h2 class="mk-team__titel"><?php echo esc_html( $titel ); ?></h2>
            <?php endif; ?>

            <?php if ( $medewerkers ) : ?>
            <div class="mk-team__grid">
                <?php foreach ( $medewerkers as $mw ) :
                    $portret = $mw['team_portret'];
                    $naam    = $mw['team_naam'];
                    $email   = $mw['team_email'];
                    $telefoon = $mw['team_telefoon'];
                ?>
                <div class="mk-team__card">

                    <?php if ( $portret ) : ?>
                    <div class="mk-team__portret">
                        <img src="<?php echo esc_url( $portret['url'] ); ?>"
                             alt="<?php echo esc_attr( $portret['alt'] ?: $naam ); ?>"
                             width="220" height="296">
                    </div>
                    <?php endif; ?>

                    <?php if ( $naam ) : ?>
                    <p class="mk-team__naam"><?php echo esc_html( $naam ); ?></p>
                    <?php endif; ?>

                    <div class="mk-team__contact">
                        <?php if ( $email ) : ?>
                        <a class="mk-team__link mk-team__link--mail" href="mailto:<?php echo esc_attr( $email ); ?>">
                            <span><?php echo esc_html( $email ); ?></span>
                        </a>
                        <?php endif; ?>

                        <?php if ( $telefoon ) : ?>
                        <a class="mk-team__link mk-team__link--phone" href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $telefoon) ); ?>">
                            <span><?php echo esc_html( $telefoon ); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>

        <?php if ( $afbeelding ) : ?>
        <div class="mk-team__right">
            <img src="<?php echo esc_url( $afbeelding['url'] ); ?>"
                 alt="<?php echo esc_attr( $afbeelding['alt'] ); ?>"
                 loading="lazy">
        </div>
        <?php endif; ?>

    </div>
</section>
