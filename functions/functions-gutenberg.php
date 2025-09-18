<?php
/**
 * Functions - Functions Gutenberg
 * 
 * @package mingo
 * Updated Version: 1.0
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Disable Gutenberg by Template
	1.1 - Define Templates or IDs
	1.2 - Disable Gutenberg
2.0 - Disable Gutenburg Site-wide
3.0 - Enable/Disable Blocks
4.0 - Render Blocks
--------------------------------------------------------------*/


//1.0 - Disable Gutenberg by Content Type
	//1.1 - Define Templates, Page Types or Post Types
	function ea_disable_editor( $id = false ) {

		$excluded_templates = array(
			//'page-landing.php',
			
		);

		$excluded_ids = array(
			// get_option( 'page_on_front' )
		);

		if( empty( $id ) )
			return false;

		$id = intval( $id );
		$template = get_page_template_slug( $id );

		return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
	}

	//1.2 - Disable Gutenberg
	function ea_disable_gutenberg( $can_edit, $post_type ) {

		if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
			return $can_edit;

		if( ea_disable_editor( $_GET['post'] ) )
			$can_edit = false;

		return $can_edit;

	}
	//add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
	//add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );



//2.0 - Disable Gutenburg Site-wide
//add_filter('use_block_editor_for_post_type', '__return_false');


//3.0 - Enable/Disable Blocks
add_filter( 'allowed_block_types_all', 'mingo_allowed_block_types', 10, 2 );
function mingo_allowed_block_types( $allowed_blocks, $context ) {
 
	$allowed_blocks = array(
		'core/paragraph',
		// 'core/image',
    	// 'core/heading',
    	// 'core/gallery',
    	// 'core/list',
    	// 'core/list-item',
    	// 'core/quote',
    	// 'core/audio',
    	// 'core/cover',
    	// 'core/file',
    	// 'core/video',
    	// 'core/table',

    	//Formatting
    	// 'core/pullquote',

		//Design 
		// 'core/buttons',
		// 'core/nextpage',
		// 'core/separator',
		// 'core/spacer',

		//Widgets
		// 'core/shortcode',
		// 'core/html',

		//Embeds
		//'core/embed',
	);
 
	// Make sure to register custom block in functions-acf.php
	if( $context->post->post_type == 'page' ) {

		/**
         * =============================================
         * NEW BLOCKS ADDED BY THE SCRIPT WILL APPEAR HERE
         * Do not remove this comment block
         * =============================================
         */


		$allowed_blocks[] = 'acf/hero';

		$allowed_blocks[] = 'acf/accordion';
		$allowed_blocks[] = 'acf/bento-grid';
		$allowed_blocks[] = 'acf/call-to-action';
		$allowed_blocks[] = 'acf/callout-image';
		$allowed_blocks[] = 'acf/flexible-content';
		$allowed_blocks[] = 'acf/form';
		$allowed_blocks[] = 'acf/full-width-media';
		$allowed_blocks[] = 'acf/grid-cards';
		$allowed_blocks[] = 'acf/grid-icon';
		$allowed_blocks[] = 'acf/heading';
		$allowed_blocks[] = 'acf/list';
		$allowed_blocks[] = 'acf/people';
		$allowed_blocks[] = 'acf/pricing';
		$allowed_blocks[] = 'acf/pullquote';
		$allowed_blocks[] = 'acf/quote';
		$allowed_blocks[] = 'acf/related-content';
		$allowed_blocks[] = 'acf/slider-card';
		$allowed_blocks[] = 'acf/slider-logo';
		$allowed_blocks[] = 'acf/stats';
		$allowed_blocks[] = 'acf/tab-content';
		$allowed_blocks[] = 'acf/tab-image';
		$allowed_blocks[] = 'acf/testimonials';
		$allowed_blocks[] = 'acf/video';
		$allowed_blocks[] = 'acf/wysiwyg';
	}
 
	if( $context->post->post_type == 'post' || $context->post->post_type == 'events' || $context->post->post_type == 'people' ) {
		// Specific for 'post'
		$allowed_blocks[] = 'acf/accordion';
		$allowed_blocks[] = 'acf/bento-grid';
		$allowed_blocks[] = 'acf/call-to-action';
		$allowed_blocks[] = 'acf/callout-image';
		$allowed_blocks[] = 'acf/flexible-content';
		$allowed_blocks[] = 'acf/form';
		$allowed_blocks[] = 'acf/full-width-media';
		$allowed_blocks[] = 'acf/grid-cards';
		$allowed_blocks[] = 'acf/grid-icon';
		$allowed_blocks[] = 'acf/heading';
		$allowed_blocks[] = 'acf/list';
		$allowed_blocks[] = 'acf/people';
		$allowed_blocks[] = 'acf/pricing';
		$allowed_blocks[] = 'acf/pullquote';
		$allowed_blocks[] = 'acf/quote';
		$allowed_blocks[] = 'acf/related-content';
		$allowed_blocks[] = 'acf/slider-card';
		$allowed_blocks[] = 'acf/slider-logo';
		$allowed_blocks[] = 'acf/stats';
		$allowed_blocks[] = 'acf/tab-content';
		$allowed_blocks[] = 'acf/tab-image';
		$allowed_blocks[] = 'acf/testimonials';
		$allowed_blocks[] = 'acf/video';
		$allowed_blocks[] = 'acf/wysiwyg';
	}

	return $allowed_blocks;
}





//4.0 - Render Blocks
add_filter( 'render_block', function ( $block_content, $block ) {
	$blocks = [
		'paragraph',
		// 'image',
		// 'heading',
		// 'gallery',
		// 'list',
		// 'quote',
		// 'table',
		// 'separator',
		// 'spacer',
		// 'shortcode',
		// 'html'
	];
	foreach($blocks as $b) {
		if ( 'core/' . $b === $block['blockName'] && !isset($block['attrs']['hasParent']) ) {
			$block_content = '<section class="wrapper gutenberg-wrapper"><div class="container default-block-container"><div class="content">' . $block_content . '</div></div></section>';
		}
	}
	return $block_content;
}, 10, 2 );

add_filter('render_block_data', 'block_data_pre_render', 10, 2);
function block_data_pre_render($parsed_block, $source_block) {
    $core_blocks = [
        'core/group',
        'core/columns',
        'core/gallery',
		'core/quote',
    ];

    if (
        in_array($source_block['blockName'], $core_blocks, true) &&
        !is_admin() &&
        !wp_is_json_request()
    ) {
        $parsed_block['attrs']['hasChild'] = 1;
        array_walk($parsed_block['innerBlocks'], 'inner_block_looper');
    }

    return $parsed_block;
}

function inner_block_looper(&$itm, $key) {
    if ($key === 'attrs') {
        $itm['hasParent'] = 1;
    }
    if (is_array($itm)) {
        array_walk($itm, 'inner_block_looper');
    }
}



//5.0 - Block Templates
function page_header_block_template() {
    $post_type_object = get_post_type_object( 'page' );
    $post_type_object->template = array(
	    array( 'acf/hero', array(
	        'lock' => array(
		        'remove' => true,
	            'move'   => true,
	        ),
	    ) ),     
    );
}
add_action( 'init', 'page_header_block_template' );