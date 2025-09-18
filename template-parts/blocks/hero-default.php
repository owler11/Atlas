<?php
/**
 * Template Parts - Block - Hero Default
 * 
 * @package mingo
 */

$className = 'hero-default';
$blockName = 'hero';

// ACF Fields
$title 			= $module['title'] ?? '';
$headline 		= $module['headline'] ?? '';
$content		= $module['content'] ?? '';
$buttons		= $module['buttons'] ?? '';
$content_align	= $module['content_alignment'] ?? '';

$padding_top    = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$theme			= get_field('theme');

// if $headline is empty, set $headline to page title
if(empty($headline)) {
	$headline = get_the_title();
}
?>

<section class="hero <?php echo $className; ?>-hero <?php echo $blockName; ?>-hero padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?> theme-<?php echo $theme; ?>">
	
	<div class="container <?php echo $className; ?>-container <?php echo $blockName; ?>-container">
		<div class="grid <?php echo $className; ?>-grid <?php echo $blockName; ?>-grid">
			<div class="content <?php echo $className; ?>-content <?php echo $blockName; ?>-content content-<?php echo $content_align; ?>">
				<?php
				if($title) {
					echo '<h4 class="title">'. $title .'</h4>';
				}

				if($headline) {
					echo '<h1 class="headline">'. $headline .'</h1>';
				}
				
				if($content) {
					echo '<div class="content">'. $content .'</div>';
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
		</div>
	</div>
</section>