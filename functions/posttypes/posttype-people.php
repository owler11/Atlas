<?php
/**
 * Post Type - People
 * 
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
TABLE OF CONTENTS: 
1.0 - Register People
    1.1 - Disable Single View
2.0 - Pre Get Posts
--------------------------------------------------------------*/


// 1.0 - Register Post Type
add_action( 'init', 'people_init', 0 );
function people_init() {
    $labels = array(
        'name'                => _x( 'People', 'Post Type General Name', 'atlas' ),
        'singular_name'       => _x( 'People', 'Post Type Singular Name', 'atlas' ),
        'menu_name'           => __( 'People', 'atlas' ),
        'parent_item_colon'   => __( 'Parent People:', 'atlas' ),
        'all_items'           => __( 'All People', 'atlas' ),
        'view_item'           => __( 'View People', 'atlas' ),
        'add_new_item'        => __( 'Add New People', 'atlas' ),
        'add_new'             => __( 'Add New People', 'atlas' ),
        'edit_item'           => __( 'Edit People', 'atlas' ),
        'update_item'         => __( 'Update People', 'atlas' ),
        'search_items'        => __( 'Search People', 'atlas' ),
        'not_found'           => __( 'People Not found', 'atlas' ),
        'not_found_in_trash'  => __( 'People Not found in Trash', 'atlas' ),
    );
    $args = array(
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor' ),
        'taxonomies'          => array( ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-businessperson',
        'can_export'          => true,
        'has_archive'         => true,
        'rewrite' => array(
            'slug' => 'people',
            'with_front' => false,
        ),
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'people', $args );
}


//1.1 - Disable Single View




//2.0 - Pre Get Posts