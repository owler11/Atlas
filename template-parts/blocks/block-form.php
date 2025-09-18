<?php
/**
 * Template Parts - Block - Form
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'form';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields         = get_fields();
$title 			= $fields['title'] ?? '';
$headline 		= $fields['headline'] ?? '';
$description	= $fields['description'] ?? '';
$buttons		= $fields['buttons'] ?? '';
$form_image		= $fields['form_image'] ?? '';
$form_title		= $fields['form_title'] ?? '';
$show_title		= $fields['show_form_title'] ?? false;
$show_description = $fields['show_form_description'] ?? false;
$form_id		= $fields['form_id'] ?? '';
$form_disclaimer = $fields['form_disclaimer'] ?? '';
$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme			= $fields['theme'] ?? 'default';

$show_title = $show_title ? 'true' : 'false';
$show_description = $show_description ? 'true' : 'false';
$has_content = ($title || $headline || $description || $buttons) ? ' has-content' : ' no-content';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">
        <div class="grid <?php echo $className; ?>-grid <?php echo $blockName; ?>-grid<?php echo $has_content; ?>">
            <?php
            if($title || $headline || $description || $buttons) :
            ?>
			<div class="content <?php echo $className; ?>-content <?php echo $blockName; ?>-content">
				<?php
				if($title) {
					echo '<h4 class="title">'. $title .'</h4>';
				}

				if($headline) {
					echo '<h1 class="headline">'. $headline .'</h1>';
				}
				
				if($description) {
					echo '<div class="description">'. $description .'</div>';
				}

				if($buttons) {
					echo '<div class="btn-group">';

					foreach($buttons as $button) {
						$link    = $button['link'];
						$type    = $button['type'];
						
						echo getButton($link, 'btn__'. $type);
					}

					echo '</div>';
				}
				?>
			</div>
            <?php   
            endif; 
            ?>

			<div class="form <?php echo $className; ?>-form <?php echo $blockName; ?>-form">
				<?php
				if($form_image) {
					echo '<div class="form-image">'. wp_get_attachment_image($form_image, 'full') .'</div>';
				}

				echo '<div class="form-body">';
					if($form_title && $show_title == 'false') {
						echo '<h4 class="form-title">'. $form_title .'</h4>';
					}

					if($form_id) {
						echo do_shortcode('[gravityform id="'.$form_id.'" title="'. $show_title .'" description="'. $show_description .'" ajax="true"]');
					}

					if($form_disclaimer) {
						echo '<p class="form-disclaimer">'. $form_disclaimer .'</p>';
					}
				echo '</div>';
				?>
			</div>
		</div>
    </div>
</section>