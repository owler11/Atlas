<?php
/**
 * Template Parts - Block - Call to Action
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'call-to-action';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields             = get_fields();
$title              = $fields['title'] ?? '';
$headline           = $fields['headline'] ?? '';
$content            = $fields['content'] ?? '';
$buttons            = $fields['buttons'] ?? '';
// $text_align         = $fields['text_align'];

$background_overlay = $fields['background_overlay'] ?? '';
$background_image   = $fields['background_image'] ?? '';
$background_image_url = wp_get_attachment_url($background_image);
$full_width         = $fields['full_width'] ?? '';
$full_width_class   = ($full_width) ? ' full-width' : '';

$padding_top        = $fields['padding_top'];
$padding_bottom     = $fields['padding_bottom'];
$theme              = $fields['theme'];

$background_style_wrapper = ($background_image && $full_width) ? ' style="background-image: url(' . $background_image_url . '); background-position: center; background-size: cover;"' : '';
$background_style = ($background_image) ? ' style="background-image: url(' . $background_image_url . '); background-position: center; background-size: cover;"' : '';

$class = [];
$class_string = '';
if ($full_width) {

    $class = array(
        ' full-width',
        'theme-' . $theme,
    );

    // Convert the class array to a string
    $class_string = implode(' ', $class);
}
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom . $class_string; ?>"<?php echo $background_style_wrapper; ?>>
    <?php
    if($full_width && $background_overlay) {
        $overlay_formatted = number_format($background_overlay / 100, 2);
        echo '<div class="bg-overlay" style="background-color: rgba(0, 0, 0, '. $overlay_formatted .');"></div>';
    }
    ?>

	<div class="container <?php echo $className; ?>-container <?php echo $blockName; ?>-container">

        <?php
        if(!$full_width) :
        ?>
        <div class="main <?php echo $className; ?>-main <?php echo $blockName; ?>-main theme-<?php echo $theme; ?>">
            <?php
            if($background_overlay) {
                $overlay_formatted = number_format($background_overlay / 100, 2);
                echo '<div class="bg-overlay" style="background-color: rgba(0, 0, 0, '. $overlay_formatted .');"></div>';
            }

            if($background_image) :
            ?>
                <div class="bg <?php echo $className; ?>-bg"<?php echo $background_style; ?>></div>
            <?php
            endif;
            ?>
        <?php
        endif;
        ?>

        <?php
        if($title || $headline || $content || $buttons) :
            echo '<div class="'. $className .'__heading">';

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
        ?>

        <?php
        if(!$full_width) :
        ?>
        </div>
        <?php
        endif;
        ?>
    </div>
</section>