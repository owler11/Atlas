<?php
/**
 * Template Parts - Block - Slider Card
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'slider-card';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$cards          = $fields['cards'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?> slick-list-visible">
	<div class="container <?php echo $className; ?>__container">
        <?php
        if($cards) :
            echo '<div class="slider '. $className .'-slider js-slider-3">';
                foreach($cards as $card) :
                    $headline       = $card['headline'];
                    $description    = $card['description'];
                    $image          = $card['image'];
                    $link           = $card['link'];
                    ?>

                    <div class="slider-card <?php echo $className; ?>-card">
                        <?php
                        if($image) :
                            echo '<figure class="card-image">';
                                echo wp_get_attachment_image($image, 'full', false, ['class' => 'card-image']);
                            echo '</figure>';
                        endif;

                        if($headline || $description || $link) :
                            echo '<div class="card-content">';
                                if($headline) {
                                    echo '<h3 class="card-headline h5">'. $headline .'</h3>';
                                }

                                if($description) {
                                    echo '<div class="card-description">'. $description .'</div>';
                                }

                                if($link) {
                                    echo getLink($link, 'btn__outline');
                                }
                            echo '</div>';
                        endif;
                        ?>
                    </div>

                    <?php
                endforeach;
            echo '</div>';
        endif;
        ?>
    </div>
</section>