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
            'title'             => __('Hero'),
            'description'       => __('Hero builder'),
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
		
		// register 'accordion'
        acf_register_block_type(array(
            'name'              => 'accordion',
            'title'             => __('Accordion'),
            'description'       => __('Add an accordion.'),
            'render_template'   => 'template-parts/blocks/block-accordion.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'accordion'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-accordion.png',
					)
				)
			)
        ));

		// register 'bento grid'
        acf_register_block_type(array(
            'name'              => 'bento_grid',
            'title'             => __('Bento Grid'),
            'description'       => __('Add content in a bento grid style.'),
            'render_template'   => 'template-parts/blocks/block-bento-grid.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'bento', 'grid'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-bento-grid.png',
					)
				)
			)
        ));

		// register 'call to action'
        acf_register_block_type(array(
            'name'              => 'call_to_action',
            'title'             => __('Call to Action'),
            'description'       => __('Add a call to action.'),
            'render_template'   => 'template-parts/blocks/block-call-to-action.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'cta', 'call to action'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-call-to-action.png',
					)
				)
			)
        ));

		// register 'callout image'
        acf_register_block_type(array(
            'name'              => 'callout_image',
            'title'             => __('Callout Image'),
            'description'       => __('Add an image with a content block next to it.'),
            'render_template'   => 'template-parts/blocks/block-callout-image.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'image', 'content'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-callout-image.png',
					)
				)
			)
        ));

		// register 'flexible content'
        acf_register_block_type(array(
            'name'              => 'flexible_content',
            'title'             => __('Flexible Content'),
            'description'       => __('Add a flexible content.'),
            'render_template'   => 'template-parts/blocks/block-flexible-content.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'content', 'flexible'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-flexible-content.png',
					)
				)
			)
        ));

		// register 'form'
        acf_register_block_type(array(
            'name'              => 'form',
            'title'             => __('Form'),
            'description'       => __('Add a form.'),
            'render_template'   => 'template-parts/blocks/block-form.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'form'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-form.png',
					)
				)
			)
        ));

		// register 'full width media'
        acf_register_block_type(array(
            'name'              => 'full_width_media',
            'title'             => __('Full Width Media'),
            'description'       => __('Add a full width media with options.'),
            'render_template'   => 'template-parts/blocks/block-full-width-media.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'media', 'full-width'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-full-width-media.png',
					)
				)
			)
        ));

		// register 'grid cards'
        acf_register_block_type(array(
            'name'              => 'grid_cards',
            'title'             => __('Grid Cards'),
            'description'       => __('Add a grid of cards.'),
            'render_template'   => 'template-parts/blocks/block-grid-cards.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'grid', 'cards'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-grid-cards.png',
					)
				)
			)
        ));

		// register 'grid icon'
        acf_register_block_type(array(
            'name'              => 'grid_icon',
            'title'             => __('Grid Icon'),
            'description'       => __('Add a grid of content with the option of icons or images.'),
            'render_template'   => 'template-parts/blocks/block-grid-icon.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'grid', 'icon'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-grid-icon.png',
					)
				)
			)
        ));
		
        // register 'heading'
        acf_register_block_type(array(
            'name'              => 'heading',
            'title'             => __('Heading'),
            'description'       => __('Add a heading block.'),
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
		
        // register 'list'
        acf_register_block_type(array(
            'name'              => 'list',
            'title'             => __('List'),
            'description'       => __('Add a list of content with the option of of links.'),
            'render_template'   => 'template-parts/blocks/block-list.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'list', 'links'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-list.png',
					)
				)
			)
        ));
        
        // register 'people'
        acf_register_block_type(array(
            'name'              => 'people',
            'title'             => __('People'),
            'description'       => __('Add a block to pull in people from the post type.'),
            'render_template'   => 'template-parts/blocks/block-people.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'people', 'post type'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-people.png',
					)
				)
			)
        ));
        
        // register 'pricing'
        acf_register_block_type(array(
            'name'              => 'pricing',
            'title'             => __('Pricing'),
            'description'       => __('Add a pricing block.'),
            'render_template'   => 'template-parts/blocks/block-pricing.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'pricing'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-pricing.png',
					)
				)
			)
        ));
        
        // register 'pullquote'
        acf_register_block_type(array(
            'name'              => 'pullquote',
            'title'             => __('Pullquote'),
            'description'       => __('Add a pullquote block.'),
            'render_template'   => 'template-parts/blocks/block-pullquote.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'pullquote'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-pullquote.png',
					)
				)
			)
        ));
        
        // register 'quote'
        acf_register_block_type(array(
            'name'              => 'quote',
            'title'             => __('Quote'),
            'description'       => __('Add a quote block.'),
            'render_template'   => 'template-parts/blocks/block-quote.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'quote'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-quote.png',
					)
				)
			)
        ));
        
        // register 'related-content'
        acf_register_block_type(array(
            'name'              => 'related_content',
            'title'             => __('Related Content'),
            'description'       => __('Add a related content block to pull in posts from post types.'),
            'render_template'   => 'template-parts/blocks/block-related-content.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'related content'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-related-content.png',
					)
				)
			)
        ));
        
        // register 'slider card'
        acf_register_block_type(array(
            'name'              => 'slider_card',
            'title'             => __('Slider Card'),
            'description'       => __('Add a slider of cards.'),
            'render_template'   => 'template-parts/blocks/block-slider-card.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'slider', 'card'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-slider-card.png',
					)
				)
			)
        ));
        
        // register 'slider logo'
        acf_register_block_type(array(
            'name'              => 'slider_logo',
            'title'             => __('Slider Logo'),
            'description'       => __('Add a slider of logos.'),
            'render_template'   => 'template-parts/blocks/block-slider-logo.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'slider', 'logo'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-slider-logo.png',
					)
				)
			)
        ));
        
        // register 'stats'
        acf_register_block_type(array(
            'name'              => 'stats',
            'title'             => __('Stats'),
            'description'       => __('Add a stats block.'),
            'render_template'   => 'template-parts/blocks/block-stats.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'stats'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-stats.png',
					)
				)
			)
        ));
        
        // register 'tab content'
        acf_register_block_type(array(
            'name'              => 'tab_content',
            'title'             => __('Tab Content'),
            'description'       => __('Add a tab system with content pieces.'),
            'render_template'   => 'template-parts/blocks/block-tab-content.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'tab', 'content'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-tab-content.png',
					)
				)
			)
        ));
        
        // register 'tab image'
        acf_register_block_type(array(
            'name'              => 'tab_image',
            'title'             => __('Tab Image'),
            'description'       => __('Add a tab system with image pieces.'),
            'render_template'   => 'template-parts/blocks/block-tab-image.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'tab', 'image'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-tab-image.png',
					)
				)
			)
        ));
        
        // register 'testimonials'
        acf_register_block_type(array(
            'name'              => 'testimonials',
            'title'             => __('Testimonials'),
            'description'       => __('Add a testimonials block.'),
            'render_template'   => 'template-parts/blocks/block-testimonials.php',
            'category'          => 'custom',
            'icon'              => $svg,
            'keywords'          => array( 'custom', 'testimonials'),
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
						'preview_image_help' => get_template_directory_uri().'/assets/public/images/screenshots/block-testimonial.png',
					)
				)
			)
        ));
        
        // register 'video'
        acf_register_block_type(array(
            'name'              => 'video',
            'title'             => __('Video'),
            'description'       => __('Add a video block.'),
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
            'title'             => __('Wysiwyg'),
            'description'       => __('Add headline, paragraphs, and lists.'),
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

        /**
         * =============================================
         * NEW BLOCKS ADDED BY THE SCRIPT WILL APPEAR HERE
         * Do not remove this comment block
         * =============================================
         */


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