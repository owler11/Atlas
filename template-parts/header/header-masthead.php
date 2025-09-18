<?php
/**
 * Template Parts - Header - Header Masthead
 * 
 * Header Masthead
 * 
 * @package mingo
 */

$menu_type	 = get_option('current_menu_type'); // Can be manually set to 'horizontal', 'vertical' or 'vertical-drilldown'
$site_search = get_field('site_search', 'option');
$site_sticky = get_field('site_sticky_header', 'option');
$site_sticky = ($site_sticky) ? ' site-header--sticky' : '';
?>

<header id="site-header" class="site-header type-<?php echo $menu_type . $site_sticky; ?>">
	<div class="site-header__primary">
		<div class="container site-header__primary-container">
			<div class="site-header__branding">
				<a class="masthead-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Back Home">
					<?php
					// Logo
					include( locate_template( 'template-parts/components/svg-logo.php', false, false ) );
					?>
				</a>
			</div>

			<?php
			if (has_nav_menu('primary')) :
			?>
			<nav class="site-header__primary-menu">
				<div class="menu-close js-menu-close">
					<i class="fa-solid fa-xmark"></i>
				</div>

				<div class="menu-wrapper">
					<?php wp_primary_menu(); ?>
				</div>
			</nav>
			<?php
			endif;
			?>

			<?php
			if($site_search) {
			?>
			<div class="site-header__search">
				<button class="search-toggle js-search-toggle" aria-label="Show Search">
					<i class="fa-solid fa-search"></i>
				</button>
			</div>
			<?php
			}
			?>
				
			<?php
			if (has_nav_menu('primary')) :
			?>
			<button class="menu-toggle js-menu-toggle burger" aria-label="Show Menu">
				<i class="fa-solid fa-bars"></i>
			</button>
			<?php
			endif;
			?>
		</div>
	</div>

	<?php
	if($site_search) {
	?>
		<div class="site-header__search-form js-search-form">
			<div class="container">
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php
	}
	?>

	<div class="site-header__backdrop"></div>
</header><!-- #site-header -->