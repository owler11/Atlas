<?php
/**
 * Template Parts - Block - Bento Grid
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'bento-grid';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$bento_grids    = $fields['bento_grids'];

$padding_top    = $fields['padding_top'];
$padding_bottom = $fields['padding_bottom'];
$theme          = $fields['theme'];
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <?php
        if($bento_grids) :
        ?>
        <div class="grid <?php echo $className; ?>__grid">
            
            <?php
            foreach($bento_grids as $bento) :
                $grid_span      = $bento['grid_span'];
                $image          = $bento['background_image'];
                $title          = $bento['title'];
                $headline       = $bento['headline'];
                $description    = $bento['description'];
                $link           = $bento['link'];

                $image_url      = ($image) ? wp_get_attachment_url($image) : '';
                $style          = ($image) ? ' style="background-image: url('. $image_url .'); background-size: cover; background-position: center;"' : '';
                $has_img        = ($image) ? ' has-img' : '';
                ?>

                <div class="<?php echo $className; ?>-item column-<?php echo $grid_span . $has_img; ?>"<?php echo $style; ?>>
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

                <?php
            endforeach;
            ?>
            
        </div>
        <?php
        endif;
        ?>
    </div>
</section>