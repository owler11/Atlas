<?php
/**
 * Template Parts - Footer - Footer Secondary
 * 
 * @package atlas
 */

$site_copyright = get_field('site_copyright', 'options');
$privacy_url 	= get_privacy_policy_url();
?>


<div class="site-footer-secondary">
	<div class="container site-footer-secondary__container">
		<div class="site-footer-secondary__legal">
			<p class="copyright">© <?php echo esc_html(date('Y')); ?> <?php echo $site_copyright; ?></p>

			<?php
			if ($privacy_url) {
				echo '<span>|</span> <a href="' . esc_url($privacy_url) . '">' . esc_html__('Privacy Policy', 'atlas') . '</a>';
			}
			?>
		</div>
	</div>
</div>

