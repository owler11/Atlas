<?php
/**
 * Template Parts - Footer - Footer Secondary
 * 
 * @package mingo
 */

$site_copyright 	= get_field('site_copyright', 'options');
?>


<div class="site-footer__secondary">
	<div class="container site-footer__secondary-container">
		<div class="site-footer__copyright">
			<p class="copyright">© <?php echo date('Y'); ?> <?php echo $site_copyright; ?></p>

			<?php 
			wp_nav_menu(array(
				'theme_location' => 'legal',
				'container' 	 => 'false',
				'menu_class' 	 => 'legal-menu',
				'depth'			 => 1,	
				'fallback_cb' 	 => false
			));
			?>
		</div>
	</div>
</div>

