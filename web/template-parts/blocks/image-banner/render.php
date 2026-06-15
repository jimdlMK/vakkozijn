<?php
$afbeelding        = get_field('ib_afbeelding');
$hoogte            = get_field('ib_hoogte') ?: '665';
$notch_pos         = get_field('ib_notch_positie') ?: 'geen';
$notch_stijl       = get_field('ib_notch_stijl') ?: 'midden';
$notch_kleur_boven = get_field('ib_notch_kleur_boven') ?: 'wit';
$notch_kleur_onder = get_field('ib_notch_kleur_onder') ?: 'wit';

$notch_top    = in_array($notch_pos, ['boven', 'boven-en-onder']);
$notch_bottom = in_array($notch_pos, ['onder', 'boven-en-onder']);

$color_boven = $notch_kleur_boven === 'lichtgrijs' ? '#F7F6F4' : '#ffffff';
$color_onder = $notch_kleur_onder === 'lichtgrijs' ? '#F7F6F4' : '#ffffff';

$classes = 'mk-image-banner mk-image-banner--h-' . esc_attr($hoogte);
if ( $notch_top )    $classes .= ' mk-image-banner--notch-top';
if ( $notch_bottom ) $classes .= ' mk-image-banner--notch-bottom';
if ( ($notch_top || $notch_bottom) && $notch_stijl === 'vleugels' ) $classes .= ' mk-image-banner--vleugels';

$inline_style = '--notch-color-top: ' . esc_attr($color_boven) . '; --notch-color-bottom: ' . esc_attr($color_onder) . ';';
?>

<div class="<?php echo $classes; ?>" style="<?php echo $inline_style; ?>">

    <?php if ( $afbeelding ) : ?>
        <img src="<?php echo esc_url($afbeelding['url']); ?>"
             alt="<?php echo esc_attr($afbeelding['alt']); ?>">
    <?php endif; ?>

    <?php if ( $notch_top ) : ?>
        <div class="mk-image-banner__notch mk-image-banner__notch--top"></div>
    <?php endif; ?>

    <?php if ( $notch_bottom ) : ?>
        <div class="mk-image-banner__notch mk-image-banner__notch--bottom"></div>
    <?php endif; ?>

</div>
