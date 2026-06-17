<div class="socials-container">
    <?php global $stream_opts; ?>
    <div class="socials">
        <?php if ( have_rows('socials', 'options') ) : while ( have_rows('socials', 'options') ) : the_row(); ?>
            <?php
            $social = get_sub_field('platform');
            $icon   = get_bloginfo('stylesheet_directory') . '/dist/images/socials/' . $social . '.svg';
            $icon_path = ABSPATH . str_replace( get_bloginfo('url') . '/', '', $icon );
            ?>
            <?php if ( file_exists( $icon_path ) ) : ?>
                <a class="socials__item socials__item--<?php echo esc_attr( $social ); ?>" target="_blank" rel="noopener noreferrer" href="<?php echo esc_url( get_sub_field('url') ); ?>">
                    <?php echo file_get_contents( $icon, false, stream_context_create( $stream_opts ) ); ?>
                </a>
            <?php endif; ?>
        <?php endwhile; endif; ?>
    </div>
</div>
