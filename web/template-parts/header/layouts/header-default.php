<header class="mk-header">
  <div class="mk-header__container">
    <div class="mk-header__container__inner">
		<div class="mk-header__container__inner__top">
			<span>USP 1</span>
			<span>USP 2</span>
			<span>USP 3</span>
			<span>USP 4</span>
		</div>
		<div class="mk-header__container__inner__left">
			<div class="mk-header__container__inner__left__logo">
				<a class="mk-header__logo" href="<?php echo esc_url(home_url('/')); ?>">
					<img src="<?php echo esc_url(get_field('logo' , 'option')['url']);?>">
				</a>
			</div>
		</div>
		<div class="mk-header__container__inner__right">
			<?php get_template_part('template-parts/header/nav-main'); ?>
			<div class="open-mobile-menu">
				<span class="lineone"></span>
				<span class="linetwo"></span>
				<span class="linethree"></span>
			</div>
		</div>
    </div>
  </div>
</header>