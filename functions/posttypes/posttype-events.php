<?php
/**
 * Post Type - Events
 * 
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
TABLE OF CONTENTS: 
1.0 - Register Events
    1.1 - Disable Single View
2.0 - Pre Get Posts
--------------------------------------------------------------*/


// 1.0 - Register Post Type
add_action( 'init', 'events_init', 0 );
function events_init() {
    $labels = array(
        'name'                => _x( 'Event', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Events', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Event:', 'text_domain' ),
        'all_items'           => __( 'All Events', 'text_domain' ),
        'view_item'           => __( 'View Event', 'text_domain' ),
        'add_new_item'        => __( 'Add New Event', 'text_domain' ),
        'add_new'             => __( 'Add New Event', 'text_domain' ),
        'edit_item'           => __( 'Edit Event', 'text_domain' ),
        'update_item'         => __( 'Update Event', 'text_domain' ),
        'search_items'        => __( 'Search Events', 'text_domain' ),
        'not_found'           => __( 'Event Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Event Not found in Trash', 'text_domain' ),
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
        'menu_icon'           => 'dashicons-calendar-alt',
        'can_export'          => true,
        'has_archive'         => true,
        'rewrite' => array(
            'slug' => 'events',
            'with_front' => false,
        ),
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'events', $args );
}


//1.1 - Disable Single View




//2.0 - Pre Get Posts
add_action( 'pre_get_posts', 'events_pre_get_posts' );
function events_pre_get_posts( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'events' ) ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', 'start_date' );
        $query->set( 'order', 'ASC' );
    }
}