<?php
/**
 * Functions - Functions Theme Setup
 * 
 * @package atlas
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Theme Support 
	1.1 - Registered html 5 Elements
	1.2 - Registered Post-Formats
2.0 - Hide Customizer	 
3.0 - Disable JSON API
4.0 - Editor Block Formats
5.0 - Hide Editor
6.0 - Header Inject Tracking Code
7.0 - Backend
--------------------------------------------------------------*/



//1.0 - Theme Support
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

// Load text domain on init action as required by WordPress 6.7.0+
function atlas_load_textdomain() {
	load_theme_textdomain( 'atlas', get_template_directory() . '/languages' );
}
add_action( 'init', 'atlas_load_textdomain' );

if ( ! function_exists( 'atlas_setup' ) ) :
	function atlas_setup() {
		
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		
		// 1.1 - Registered html 5 Elements
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'atlas_setup' );


//2.0 - Hide Customizer	 
function atlas_remove_customize_page(){
	global $submenu;
	unset($submenu['themes.php'][6]); // remove Customizer link
}
add_action( 'admin_menu', 'atlas_remove_customize_page');


//3.0 - Disable JSON API
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );


//4.0 - Editor Block Formats
function atlas_mce_formats( $init ) {
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

    return $init;
}
add_filter('tiny_mce_before_init', 'atlas_mce_formats');


//5.0 - Hide Editor
add_action( 'admin_head', 'hide_editor' );
function hide_editor() {
    remove_post_type_support('page', 'editor');
}

function remove_meta_boxes() {
        remove_meta_box('postimagediv', 'post', 'side');
}
add_action('admin_head','remove_meta_boxes');


// 6.0 - Inject Tracking Code
function header_inject_tracking_code() {
	// Global Tracking Code
	$tc_header = get_field('tc_header', 'option');
	if ($tc_header) {
		echo $tc_header;
	}
}
add_action('wp_head', 'header_inject_tracking_code');

function footer_inject_tracking_code() {
	// Global Tracking Code
	$tc_footer = get_field('tc_footer', 'option');
	if ($tc_footer) {
		echo $tc_footer;
	}
}
add_action('wp_footer', 'footer_inject_tracking_code');

function body_inject_tracking_code() {
	// Global Tracking Code
	$tc_body = get_field('tc_body', 'option');
	if ($tc_body) {
		echo $tc_body;
	}
}
add_action('wp_body_open', 'body_inject_tracking_code');

// Check for ACF Pro
function atlas_check_acf_pro() {
    if (!class_exists('ACF')) {
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p><?php _e('Atlas theme requires Advanced Custom Fields Pro plugin to be installed and activated.', 'atlas'); ?></p>
            </div>
            <?php
        });
    }
}
add_action('wp_loaded', 'atlas_check_acf_pro');
