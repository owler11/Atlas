<?php
/**
 * Functions - Tools Custom Excerpt
 *
 * @package atlas
 *
 * Usage: <?php echo atlas_excerpt(20); ?>
 */


function atlas_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'atlas_excerpt_length', 999 );

function atlas_excerpt($field, $limit) {
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

