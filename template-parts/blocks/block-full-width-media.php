<?php
/**
 * Template Parts - Block - Full Width Media
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'full-width-media';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields             = get_fields();
$title              = $fields['title'] ?? '';
$headline           = $fields['headline'] ?? '';
$content            = $fields['content'] ?? '';
$buttons            = $fields['buttons'] ?? '';

$has_content        = ($title || $headline || $content || $buttons) ? true : false;

$crop_media         = $fields['crop_media'] ?? false;
$contain_media      = $fields['contain_media'] ?? false;
$background_image   = $fields['image'] ?? '';
$background_image_url = wp_get_attachment_url($background_image);
$video_mp4          = $fields['video_mp4'] ?? '';
$background_overlay = $fields['background_overlay'] ?? 0;
$padding_top        = $fields['padding_top'] ?? 'medium';
$padding_bottom     = $fields['padding_bottom'] ?? 'medium';
$theme              = $fields['theme'] ?? 'default';

// Determine background style based on media settings
$background_style   = ($background_image && $crop_media && !$contain_media) ? ' style="background-image: url(' . $background_image_url . '); background-position: center; background-size: cover;"' : '';
$content_style      = ($has_content && !$crop_media) ? ' content-absolute' : '';

// Set default media styles
$media_style        = ' media-crop';
$video_style        = '';

// Adjust styles if media is not cropped
if(!$crop_media) {
    $padding        = ($contain_media) ? $padding : 'none';
    $media_style    = '';
    $video_style    = ' media-full';
}
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>"<?php echo $background_style; ?>>
    <?php
    // Open container if media is contained
    if($contain_media) {
        echo '<div class="container '. $className .'-container '. $blockName .'-container'. $media_style .'">';
    }

    // Display video if available and no background style is set
    if($video_mp4 && empty($background_style)) {
        echo '<video class="video '. $className .'-bg-video'. $video_style .'" autoplay loop muted playsinline>';
            echo '<source src="'. $video_mp4["url"] .'" type="video/mp4">';
        echo '</video>';
    } 
    // Display background image if available and no background style is set
    elseif($background_image && empty($background_style)) {
        echo '<div class="bg-image '. $className .'-bg-image">';
            echo wp_get_attachment_image($background_image, 'full');
        echo '</div>';
    }

    // Display background overlay if image or video is present
    if($background_image || $video_mp4) {
        $overlay_formatted = number_format($background_overlay / 100, 2);
        $color = ($theme == 'dark') ? 'rgba(0, 0, 0, '. $overlay_formatted .')' : 'rgba(255, 255, 255, '. $overlay_formatted .')';
        echo '<div class="bg-overlay '. $className .'-bg-overlay" style="background-color: '. $color .';"></div>';
    }
    ?>
    
    <?php
    // Open content container based on media containment
    if(!$contain_media) {
        echo '<div class="container '. $className .'-container '. $blockName .'-container'. $content_style .'">';
    } else {
        echo '<div class="content '. $className .'-content '. $blockName .'-content'. $content_style .'">';
    }

    if($title || $headline || $content || $buttons) :
        echo '<div class="'. $className .'__heading block__heading">';

            if($title) {
                echo '<h4 class="title">'. $title .'</h4>';
            }

            if($headline) {
                echo '<h2 class="headline">'. $headline .'</h2>';
            }

            if($content) {
                echo '<div class="description">'. $content .'</div>';
            }

            if($buttons) {
                echo '<div class="btn-group">';

                foreach($buttons as $button) {
                    $link    = $button['link'];
                    $type    = $button['type']; 

                    echo getButton($link, 'btn__' . $type);
                }

                echo '</div>';
            }

        echo '</div>';
    endif;

    // Close content container
    echo '</div>';

    // Close media container if media is contained
    if($contain_media) {
        echo '</div>';
    }
    ?>
</section>