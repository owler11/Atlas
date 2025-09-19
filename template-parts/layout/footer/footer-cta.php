<?php
/**
 * Template Parts - Footer - Footer CTA
 * 
 * @package mingo
 */

$override_footer_cta 	= get_field('footer_cta'); 			 	// From 'page'
$footer_cta_status 		= get_field('footer_cta_status'); 	 	// From 'page'
$footer_cta 			= get_field('footer_cta', 'option'); 	// Default stuff

if($footer_cta_status == 'disable' || is_search() || is_post_type_archive() || is_single() || is_home()) {
	// Dont show CTA
	return;

} elseif($override_footer_cta && $footer_cta_status == 'override') {
	$cta_title 			= $override_footer_cta['title'];
	$cta_headline 		= $override_footer_cta['headline'];
	$cta_description 	= $override_footer_cta['description'];
	$cta_link 			= $override_footer_cta['link'];
	$cta_padding 		= $override_footer_cta['padding'];
	$cta_theme 			= $override_footer_cta['theme'];
} else {
	$cta_title 			= $footer_cta['title'];
	$cta_headline 		= $footer_cta['headline'];
	$cta_description 	= $footer_cta['description'];
	$cta_link 			= $footer_cta['link'];
	$cta_padding 		= $footer_cta['padding'];
	$cta_theme 			= $footer_cta['theme'];
}
?>


<div class="site-footer__cta theme-<?php echo $cta_theme; ?> padding-<?php echo $cta_padding; ?>">
	<div class="container site-footer-cta__container">
		<div class="site-footer-cta__grid">
			<div class="site-footer-cta__content">
				<?php
				if($cta_title) :
					echo '<h4 class="title">' . $cta_title . '</h4>';
				endif;

				if($cta_headline) :
					echo '<h2 class="headline">' . $cta_headline . '</h2>';
				endif;

				if($cta_description) :
					echo '<p class="description">' . $cta_description . '</p>';
				endif;

				if($cta_link) :
					if($cta_theme == 'dark') {
						$color = ' btn__light';
					} elseif($cta_theme == 'light') {
						$color = ' btn__dark';
					} else {
						$color = '';
					}
					echo getButton($cta_link, 'btn__default' . $color);
				endif;
				?>
			</div>
		</div>
	</div>
</div>

