<div class="mk-nav-main">
    <?php wp_nav_menu( [
        'menu'        => 'Hoofdmenu',
        'walker'      => new MK_Nav_Walker(),
        'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    ] ); ?>
</div>