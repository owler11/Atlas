<?php
/**
 * Template Parts - Block - Grid Cards
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'grid-cards';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$media_type     = $fields['media_type'];
$cards          = $fields['cards'];

$padding_top    = $fields['padding_top'];
$padding_bottom = $fields['padding_bottom'];
$theme          = $fields['theme'];
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <?php
        if($cards) :
        ?>
        <div class="grid <?php echo $className; ?>-grid">
            
            <?php
            foreach($cards as $card) :
                $image          = $card['image'];
                $icon           = $card['icon'];
                $title          = $card['title'];
                $headline       = $card['headline'];
                $content        = $card['content'];
                $link           = $card['link'];
                ?>

                <div class="<?php echo $className; ?>-item">
                    <?php
                    if($icon || $image) :
                    ?>
                    <div class="<?php echo $className; ?>-media type-<?php echo $media_type; ?>">
                        <?php
                        if($icon && $media_type == 'icon') :
                            
                            echo $icon;

                        elseif($image && $media_type == 'image') :
                            
                            echo wp_get_attachment_image($image, 'full');
                        
                        endif;
                        ?>
                    </div>
                    <?php
                    endif;
                    ?>

                    <div class="<?php echo $className; ?>-content">
                        <?php
                        if($title) :
                            echo '<h5 class="title">'. $title .'</h5>';
                        endif;

                        if($headline) :
                            echo '<h3 class="headline">'. $headline .'</h3>';
                        endif;

                        if($content) :
                            echo '<div class="content">'. $content .'</div>';
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
                </div>

                <?php
            endforeach;
            ?>
            
        </div>
        <?php
        endif;
        ?>
    </div>
</section>