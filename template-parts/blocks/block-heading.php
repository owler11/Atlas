<?php
/**
 * Template Parts - Block - Heading
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'heading';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$title          = $fields['title'];
$headline       = $fields['headline'];
$content        = $fields['content'];
$buttons        = $fields['buttons'];
$text_align     = $fields['text_align'];

$padding_top    = $fields['padding_top'];
$padding_bottom = $fields['padding_bottom'];
$theme          = $fields['theme'];
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>-wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <div class="<?php echo $className; ?>__heading heading-<?php echo $text_align; ?>">
            <?php
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
            ?>
        </div>

    </div>
</section>