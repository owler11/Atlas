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
        'name'                => _x( 'People', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'People', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'People', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent People:', 'text_domain' ),
        'all_items'           => __( 'All People', 'text_domain' ),
        'view_item'           => __( 'View People', 'text_domain' ),
        'add_new_item'        => __( 'Add New People', 'text_domain' ),
        'add_new'             => __( 'Add New People', 'text_domain' ),
        'edit_item'           => __( 'Edit People', 'text_domain' ),
        'update_item'         => __( 'Update People', 'text_domain' ),
        'search_items'        => __( 'Search People', 'text_domain' ),
        'not_found'           => __( 'People Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'People Not found in Trash', 'text_domain' ),
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