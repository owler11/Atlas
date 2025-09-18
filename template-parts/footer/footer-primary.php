<?php
/**
 * Template Parts - Footer - Footer Primary
 * 
 * @package mingo
 */

$social_links 		= get_field('social_links', 'option');

$site_phone 		= get_field('site_phone', 'option');
$site_email 		= get_field('site_email', 'option');
$site_copyright 	= get_field('site_copyright', 'options');
if(!$site_copyright) {
	$site_copyright = get_bloginfo('name');
}
?>


<div class="site-footer__primary">
	<div class="container site-footer__primary-container">
		<div class="grid">
			<div class="site-footer__contact">
				<a class="foot-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Back to Home">
					<?php
					include( locate_template( 'template-parts/components/svg-logo.php', false, false ) ); 
					?>
				</a>

				<?php
				if($social_links) :
				?>
				<ul class="site-footer__social">
					<?php
					foreach($social_links as $social) :
						$link = $social['link'];
						$icon = $social['icon'];

						echo '<li><a href="'. $link['url'] .'" target="'. $link['target'] .'" title="'. $link['title'] .'">'. $icon .'<span class="sr-only">'. $link['title'] .'</span></a></li>';
					endforeach;
					?>
				</ul>
				<?php
				endif;
				?>
			</div>

			<nav class="site-footer__menu">
				<?php wp_footer_menu(); ?>
			</nav>
		</div>
	</div>
</div>

