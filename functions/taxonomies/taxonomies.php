<?php
/**
 * Custom Taxonomies
 *
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Events Category 
--------------------------------------------------------------*/

//1.0 - Events Category	
add_action( 'init', 'events_cat', 0 );
function events_cat() {
	$labels = array(
		'name'                       => _x( 'Events Categories', 'Taxonomy General Name', 'atlas' ),
		'singular_name'              => _x( 'Events Category', 'Taxonomy Singular Name', 'atlas' ),
		'menu_name'                  => __( 'Events Category', 'atlas' ),
		'all_items'                  => __( 'All Events Categories', 'atlas' ),
		'parent_item'                => __( 'Parent Events Category', 'atlas' ),
		'parent_item_colon'          => __( 'Events Category:', 'atlas' ),
		'new_item_name'              => __( 'New Events Category', 'atlas' ),
		'add_new_item'               => __( 'Add Events Category', 'atlas' ),
		'edit_item'                  => __( 'Edit Events Category', 'atlas' ),
		'update_item'                => __( 'Update Events Category', 'atlas' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'atlas' ),
		'search_items'               => __( 'Search Events Categories', 'atlas' ),
		'add_or_remove_items'        => __( 'Add or remove Events Categories', 'atlas' ),
		'choose_from_most_used'      => __( 'Choose from the most used Events Categories', 'atlas' ),
		'not_found'                  => __( 'Not Found', 'atlas' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_in_rest' 				 => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'events-category', array( 'events' ), $args );
}   
