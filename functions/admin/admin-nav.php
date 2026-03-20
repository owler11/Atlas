<?php
/**
 * Functions - Functions Admin Nav
 *
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Menu Order
2.0 - Disable Menu Items
3.0 - Remove Items from Menu Nav Bar
    3.1- Disable File Editor
--------------------------------------------------------------*/


//1.0 - Menu Order
function wpse_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        'index.php', // Dashboard
        
        'separator1',                   // First separator
        
        'edit.php?post_type=page',      // Pages
        'edit.php',                     // Posts
        'edit.php?post_type=events',    // Events
        'edit.php?post_type=people',    // People
        'edit.php?post_type=testimonials',    // Testimonials
        'upload.php',                   // Media
      
        'separator2',                   // Second separator
        
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        
        'separator-last', // Last separator
    );
}
add_filter( 'custom_menu_order', 'wpse_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'wpse_custom_menu_order', 10, 1 );



//2.0 - Disable Menu Items	
add_action( 'admin_menu', 'mingo_remove_menu_pages' );
function mingo_remove_menu_pages() {
	global $current_user;
	
	remove_menu_page('edit-comments.php');
	remove_menu_page('link-manager.php');
	remove_submenu_page('themes.php','theme-editor.php');
	remove_submenu_page('themes.php','widgets.php');

    $admins = array(1, 2, 3, 4, 5, 6, 7, 8);
    if ( in_array($current_user->ID, $admins) ) {
		// If User ID is 1 to 7, do nothing
	} else {
		// define('DISALLOW_FILE_MODS',true);
	  	remove_menu_page('edit.php?post_type=acf-field-group');
	  	remove_submenu_page('themes.php','themes.php');
	}
}


//3.0 - Remove Items from Menu Nav Bar
add_action( 'admin_bar_menu', 'mingo_remove_nodes', 999 );
function mingo_remove_nodes( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'new-content' );
	$wp_admin_bar->remove_node( 'comments' );
	$wp_admin_bar->remove_node( 'customize' );
}

//3.1- Disable File Editor
define( 'DISALLOW_FILE_EDIT', true );
