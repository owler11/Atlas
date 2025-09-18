<?php
/**
 * Template Parts - Block - Video
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Define Block Class
$className = 'video';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$video_type     = $fields['video_type'] ?? '';
$video          = $fields['video'] ?? '';
$video_mp4      = $fields['video_mp4'] ?? '';
$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <div class="media <?php echo $className; ?>-media">
            <?php
            if ($video && ($video_type == 'youtube' || $video_type == 'vimeo')) {
                echo '<div class="player" data-plyr-provider="'. $video_type .'" data-plyr-embed-id="'. $video .'"></div>';
            } elseif ($video_mp4 && $video_type == 'mp4') {
                echo '<video class="video" autoplay loop muted playsinline>';
                    echo '<source src="'. $video_mp4['url'] .'" type="video/mp4">';
                echo '</video>';
            }
            ?>
        </div>
    </div>
</section>