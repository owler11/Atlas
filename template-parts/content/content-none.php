<?php
/**
 * Template Parts - Content - Content None
 * 
 * Template part for displaying a message that posts cannot be found
 * 
 * @package mingo
 */

?>

<section class="no-results not-found">
	<header class="no-results-header">
		<h2><?php esc_html_e( 'Nothing Found', 'nebula' ); ?></h2>
	</header>

	<div class="no-results-content">
		<?php
		if ( is_search() ) :
			?>
			
			<p>Oops. It looks like there wasn’t anything found for what you searched for. You can try searching again, or head back to the <a href="<?php echo esc_url( home_url( '/' ) ); ?>">home page</a>.</p>
			<?php

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'nebula' ); ?></p>
			<?php

		endif;
		?>
	</div>
</section>
