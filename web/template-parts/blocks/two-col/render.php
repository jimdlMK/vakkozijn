<?php
$ratio      = get_field('tc_ratio') ?: '50-50';
$background = get_field('tc_background') ?: 'wit';
$img_uri    = get_stylesheet_directory_uri() . '/dist/images';

// Vang de class op die je bij 'Geavanceerd' invult (standaard leeg als je niks invult)
$custom_class = !empty($block['className']) ? $block['className'] : '';

$cols = [
    [
        'title_level' => get_field('tc_col1_title_level') ?: 'h2',
        'title'       => get_field('tc_col1_title'),
        'tekst'       => get_field('tc_col1_tekst'),
        'afbeelding'  => get_field('tc_col1_afbeelding'),
        'quote'       => get_field('tc_col1_quote'),
        'partners'    => get_field('tc_col1_partners') ?: [],
        'knop'        => get_field('tc_col1_knop'),
        'form_id'     => (int) get_field('tc_col1_form_id'),
    ],
    [
        'title_level' => get_field('tc_col2_title_level') ?: 'h2',
        'title'       => get_field('tc_col2_title'),
        'tekst'       => get_field('tc_col2_tekst'),
        'afbeelding'  => get_field('tc_col2_afbeelding'),
        'quote'       => get_field('tc_col2_quote'),
        'partners'    => get_field('tc_col2_partners') ?: [],
        'knop'        => get_field('tc_col2_knop'),
        'form_id'     => (int) get_field('tc_col2_form_id'),
    ],
];

$block_classes = implode(' ', array_filter([
    'mk-two-col',
    'mk-two-col--ratio-' . sanitize_html_class($ratio),
    $background === 'lichtgrijs' ? 'mk-two-col--bg-light' : 'mk-two-col--bg-white',
]));
?>

<section class=" <?php echo esc_attr($custom_class); ?> <?php echo esc_attr($block_classes); ?>">
    <div class="mk-two-col__inner">
        <?php foreach ($cols as $i => $col) : ?>
        <?php 
            // Check of we in de 2e kolom zitten en er exact 2 partners zijn
            $is_col_2 = ($i === 1);
            $has_two_partners = (!empty($col['partners']) && count($col['partners']) === 2);
            
            $col_classes = "mk-two-col__col";
            if ($is_col_2 && $has_two_partners) {
                $col_classes .= " mk-two-col__col--stretch";
            }
        ?>
        <div class="<?php echo esc_attr($col_classes); ?>">

            <?php if ( ! empty($col['title']) ) :
                $tag = esc_attr($col['title_level']);
            ?>
            <div class="mk-two-col__slot mk-two-col__slot--title">
                <<?php echo $tag; ?> class="mk-two-col__title"><?php echo esc_html($col['title']); ?></<?php echo $tag; ?>>
            </div>
            
            <?php // TOEGEVOEGD: Onzichtbare dummy-titel in kolom 2 als er tekst is, om hoogte gelijk te trekken aan kolom 1
            elseif ( $is_col_2 && empty($col['title']) && !empty($cols[0]['title']) && !empty($col['tekst']) && !empty($cols[0]['tekst']) ) : 
                $tag_c1 = esc_attr($cols[0]['title_level']);
            ?>
            <div class="mk-two-col__slot mk-two-col__slot--title" style="visibility: hidden; pointer-events: none;" aria-hidden="true">
                <<?php echo $tag_c1; ?> class="mk-two-col__title"><?php echo esc_html($cols[0]['title']); ?></<?php echo $tag_c1; ?>>
            </div>
            <?php endif; ?>

            <?php if ( ! empty($col['tekst']) ) : ?>
            <div class="mk-two-col__slot mk-two-col__slot--tekst">
                <div class="mk-two-col__tekst"><?php echo $col['tekst']; ?></div>
            </div>
            <?php endif; ?>

            <?php if ( ! empty($col['afbeelding']) ) : ?>
            <div class="mk-two-col__slot mk-two-col__slot--afbeelding">
                <img src="<?php echo esc_url($col['afbeelding']['url']); ?>"
                     alt="<?php echo esc_attr($col['afbeelding']['alt']); ?>">
            </div>
            <?php endif; ?>

            <?php if ( ! empty($col['quote']) ) : ?>
            <div class="mk-two-col__slot mk-two-col__slot--quote">
                <blockquote class="mk-two-col__quote">&ldquo;<?php echo esc_html($col['quote']); ?>&rdquo;</blockquote>
            </div>
            <?php endif; ?>

            <?php if ( ! empty($col['partners']) ) : 
                // TOEGEVOEGD: Voeg is-centered toe als col 2 exact 2 partners heeft
                $partners_class = "mk-two-col__slot mk-two-col__slot--partners";
                if ($is_col_2 && $has_two_partners) {
                    $partners_class .= " is-centered";
                }
            ?>
            <div class="<?php echo esc_attr($partners_class); ?>">
                <?php foreach ($col['partners'] as $row) :
                    if ( empty($row['logo']) ) continue;
                ?>
                    <img src="<?php echo esc_url($row['logo']['url']); ?>"
                         alt="<?php echo esc_attr($row['logo']['alt']); ?>"
                         class="mk-two-col__partner-logo">
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ( ! empty($col['knop']) ) : ?>
            <div class="mk-two-col__slot mk-two-col__slot--knop">
                <a class="mk-btn"
                   href="<?php echo esc_url($col['knop']['url']); ?>"
                   <?php if ( $col['knop']['target'] ) : ?>target="<?php echo esc_attr($col['knop']['target']); ?>"<?php endif; ?>>
                    <span class="mk-btn__label"><?php echo esc_html($col['knop']['title']); ?></span>
                    <span class="mk-btn__arrow-box">
                        <img src="<?php echo esc_url($img_uri . '/Icon feather-arrow-right.svg'); ?>" alt="">
                    </span>
                </a>
            </div>
            <?php endif; ?>

            <?php if ( ! empty($col['form_id']) && function_exists('gravity_form') ) : ?>
            <div id="bericht" class="mk-two-col__slot mk-two-col__slot--form">
                <?php gravity_form( $col['form_id'], false, false, false, null, true ); ?>
            </div>
            <?php endif; ?>

        </div>
        <?php endforeach; ?>
    </div>
</section>