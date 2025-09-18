<?php
/**
 * Template Parts - Block - Stats
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'stats';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$animate        = $fields['animate'] ?? false;
$animation_time = $fields['animation_duration'] ?? 1000;
$stats          = $fields['stats'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <div class="grid <?php echo $className; ?>-grid">
            <?php
            if($stats) :
                foreach($stats as $stat) :
                    $before_value   = $stat['before_value'];
                    $after_value    = $stat['after_value'];
                    $description    = $stat['description'];
                    $link           = $stat['link'];
                    $stat           = $stat['stat'];
                    ?>

                    <div class="<?php echo $className; ?>-item">
                        <div class="stat-input">
                            <?php
                            if($before_value) :
                                echo '<span class="pre">' . $before_value . '</span>';
                            endif;

                            if($animate) :
                                echo '<span class="number js-stat-number" data-number="'. $stat .'" data-duration="'. $animation_time .'">0</span>';
                            else :
                                echo '<span class="number">'. $stat .'</span>';
                            endif;

                            if($after_value) :
                                echo '<span class="post">' . $after_value . '</span>';
                            endif;
                            ?>
                        </div>

                        <?php
                        if($description || $link) :
                            echo '<div class="meta">';

                                if($description) :
                                    echo '<p class="description">' . $description . '</p>';
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

                            echo '</div>';
                        endif;
                        ?>
                    </div>

                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>