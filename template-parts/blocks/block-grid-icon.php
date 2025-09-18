<?php
/**
 * Template Parts - Block - Grid Icon
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'grid-icon';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$icon_align     = $fields['icon_align'] ?? '';
$icon_type      = $fields['icon_type'] ?? '';
$grid           = $fields['grid'] ?? '';
$icons          = $fields['icons'] ?? '';
$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <?php
        if($icons) :
        ?>
        <div class="grid <?php echo $className; ?>-grid <?php echo $blockName; ?>-grid grid-<?php echo $grid; ?>">
            
            <?php
            foreach($icons as $icon_item) :
                $icon           = $icon_item['icon'];
                $image          = $icon_item['image'];
                $icon_text      = $icon_item['icon_text'];
                $title          = $icon_item['title'];
                $headline       = $icon_item['headline'];
                $description    = $icon_item['description'];
                $link           = $icon_item['link'];
                ?>

                <div class="<?php echo $className; ?>-item icon-<?php echo $icon_align; ?>">
                    <?php
                    if($icon || $icon_text || $image) :
                    ?>
                    <div class="icon">
                        <?php
                        if($icon && $icon_type == 'icon') :
                            
                            echo $icon;

                        elseif($image && $icon_type == 'image') :
                            
                            echo wp_get_attachment_image($image, 'full');
                        
                        elseif($icon_text && $icon_type == 'text') :
                        
                            echo '<p class="icon-text">'. $icon_text .'</p>';

                        endif;
                        ?>
                    </div>
                    <?php
                    endif;
                    ?>

                    <div class="content">
                        <?php
                        if($title) :
                            echo '<h5 class="title">'. $title .'</h5>';
                        endif;

                        if($headline) :
                            echo '<h3 class="headline">'. $headline .'</h3>';
                        endif;

                        if($description) :
                            echo '<div class="description">'. $description .'</div>';
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