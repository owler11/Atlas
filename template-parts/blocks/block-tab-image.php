<?php
/**
 * Template Parts - Block - Tab Image
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Define Block Class
$className = 'tab-image';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields     = get_fields();
$tab_align  = $fields['tab_alignment'] ?? 'left';
$tab        = $fields['tab'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <div class="grid <?php echo $className; ?>-grid media-<?php echo $tab_align; ?> js-tab-parent">
            <?php
            if($tab) :
                $counter_media = 0;
                echo '<div class="'. $className .'__media-item">';
                    foreach($tab as $item) :
                        $image = $item['image'];
                        $counter_media++;
                        $active = ($counter_media == 1) ? ' active' : '';

                        echo '<div class="'. $className .'__media js-tab-source'. $active .'">';
                            echo wp_get_attachment_image($image, 'full');
                        echo '</div>';

                    endforeach;
                echo '</div>';
            endif;
            
            if($tab) :
                $counter_content = 0;
                echo '<div class="'. $className .'__content-item">';
                    foreach($tab as $item) :
                        $title      = $item['title'];
                        $headline   = $item['headline'];
                        $content    = $item['content'];
                        $link       = $item['link'];
                        $counter_content++;
                        $active = ($counter_content == 1) ? ' active' : '';

                        echo '<div class="'. $className .'__content js-tab-target'. $active .'">';
                            echo '<div class="content">';
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
                                    echo getLink($link,'btn__'. $color);
                                endif;
                            echo '</div>';
                        echo '</div>';
                    endforeach;
                echo '</div>';
            endif;
            ?>
        </div>
    </div>
</section>