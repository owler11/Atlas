<?php
/**
 * Template Parts - Block - Testimonials
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'testimonials';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$testimonials   = $fields['testimonials'] ?? '';
$link           = $fields['link'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <?php
        if($testimonials) :
            echo '<div class="'. $className .'-main js-slider-testimonial slider-dots-outside">';
                foreach($testimonials as $testimonial) :
                    $id         = $testimonial->ID;
                    $quote      = get_field('quote', $id);
                    $name       = get_field('name', $id);
                    $job        = get_field('job', $id);
                    $company    = get_field('company', $id);
                    ?>

                    <div class="<?php echo $className .'-item'; ?>">
                        <?php
                        if($quote) {
                            echo '<p class="'. $className .'-quote">'. $quote .'</p>';
                        }
                        ?>

                        <div class="<?php echo $className .'-meta'; ?>">
                            <?php
                            $separator = ', ';

                            if ($name) {
                                echo '<span class="' . $className . '-name">' . $name;
                                if ($job || $company) {
                                    echo $separator;
                                }
                                echo '</span>';
                            }
                            
                            if ($job) {
                                echo '<span class="' . $className . '-job">' . $job;
                                if ($company) {
                                    echo $separator;
                                }
                                echo '</span>';
                            }
                            
                            if ($company) {
                                echo '<span class="' . $className . '-company">' . $company . '</span>';
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                endforeach;
            echo '</div>';
        endif;

        if($link) {
            if($theme == 'dark') {
                $color = ' btn__light';
            } elseif($theme == 'light') {
                $color = ' btn__dark';
            } else {
                $color = '';
            }

            echo '<div class="'. $className .'-link">';
                echo getButton($link, "btn__outline btn__". $color);
            echo '</div>';
        }
        ?>
    </div>
</section>