<?php
/**
 * Functions - Functions Image
 * 
 * @package atlas
 * Updated Version: 1.0
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Custom Sizes Images
2.0 - Set Featured Image off ACF Field
3.0 - Images
    3.1 - atlas_get_svg
    3.2 - atlas_get_image
4.0 - Allow SVG Uploads
--------------------------------------------------------------*/


//1.0 - Custom Sizes Images
add_image_size('atlas_sm', 400);

// 2.0 - Set Featured Image off ACF Field
add_action('save_post', 'atlas_set_featured_image_on_post_update', 10, 3);
function atlas_set_featured_image_on_post_update($post_id, $post, $update) {
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
        } else {
			// Delete the featured image
			delete_post_thumbnail($post_id);
		}
    }
}


// 3.0 - Images
// 3.1 - atlas_get_svg
function atlas_get_svg($svg) {
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


// 3.2 - atlas_get_image
function atlas_get_image($acf_array, $size = '', $class='') {
	//Get the file extension 
	$ext = pathinfo($acf_array['url'], PATHINFO_EXTENSION);
	if ($ext === 'svg') {
		return atlas_get_svg($acf_array['url']);
	} else {
		return wp_get_attachment_image($acf_array['id'], $size, '', array('class' => $class ));
	}
}


// 4.0 - Allow SVG Uploads
function atlas_allow_svg_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'atlas_allow_svg_uploads');