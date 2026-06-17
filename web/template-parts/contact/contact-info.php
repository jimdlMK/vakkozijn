<?php
$address     = get_field('adres', 'options');
$zipcode     = get_field('postcode', 'options');
$phonenumber = get_field('telefoon', 'options');
$mail        = get_field('email', 'options');
?>
<div class="contact-info">
    <?php if ( $address ) : ?>
        <span class="contact-info__address"><?php echo esc_html( $address ); ?></span>
    <?php endif; ?>
    <?php if ( $zipcode ) : ?>
        <span class="contact-info__zipcode"><?php echo esc_html( $zipcode ); ?></span>
    <?php endif; ?>
    <?php if ( $phonenumber ) : ?>
        <a href="tel:<?php echo esc_attr( $phonenumber ); ?>" class="contact-info__link contact-info__link--phone">
            <?php echo esc_html( $phonenumber ); ?>
        </a>
    <?php endif; ?>
    <?php if ( $mail ) : ?>
        <a href="mailto:<?php echo esc_attr( $mail ); ?>" class="contact-info__link contact-info__link--mail">
            <?php echo esc_html( $mail ); ?>
        </a>
    <?php endif; ?>
</div>
