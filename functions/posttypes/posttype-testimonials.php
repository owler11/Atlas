<?php
/**
 * Post Type - Testimonials
 * 
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
TABLE OF CONTENTS: 
1.0 - Register Testimonials
    1.1 - Disable Single View
2.0 - Pre Get Posts
--------------------------------------------------------------*/


// 1.0 - Register Post Type
add_action( 'init', 'testimonials_init', 0 );
function testimonials_init() {
    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'atlas' ),
        'singular_name'       => _x( 'Testimonials', 'Post Type Singular Name', 'atlas' ),
        'menu_name'           => __( 'Testimonials', 'atlas' ),
        'parent_item_colon'   => __( 'Parent Testimonial:', 'atlas' ),
        'all_items'           => __( 'All Testimonials', 'atlas' ),
        'view_item'           => __( 'View Testimonial', 'atlas' ),
        'add_new_item'        => __( 'Add New Testimonial', 'atlas' ),
        'add_new'             => __( 'Add New Testimonial', 'atlas' ),
        'edit_item'           => __( 'Edit Testimonial', 'atlas' ),
        'update_item'         => __( 'Update Testimonial', 'atlas' ),
        'search_items'        => __( 'Search Testimonials', 'atlas' ),
        'not_found'           => __( 'Testimonial Not found', 'atlas' ),
        'not_found_in_trash'  => __( 'Testimonial Not found in Trash', 'atlas' ),
    );
    $args = array(
        'labels'              => $labels,
        'supports'            => array( 'title' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-format-quote',
        'can_export'          => true,
        'has_archive'         => false,
        'rewrite' => array(
            'slug' => 'testimonials',
            'with_front' => false,
        ),
        'exclude_from_search' => false,
        'publicly_queryable'  => false, // Turn off single page view
        'capability_type'     => 'post',
    );
    register_post_type( 'testimonials', $args );
}


//1.1 - Disable Single View




//2.0 - Pre Get Posts