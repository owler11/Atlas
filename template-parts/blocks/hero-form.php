<?php
/**
 * Template Parts - Block - Hero Form
 * 
 * @package mingo
 */

$className = 'hero-form';
$blockName = 'hero';

// ACF Fields
$title 			= $module['title'];
$headline 		= $module['headline'];
$description	= $module['description'];
$buttons		= $module['buttons'];
$form_title		= $module['form_title'];
$form_id		= $module['form_id'];
$form_disclaimer = $module['form_disclaimer'];

$padding_top    = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$theme			= get_field('theme');
?>

<section class="hero <?php echo $className; ?>-hero <?php echo $blockName; ?>-hero padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?> theme-<?php echo $theme; ?>">
	<div class="container <?php echo $className; ?>-container <?php echo $blockName; ?>-container">
		<div class="grid <?php echo $className; ?>-grid <?php echo $blockName; ?>-grid">
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

			<div class="form <?php echo $className; ?>-form <?php echo $blockName; ?>-form">
				<?php	
				echo '<div class="form-body">';
					if($form_title) {
						echo '<h4 class="form-title">'. $form_title .'</h4>';
					}

					if($form_id) {
						echo do_shortcode('[gravityform id="'.$form_id.'" title="false" description="false" ajax="true"]');
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