<?php
/**
 * Functions - Login
 *
 * @package mingo
 * Updated Version: 1.0
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Login CSS
--------------------------------------------------------------*/

//1.0 - Login CSS
// Calling your own login css so you can style it
function custom_login_css() {
	wp_enqueue_style( 'custom_login_css', get_template_directory_uri() . '/assets/public/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function custom_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function custom_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'custom_login_css', 10 );
add_filter( 'login_headerurl', 'custom_login_url');
add_filter( 'login_headertext', 'custom_login_title');