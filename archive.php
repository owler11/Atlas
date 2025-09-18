<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mingo
 */

$archive_headline 		= '';
$archive_category		= '';
$archive_date			= '';
$archive_tag			= '';
$archive_search			= '';
$archive_featured		= '';
$pp_title 				= '';
$post_type 				= get_post_type();
if(get_post_type() == 'events') {
	$archive_headline 	= get_field('event_archive_headline', 'option');
	$archive_category	= get_field('event_category', 'option');
	// $archive_tag		= get_field('event_tag', 'option');
	$archive_search		= get_field('event_search', 'option');
	$archive_featured	= get_field('event_featured_posts', 'option');
	$archive_date		= get_field('event_date', 'option');
} elseif(get_post_type() == 'people') {
	$archive_headline 	= get_field('people_archive_headline', 'option');
	$archive_search		= get_field('people_search', 'option');
}

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
		<?php
		if($archive_featured) :
		?>
		<div class="archive-featured">
			<?php
			foreach($archive_featured as $post) :
				setup_postdata($post);
				$id = get_the_ID();
				set_query_var('id', $id);
    			get_template_part('template-parts/' . get_post_type($id) . '/' . get_post_type($id) . '-teaser-card');
			endforeach;
			wp_reset_postdata();
			?>
		</div>
		<?php
		endif;
		?>

		<?php
		if($archive_search || $archive_tag || $archive_category || $archive_date) :
		?>
		<div class="archive-facets">
			<?php
			if($archive_date) :
				echo do_shortcode('[facetwp facet="event_date"]');
			endif;

			if($archive_category) :
				if(get_post_type() == 'events') :
					echo do_shortcode('[facetwp facet="event_category"]');
				else :
					echo do_shortcode('[facetwp facet="posts_category"]');
				endif;
			endif;

			if($archive_tag) :
				echo do_shortcode('[facetwp facet="posts_tag"]');
			endif;

			if($archive_search) :
				echo do_shortcode('[facetwp facet="search"]');
			endif;
			?>
		</div>
		<?php
		endif;
		?>

		<div class="grid archive-grid <?php echo $post_type; ?>-grid">

			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();

					include( locate_template( 'template-parts/' . get_post_type() . '/' . get_post_type() . '-teaser.php', false, false ) );

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
