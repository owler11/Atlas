<?php
/**
 * Functions
 * 
 * @package atlas
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


//1.0 - Core Theme Functions
    //Theme Setup (core wp options)
    require get_template_directory() . '/functions/core/theme-setup.php';

    //ACF Theme Options
    require get_template_directory() . '/functions/integrations/acf.php';

    //Enqueued Scripts & Styles
    require get_template_directory() . '/functions/core/enqueue-scripts.php';

    // ACF menu renderers
    require get_template_directory() . '/functions/content/menus.php';

    // Load custom image sizes
    require get_template_directory() . '/functions/core/image-support.php';

    //Gutenberg
    require get_template_directory() . '/functions/integrations/gutenberg.php';


//2.0 - Post Types
    // Load Post Posttype
    require get_template_directory() . '/functions/posttypes/posttype-post.php';

//3.0 - Additional Theme Features
    //Custom template tags for this theme
    require get_template_directory() . '/functions/content/template-tags.php';

    // Admin Nav
    require get_template_directory() . '/functions/admin/admin-nav.php';

    // Load custom excerpt Lengths. 
    require get_template_directory() . '/functions/content/excerpt-tools.php'; 
    
    // Links 
    require get_template_directory() . '/functions/content/links.php'; 

    // Widgets
    require get_template_directory() . '/functions/admin/widgets.php'; 

    // Remove Block Directory
    remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );

//5.0 - Functions
    // Login
    require get_template_directory() . '/functions/admin/login.php';
