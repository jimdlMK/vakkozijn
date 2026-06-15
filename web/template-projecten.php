<?php
/**
 * Template Name: Projecten pagina
 */

get_header();
?>

<div id="main-content">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>

    <?php get_template_part( 'template-parts/projecten/grid' ); ?>
</div>

<?php get_footer(); ?>
