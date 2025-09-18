<?php
/**
 * Template Files - Single Posts
 * 
 * @package mingo
 */

get_header(); 

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/' . get_post_type() . '/' . get_post_type(), 'single' );

endwhile; // End of the loop.

get_footer(); ?>

