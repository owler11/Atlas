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
		'name'                       => _x( 'Events Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Events Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Events Category', 'text_domain' ),
		'all_items'                  => __( 'All Events Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Events Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Events Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Events Category', 'text_domain' ),
		'add_new_item'               => __( 'Add Events Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Events Category', 'text_domain' ),
		'update_item'                => __( 'Update Events Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'text_domain' ),
		'search_items'               => __( 'Search Events Categories', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Events Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used Events Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
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
