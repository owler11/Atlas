<?php

/**
 * Template Parts - Header - Utility
 * Single bar between message bar and primary header.
 *
 * @package atlas
 */

if ( ! empty( get_field( 'menu_utility', 'option' ) ) ) : ?>
	<div class="utility-menu">
		<div class="container">
			<nav aria-label="<?php esc_attr_e( 'Utility menu', 'atlas' ); ?>">
				<?php atlas_render_menu_utility(); ?>
			</nav>
		</div>
	</div>
<?php endif; ?>