<?php
/**
 * Functions - Tools Numbered Pagination
 *
 * @package mingo
 */
 
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Page Count
--------------------------------------------------------------*/


//1.0 - Page Count
function the_posts_count() {  
	global $wp_query;
	$postCount = $GLOBALS['wp_query']->post_count; // Posts in query
	$pageCount = (get_query_var('paged')) ? get_query_var('paged') : 1; // The page you're on
	$posts_per_page = $GLOBALS['wp_query']->query_vars['posts_per_page']; // Posts per page
	$count_posts = wp_count_posts(); // Total posts
	$published_posts = $count_posts->publish; // Total published posts
	
	$firstPost = $pageCount * $posts_per_page - ($posts_per_page - 1);
	$lastPost = $pageCount * $posts_per_page - ($posts_per_page - $postCount);
	
	if ( is_search() ) {
		global $wp_query;
		$found_posts  = $wp_query->found_posts;
		$pageCount = "<p class='page-count'>Showing ".$firstPost . " - ". $lastPost . ' of ' . $found_posts . '</p>';
		echo $pageCount;		
	} else {
		$found_posts  = $wp_query->found_posts;
		$pageCount = "<p class='page-count'>Showing ".$firstPost . " - ". $lastPost . ' of ' . $found_posts . '</p>';
		echo $pageCount;
	}
}
