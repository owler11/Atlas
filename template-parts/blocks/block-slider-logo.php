<?php
/**
 * Template Parts - Block - Slider Logo
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'slider-logo';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$logos          = $fields['logos'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <?php
        if($logos) :
            echo '<div class="slider '. $className .'-slider js-slider-logo">';
                foreach($logos as $logo_item) :
                    $logo   = $logo_item['logo'];
                    $link   = $logo_item['link'];
                    $width  = ($logo_item['width'] > 50) ? $logo_item['width'] .'px' : '100%';

                    if($logo) :
                        if($link) :
                            echo '<a class="logo-image" href="'. $link['url'] .'" target="'. $link['target'] .'">';
                        else:
                            echo '<figure class="logo-image">';
                        endif;
                                echo wp_get_attachment_image($logo, 'full', false, ['class' => 'logo', 'style' => 'width: '. $width .';']);
                        if($link) :
                            echo '</a>';
                        else:
                            echo '</figure>';
                        endif;
                    endif;
                
                endforeach;
            echo '</div>';
        endif;
        ?>
    </div>
</section>