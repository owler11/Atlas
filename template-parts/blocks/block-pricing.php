<?php
/**
 * Template Parts - Block - Pricing
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'pricing';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$pricing_tables = $fields['pricing_tables'];
$count          = count($pricing_tables);

$padding_top    = $fields['padding_top'];
$padding_bottom = $fields['padding_bottom'];
$theme          = $fields['theme'];
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <div class="grid <?php echo $className; ?>-grid <?php echo $blockName; ?>-grid grid-<?php echo $count; ?>">
            <?php
            if($pricing_tables) :
                foreach($pricing_tables as $pricing) :
                    $highlight_tag  = $pricing['highlight_tag'];
                    $headline       = $pricing['headline'];
                    $description    = $pricing['description'];
                    $pricetag       = $pricing['pricetag'];
                    $disclaimer     = $pricing['disclaimer'];
                    $button         = $pricing['button'];
                    $content        = $pricing['content'];
                    ?>

                    <div class="<?php echo $className; ?>-item">
                        <?php
                        if($highlight_tag) :
                            echo '<div class="highlight-tag">'. $highlight_tag .'</div>';
                        endif;
                        ?>

                        <div class="pricing-intro">
                            <?php
                            if($headline) :
                                echo '<h3 class="headline">' . $headline . '</h3>';
                            endif;

                            if($description) :
                                echo '<p class="description">' . $description . '</p>';
                            endif;

                            if($pricetag) :
                                echo '<div class="pricetag">' . $pricetag . '</div>';
                            endif;

                            if($disclaimer) :
                                echo '<p class="disclaimer">' . $disclaimer . '</p>';
                            endif;

                            if($button) :
                                if($theme == 'dark') {
                                    $color = ' btn__light';
                                } elseif($theme == 'light') {
                                    $color = ' btn__dark';
                                } else {
                                    $color = '';
                                }

                                echo getButton($button, 'btn__outline btn__'.$color);
                            endif;
                            ?>
                        </div>

                        <?php
                        if($content) :
                            echo '<div class="pricing-content">';

                                echo '<div class="content">' . $content . '</div>';

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