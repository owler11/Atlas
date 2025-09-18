<?php
/**
 * Post Type - Post (News)
 * 
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
TABLE OF CONTENTS: 
1.0 - Change Name
2.0 - Disable Default Features
3.0 - Set Featured Image off ACF Field
4.0 - Pre Get Posts
--------------------------------------------------------------*/



//1.0 - Change Name
// add_action( 'init', 'cp_change_post_object' );
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name               = 'News';
        $labels->singular_name      = 'News';
        $labels->add_new            = 'Add News';
        $labels->add_new_item       = 'Add News';
        $labels->edit_item          = 'Edit News';
        $labels->new_item           = 'News';
        $labels->view_item          = 'View News';
        $labels->search_items       = 'Search News';
        $labels->not_found          = 'No News found';
        $labels->not_found_in_trash = 'No News found in Trash';
        $labels->all_items          = 'All News';
        $labels->menu_name          = 'News';
        $labels->name_admin_bar     = 'News';
}


// 2.0 - Disable Default Features
add_filter('admin_init', 'disable_default_features');
function disable_default_features() {
    remove_post_type_support( 'post', 'thumbnail' );
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'post', 'trackbacks' );
    
    remove_post_type_support( 'page', 'comments' );
}


// 3.0 - Pre Get Posts