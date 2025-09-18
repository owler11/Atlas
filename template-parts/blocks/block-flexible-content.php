<?php
/**
 * Template Parts - Block - Flexible Content
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Define Block Class
$className = 'flexible-content';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$align          = $fields['alignment'] ?? 'left';
$content        = $fields['content'] ?? '';
$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <div class="<?php echo $className; ?>__grid content-<?php echo $align; ?>">
            <?php 
			// Check value exists.
			if( have_rows('content') ):
                // Loop through rows.
                while ( have_rows('content') ) : the_row();
            
                    // Case: Rich Text.
                    if( get_row_layout() == 'text_content' ):
                        $wysiwyg = get_sub_field('wysiwyg');
                        
                        echo '<div class="flexible-content-block rich-text">'. $wysiwyg .'</div>';
                        
                    // Case: Button
                    elseif( get_row_layout() == 'button' ): 
                        $buttons = get_sub_field('buttons');
                        
                        echo '<div class="btn-group">';

                            foreach($buttons as $button) {
                                $b_link    = $button['link'];
                                $b_type    = $button['type'];
                                if($theme == 'dark') {
                                    $color = ' btn__light';
                                } elseif($theme == 'light') {
                                    $color = ' btn__dark';
                                } else {
                                    $color = '';
                                }
                
                                echo '<a href="'. $b_link['url'] .'" class="btn btn__'. $b_type . $color .'" target="'. $b_link['target'] .'">'. $b_link['title'] .'</a>';
                            }
            
                        echo '</div>';
                                    
                    // Case: Large Image.
                    elseif( get_row_layout() == 'large_image' ): 
                        $image = get_sub_field('image');
                        $link = get_sub_field('link');
                        
                        echo '<figure class="flexible-content-block large-image">';
                        if ($link) {
                            echo '<a href="'. $link['url'] .'" target="'. $link['target'] .'">';
                                echo wp_get_attachment_image($image, 'full', '', array('class' => 'image')); 
                            echo '</a>';
                        } else {
                            echo wp_get_attachment_image($image, 'full', '', array('class' => 'image')); 
                        }
                        echo '</figure>';           
                        
                    // Case: Two Images.
                    elseif( get_row_layout() == 'two_images' ): 
                                
                        echo '<div class="flexible-content-block two-images">';	            
                        
                            if( have_rows('images') ): 
                                while( have_rows('images') ): the_row(); 
                                    $image  = get_sub_field('image');
                                    $link   = get_sub_field('link');
                                    
                                    echo '<figure class="wysiwyg-block">';
                                    if ($link) {
                                        echo '<a href="'. $link['url'] .'" target="'. $link['target'] .'">';
                                            echo wp_get_attachment_image($image, 'full', '', array('class' => 'image')); 
                                        echo '</a>';
                                    } else {
                                        echo wp_get_attachment_image($image, 'full', '', array('class' => 'image')); 
                                    }
                                    echo '</figure>';   
                                    
                                endwhile; 
                            endif; 
            
                        echo '</div>';

                        
                    // Case: Video.
                    elseif( get_row_layout() == 'video_embed' ): 
                        $host    = get_sub_field('video_host');
                        $video   = get_sub_field('video');
                        $caption = get_sub_field('caption');
                        if ( $caption ) {
                            $class = "wp-caption";
                        } else {
                            $class = "no-caption";
                        }
                        
                        echo '<figure class="flexible-content-block video-embed '. $class .'">';
                            echo '<div class="player" data-plyr-provider="'. $host .'" data-plyr-embed-id="'. $video .'"></div>';
                            if ( $caption ) {
                                echo  '<figcaption class="wp-caption-text">'.$caption.'</figcaption>';
                            }
                        echo '</figure>';
            
                    endif;
        
                // End loop.
                endwhile;
			endif; 
		    ?>	
        </div>
    </div>
</section>