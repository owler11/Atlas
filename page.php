<?php
/**
 * Template Files - Default Page
 * 
 * @package mingo
 */

get_header(); 

while ( have_posts() ) :
	the_post();

	the_content();

endwhile; // End of the loop.
?>

<?php get_footer(); ?>
