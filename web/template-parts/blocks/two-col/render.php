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
        <?php foreach ($cols as $col) : ?>
        <div class="mk-two-col__col">

            <?php if ( ! empty($col['title']) ) :
                $tag = esc_attr($col['title_level']);
            ?>
            <div class="mk-two-col__slot mk-two-col__slot--title">
                <<?php echo $tag; ?> class="mk-two-col__title"><?php echo esc_html($col['title']); ?></<?php echo $tag; ?>>
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

            <?php if ( ! empty($col['partners']) ) : ?>
            <div class="mk-two-col__slot mk-two-col__slot--partners">
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
