<?php
/**
 * Functions
 * 
 * @package mingo
 * Updated Version: 1.0
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Core Theme Functions
2.0 - Post Types
3.0 - Additional Theme Features
4.0 - Functions
--------------------------------------------------------------*/
// Add this to the very top of your functions.php (before anything else)
add_action('all', function($hook) {
    if (strpos($hook, 'load_textdomain') !== false && !did_action('init')) {
        error_log("Early textdomain hook: $hook");
        error_log("Backtrace: " . wp_debug_backtrace_summary());
    }
});

// Also add this to catch translation function calls
if (!function_exists('__')) {
    function __($text, $domain = 'default') {
        if (!did_action('init')) {
            error_log("Early translation call: '$text' in domain '$domain'");
            error_log("Backtrace: " . wp_debug_backtrace_summary());
        }
        return translate($text, $domain);
    }
}

//1.0 - Core Theme Functions
    //Theme Setup (core wp options)
    require get_template_directory() . '/functions/functions-theme-setup.php';

    //ACF Theme Options
    require get_template_directory() . '/functions/functions-acf.php';

    //Enqueued Scripts & Styles
    require get_template_directory() . '/functions/functions-enqueue-scripts.php';

    //Registered Menus
    require get_template_directory() . '/functions/functions-menus.php';

    // Load custom image sizes
    require get_template_directory() . '/functions/functions-image.php';

    //Gutenberg
    require get_template_directory() . '/functions/functions-gutenberg.php';


//2.0 - Post Types
    // Load Post Posttype
    require get_template_directory() . '/functions/posttypes/posttype-post.php';

//3.0 - Taxonomies
    // Load Taxonomies
    require get_template_directory() . '/functions/taxonomies/taxonomies.php';

//4.0 - Additional Theme Features
    //Custom template tags for this theme
    require get_template_directory() . '/functions/tools/tools-template-tags.php';

    // Admin Nav
    require get_template_directory() . '/functions/tools/tools-admin-nav.php';

    // Add Page Count 
    require get_template_directory() . '/functions/tools/tools-page-count.php';

    // Load custom excerpt Lengths. 
    require get_template_directory() . '/functions/tools/tools-custom-excerpt.php'; 
    
    // Links 
    require get_template_directory() . '/functions/tools/tools-links.php'; 
    
    // General Functions
    require get_template_directory() . '/functions/tools/tools-functions.php'; 

    // Widgets
    require get_template_directory() . '/functions/tools/tools-widgets.php'; 

    // Remove Block Directory
    remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );

//5.0 - Functions
    // Login
    require get_template_directory() . '/functions/functions-login.php'; 
    
    // Hooks
    require get_template_directory() . '/functions/functions-hook.php'; 

    function debug_early_translation() {
        if (!did_action('init')) {
            $backtrace = debug_backtrace();
            error_log('Early translation call detected:');
            error_log(print_r($backtrace, true));
        }
    }
    add_filter('load_textdomain_mofile', 'debug_early_translation');