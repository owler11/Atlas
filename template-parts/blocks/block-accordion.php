<?php
/**
 * Template Parts - Block - Accordion
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'accordion';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$accordions     = $fields['accordions'];

$padding_top    = $fields['padding_top'];
$padding_bottom = $fields['padding_bottom'];
$theme          = $fields['theme'];
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <?php
        if($accordions) :
            foreach($accordions as $accordion) :
                $title      = $accordion['title'];
                $content    = $accordion['content'];
                $link       = $accordion['link'];
                $image      = $accordion['image'];
                $caption    = $accordion['image_caption'];
                ?>

                <details class="<?php echo $className; ?>__item">
                    <summary class="<?php echo $className; ?>-summary accordion__item-summary">
                        <h3 class="title"><?php echo $title; ?></h3>
                    </summary>
                    <div class="<?php echo $className; ?>-content content accordion__item-content">
                        <div class="main">
                            <?php echo $content; ?>
                            <?php 
                            if($link) :
                                if($theme == 'dark') {
                                    $color = ' btn__light';
                                } elseif($theme == 'light') {
                                    $color = ' btn__dark';
                                } else {
                                    $color = '';
                                }
                                echo getLink($link, 'btn__'. $color);
                            endif; 
                            ?>
                        </div>
                        
                        <?php if($image) : ?>
                            <figure class="image">
                                <?php
                                echo wp_get_attachment_image($image, 'full', false, array('class' => 'img'));
                                
                                if($caption) : 
                                    echo '<figcaption>'. $caption .'</figcaption>';
                                endif; 
                                ?>
                            </figure>
                        <?php endif; ?>
                    </div>
                </details>

                <?php
            endforeach;
        endif;
        ?>
    </div>
</section>