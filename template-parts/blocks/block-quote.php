<?php
/**
 * Template Parts - Block - Quote
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'quote';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields     = get_fields();
$quote      = $fields['quote'] ?? '';
$name       = $fields['name'] ?? '';
$job        = $fields['job'] ?? '';
$company    = $fields['company'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <div class="<?php echo $className .'-main'; ?>">
            <?php
            if($quote) {
                echo '<p class="quote">'. $quote .'</p>';
            }
            ?>

            <div class="quote-meta">
                <?php
                $separator = ', ';

                if ($name) {
                    echo '<span class="quote-name">' . $name;
                    if ($job || $company) {
                        echo $separator;
                    }
                    echo '</span>';
                }
                
                if ($job) {
                    echo '<span class="quote-job">' . $job;
                    if ($company) {
                        echo $separator;
                    }
                    echo '</span>';
                }
                
                if ($company) {
                    echo '<span class="quote-company">' . $company . '</span>';
                }
                ?>
            </div>
        </div>
    </div>
</section>