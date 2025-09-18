<?php
/**
 * Template Files - 404
 * 
 * Template for displaying Error 404 page
 * 
 * @package mingo
 */


get_header();
?>

<section class="wrapper hero__error">
	<div class="container hero-error__container">
		<header class="hero-error__headline"> 
			<h1>404 Error</h1>
	
			<div class="entry-content">
				<h5 class="entry-title">Sorry, this page isn't available</h5>
				<p>The link you followed may be broken, or the page may have been removed.</p>
				<a class="button" href="<?php bloginfo('url'); ?>"> Back to Home</a>
			</div>
		</header>
	</div>
</section>

<?php get_footer(); ?>
