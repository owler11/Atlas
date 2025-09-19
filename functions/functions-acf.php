<?php
/**
 * ACF Settings
 * 
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
TABLE OF CONTENTS: 
1.0 - Theme Options
	1.1 Theme Options
	1.2 Post Options
2.0 - Google Map API Key
3.0 - Custom Blocks
	3.1 - Category
	3.2 - Blocks
4.0 - Custom WYSIWYG Editor
5.0 - JSON File Name
--------------------------------------------------------------*/


//1.0 - Theme Options
add_action('init', function() {
    if( function_exists('acf_add_options_page') ) {
        
        //1.1 Theme Options
        $parent = acf_add_options_page(array(
            'page_title' 	=> 'Theme Options',
            'menu_title' 	=> 'Theme Options',
            'redirect' 		=> false
        ));

        //1.2 Post Options
        acf_add_options_sub_page(array(
            'page_title'    => 'Post Settings',
            'menu_title'    => 'Post Settings',
            'parent_slug'   => 'edit.php',
        )); 
        
        //1.3 Events Options
        acf_add_options_sub_page(array(
            'page_title'    => 'Events Settings',
            'menu_title'    => 'Events Settings',
            'parent_slug'   => 'edit.php?post_type=events',
        )); 
        
        //1.4 People Options
        acf_add_options_sub_page(array(
            'page_title'    => 'People Settings',
            'menu_title'    => 'People Settings',
            'parent_slug'   => 'edit.php?post_type=people',
        )); 
    }
});



//2.0 - Google Map API Key
// function my_acf_init() {    
//     acf_update_setting('google_api_key', 'AIzaSyDSa90Zcwo9gCm-VdhdRWZArgSRcdbaFWE');
// }
// add_action('acf/init', 'my_acf_init');



// 3.0 - Custom Blocks
// 3.1 - Category
add_filter( 'block_categories_all', 'custom_block_category', 10, 2);
function custom_block_category( $categories, $post ) {
    
    array_unshift( $categories, array(
        'slug'	=> 'custom',
        'title' => 'Custom'
    ) );

    return $categories;
}



// 3.2 - Blocks
add_action('acf/init', 'mingo_acf_init_block_types');
function mingo_acf_init_block_types() {

    $svg = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve"><style type="text/css">.st0{fill:#64C4B3;}</style><path class="st0" d="M42.5,6.7H30.2c-0.3,0-0.6,0.2-0.7,0.5L19,31.5c-0.1,0.3,0,0.5,0.3,0.5h6.6l-8.7,20.8c-0.2,0.6,0.5,0.7,0.9,0.2 l23.5-27.3c0.3-0.3,0.2-0.7-0.2-0.7h-6.3l7.7-17.8C43,6.9,42.8,6.7,42.5,6.7z"/></svg>';

    // Check function exists
	// Be sure to connect ACF blocks on admin dashboard
    if( function_exists('acf_register_block_type') ) {

        // register 'hero'
        acf_register_block_type(array(
            'name'              => 'hero',
            'title'             => __('Hero', 'atlas'),
            'description'       => __('Hero builder', 'atlas'),
            'render_template'   => 'template-parts/components/hero-builder.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'hero'),
            'mode'              => 'edit',
            'supports'          => array( 
                'align' => false,
                'mode' => true,
                'multiple' => false
            ),
            'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-hero.png',
					)
				)
			)
        ));
		
		
		
        // register 'heading'
        acf_register_block_type(array(
            'name'              => 'heading',
            'title'             => __('Heading', 'atlas'),
            'description'       => __('Add a heading block.', 'atlas'),
            'render_template'   => 'template-parts/blocks/block-heading.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'heading'),
            'mode'              => 'edit',
            'supports'          => array( 
                'align' 	=> false,
                'mode' 		=> true,
                'multiple' 	=> true,
                'anchor' 	=> true
            ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-heading.png',
					)
				)
			)
        ));
		
        
        // register 'video'
        acf_register_block_type(array(
            'name'              => 'video',
            'title'             => __('Video', 'atlas'),
            'description'       => __('Add a video block.', 'atlas'),
            'render_template'   => 'template-parts/blocks/block-video.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'video'),
            'mode'              => 'edit',
            'supports'          => array( 
                'align' 	=> false,
                'mode' 		=> true,
                'multiple' 	=> true,
                'anchor' 	=> true
            ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-video.png',
					)
				)
			)
        ));

		// register 'wysiwyg'
        acf_register_block_type(array(
            'name'              => 'wysiwyg',
            'title'             => __('Wysiwyg', 'atlas'),
            'description'       => __('Add headline, paragraphs, and lists.', 'atlas'),
            'render_template'   => 'template-parts/blocks/block-wysiwyg.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'wysiwyg'),
            'mode'              => 'edit',
            'supports'          => array( 
                'align' 	=> false,
                'mode' 		=> true,
                'multiple' 	=> true,
                'anchor' 	=> true
            ),
			'example'  => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-wysiwyg.png',
					)
				)
			)
        ));
    }
}


// 4.0 - Custom WYSIWYG Editor
add_filter( 'acf/fields/wysiwyg/toolbars', function ( $toolbars ) {

	$toolbars['Very Basic' ] = array();
    $toolbars['Very Basic' ][1] = array(
        'bold', 
        'italic',
        'link',
        'pastetext',
        'removeformat',
    );

	$toolbars['Ultra Basic' ] = array();
    $toolbars['Ultra Basic' ][1] = array(
        'link',
        'pastetext',
        'removeformat',
    );

	return $toolbars;
} ); 


// 5.0 - JSON File Name
function custom_acf_json_filename( $filename, $post, $load_path ) {
    $filename = str_replace(
        array(
            ' ',
            '_',
        ),
        array(
            '-',
            '-'
        ),
        $post['title']
    );

    $filename = strtolower( $filename ) . '.json';

    return $filename;
}
add_filter( 'acf/json/save_file_name', 'custom_acf_json_filename', 10, 3 );