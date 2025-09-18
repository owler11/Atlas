<?php
/**
 * Template Parts - Block - List
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'list';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$list_headline  = $fields['list_headline'] ?? '';
$list_columns   = $fields['list_columns'] ?? '';
$list           = $fields['list'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <div class="grid <?php echo $className; ?>-grid">
            <?php
            if($list_headline) :
                echo '<div class="'. $className .'-headline">';
                    echo '<h4 class="headline">'. $list_headline .'</h4>';
                echo '</div>';
            endif;

            if($list) :
                echo '<div class="'. $className .'-main">';
                    foreach($list as $list_item) :
                        $list = $list_item['list'];
                        ?>

                        <div class="<?php echo $className; ?>-item column-<?php echo $list_columns; ?>">
                            <?php echo $list; ?>
                        </div>

                        <?php
                    endforeach;
                echo '</div>';
            endif;
            ?>
        </div>
    </div>
</section>