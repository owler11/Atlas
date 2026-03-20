<?php
/**
 * Template Parts - Header - Header Primary
 * 
 *
 * Header primary: logo, primary nav (ACF), search link, menu toggle.
 * ACF key: menu_primary (option). 
 * Class contract: primary-menu__* (list, item, link, trigger, submenu).
 * JS: mobileMenu() (drawer), primaryMenuSubmenus() (accordion + desktop dropdown).
 * Mobile: drawer + accordion; desktop: hover + keyboard.
 */

$has_primary = ! empty(get_field('menu_primary', 'option')); // Check if primary menu exists
?>

<header id="site-header" class="site-header site-header--sticky">
	<div class="container site-header__container">
		<div class="site-header__branding">
			<a class="site-header__logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php esc_attr_e('Back Home', 'atlas'); ?>">
				<?php include locate_template('template-parts/components/svg-logo.php', false, false); ?>
			</a>
		</div>

		<?php if ($has_primary) : ?>
			<nav class="site-header__menu primary-menu" aria-label="<?php esc_attr_e('Primary navigation', 'atlas'); ?>">
				<?php atlas_render_menu_primary(); ?>
			</nav>
		<?php endif; ?>

		<a href="<?php echo esc_url(home_url('/?s=')); ?>" class="header-search-icon" aria-label="<?php esc_attr_e('Search', 'atlas'); ?>"><i class="fa-solid fa-magnifying-glass"></i></a>

		<?php if ($has_primary) : ?>
			<button class="menu-toggle js-menu-toggle" type="button" aria-expanded="false" aria-label="<?php esc_attr_e('Open menu', 'atlas'); ?>">
				<span class="menu-toggle__icon" aria-hidden="true"></span>
			</button>
		<?php endif; ?>
	</div>
</header><!-- #site-header -->

<div class="site-backdrop" aria-hidden="true"></div>