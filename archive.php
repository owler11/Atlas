<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mingo
 */

$pp_title 				= '';
$pp_title = ($archive_headline) ? $archive_headline : get_the_archive_title();

get_header(); ?>


<header class="hero archive-hero">
	<div class="container archive-container">
		<div class="archive-headline">
			<h1 class="page-title"><?php echo $pp_title; ?></h1>
		</div>
	</div>
</header>

<section class="wrapper archive-wrapper">
	<div class="container archive-container">	
		<div class="grid archive-grid">

			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();

					include( locate_template( 'template-parts/content/' . get_post_type() . '/' . get_post_type() . '-teaser.php', false, false ) );

				endwhile;

			else :

				get_template_part( 'template-parts/content/none' );

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
