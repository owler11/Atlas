<?php
/**
 * Template Files - Search Results
 * 
 * @package mingo
 */

?>

<?php get_header(); ?>

<header class="hero search-hero">
	<div class="container search-container">
		<div class="search-headline">
			<?php 
			echo '<p><strong>Search results for:</strong></p>'; 
			?>
			<h1 class="page-title"><?php echo esc_attr(get_search_query()); ?></h1>
		</div>
	</div>
</header>

<section class="wrapper archive-wrapper">
	<div class="container archive-container">
		<div class="grid archive-grid type-list">
			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();

					include( locate_template( 'template-parts/search/search-teaser.php', false, false ) );

				endwhile;

			else :

				get_template_part( 'template-parts/content/content', 'none' );

			endif;
			?>

		</div>

		<?php
		echo '<div class="archive-pagination">';
			echo do_shortcode('[facetwp facet="pagination"]');
			echo do_shortcode('[facetwp facet="results"]');
		echo '</div>';
		?>
	</div>
</section>
	
<?php get_footer(); ?>
