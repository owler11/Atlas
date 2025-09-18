<?php
/**
 * Functions - Functions Image
 * 
 * @package mingo
 * Updated Version: 1.0
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Custom Sizes Images
2.0 - Set Featured Image off ACF Field
3.0 - Images
    3.1 - getSVG
    3.2 - getImage
4.0 - Allow SVG Uploads
--------------------------------------------------------------*/


//1.0 - Custom Sizes Images
// Custom
add_image_size('atlas_sm', 400); 
add_image_size('atlas_md', 800); 
add_image_size('atlas_lg', 1200);
add_image_size('atlas_xl', 1800);


// 2.0 - Set Featured Image off ACF Field
add_action('save_post', 'set_featured_image_on_post_update', 10, 3);
function set_featured_image_on_post_update($post_id, $post, $update) {
    // Check if this is an autosave or a revision
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check if the post is being updated
    if ($update) {
      
	    // Get the ACF image field value
        $image_id = get_field('featured_image', $post_id);

        // Check if the image id is not empty
        if (!empty($image_id)) {

            // Set ACF image as featured image
            set_post_thumbnail($post_id, $image_id);
        }
    }
}


// 3.0 - Images
// 3.1 - getSVG
function getSVG($svg) {
	$url =  get_bloginfo('url');
	if (strpos($url,'.local') !== false) {
		$arrContextOptions=array(
		    "ssl"=>array(
		        "verify_peer"=>false,
		        "verify_peer_name"=>false,
		    ),
		);  	
		$response = file_get_contents($svg, false, stream_context_create($arrContextOptions));
		return $response;
		
	} else {
		$response = file_get_contents($svg);
		return $response;
	}
}


// 3.2 - getImage
function getImage($acf_array, $size = '', $class='') {
	//Get the file extension 
	$ext = pathinfo($acf_array['url'], PATHINFO_EXTENSION);
	if ($ext === 'svg') {
		return getSVG($acf_array['url']);
	} else {
		return wp_get_attachment_image($acf_array['id'], $size, '', array('class' => $class ));
	}
}


// 4.0 - Allow SVG Uploads
function mingo_allow_svg_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'mingo_allow_svg_uploads');