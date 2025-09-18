<?php
/**
 * Functions - Tools Custom Excerpt
 * 
 * @package mingo
 * 
 * Usage: <?php echo excerpt(20); ?>
 */

 
function custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function excerpt($field, $limit) {
	if (!$field) {
		$field = get_the_excerpt();
	}
	$excerpt = explode(' ', $field, $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

