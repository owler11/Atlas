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
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Testimonials', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Testimonials', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Testimonial:', 'text_domain' ),
        'all_items'           => __( 'All Testimonials', 'text_domain' ),
        'view_item'           => __( 'View Testimonial', 'text_domain' ),
        'add_new_item'        => __( 'Add New Testimonial', 'text_domain' ),
        'add_new'             => __( 'Add New Testimonial', 'text_domain' ),
        'edit_item'           => __( 'Edit Testimonial', 'text_domain' ),
        'update_item'         => __( 'Update Testimonial', 'text_domain' ),
        'search_items'        => __( 'Search Testimonials', 'text_domain' ),
        'not_found'           => __( 'Testimonial Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Testimonial Not found in Trash', 'text_domain' ),
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