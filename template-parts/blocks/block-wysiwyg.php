<?php
/**
 * Template Parts - Block - Wysiwyg
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Define Block Class
$className = 'wysiwyg';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$align          = $fields['align'] ?? 'left';
$wysiwyg        = $fields['wysiwyg'] ?? '';
$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <div class="<?php echo $className; ?>__grid content-<?php echo $align; ?>">
            <?php echo $wysiwyg; ?>
        </div>
    </div>
</section>