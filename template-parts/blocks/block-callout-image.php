<?php
/**
 * Template Parts - Block - Callout Image
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'callout-image';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$title          = $fields['callout_title'] ?? '';
$headline       = $fields['callout_headline'] ?? '';
$content        = $fields['callout_content'] ?? '';
$link           = $fields['callout_link'] ?? '';
$image          = $fields['callout_image'] ?? '';
$callout_align  = $fields['callout_align'] ?? '';
$vertical_align = $fields['vertical_align'] ?? '';

$padding_top    = $fields['padding_top'];
$padding_bottom = $fields['padding_bottom'];
$theme          = $fields['theme'];
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <div class="grid <?php echo $className; ?>__grid content-align-<?php echo $callout_align; ?> vertical-<?php echo $vertical_align; ?>">

            <div class="column <?php echo $className; ?>__content">
                <?php
                if($title) :
                    echo '<h5 class="title">'. $title .'</h5>';
                endif;

                if($headline) :
                    echo '<h3 class="headline">'. $headline .'</h3>';
                endif;

                if($content) :
                    echo '<div class="description">'. $content .'</div>';
                endif;

                if($link) :
                    if($theme == 'dark') {
                        $color = ' btn__light';
                    } elseif($theme == 'light') {
                        $color = ' btn__dark';
                    } else {
                        $color = '';
                    }
                    echo getLink($link, 'btn__'. $color , '<i class="fa-solid fa-arrow-right"></i>');
                endif;
                ?>
            </div>

            <div class="column <?php echo $className; ?>__image">
                <?php
                if($image) :
                    echo wp_get_attachment_image($image, 'full');
                endif;
                ?>
            </div>
            
        </div>

    </div>
</section>