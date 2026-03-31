<?php
/**
 * Template Parts - Footer - Footer Primary
 * 
 * @package atlas
 */

$social_links = get_field('social_links', 'option');
?>


<div class="site-footer-primary">
	<div class="container site-footer-primary__container">
		<div class="grid site-footer-primary__grid">
			<div class="site-footer-primary__contact">
				<a class="foot-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="Back to Home">
					<?php
					include( locate_template( 'template-parts/components/svg-logo.php', false, false ) ); 
					?>
				</a>

				<?php
				if($social_links) :
				?>
				<ul class="site-footer-primary__social">
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

			<?php if ( ! empty( get_field( 'menu_footer', 'option' ) ) ) : ?>
			<nav class="site-footer-primary__menu footer-menu" aria-label="<?php esc_attr_e( 'Footer menu', 'atlas' ); ?>">
				<?php atlas_render_menu_footer(); ?>
			</nav>
		<?php endif; ?>
		</div>
	</div>
</div>

