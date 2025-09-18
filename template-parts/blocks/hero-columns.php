<?php
/**
 * Template Parts - Block - Hero Columns
 * 
 * @package mingo
 */

$className = 'hero-columns';
$blockName = 'hero';

// ACF Fields
$title 			= $module['title'];
$headline 		= $module['headline'];
$content		= $module['content'];
$buttons		= $module['buttons'];
$columns_type	= $module['columns_type'];
$columns		= $module['columns'];

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

			<?php 
			if($columns) :
				echo '<div class="'. $className .'-columns column-'. $columns_type .'">';
					foreach($columns as $column) :
						$icon = $column['icon'];
						$content = $column['content'];

						echo '<div class="column">';
							if($icon) {	
								echo '<div class="column-icon">'. $icon .'</div>';
							}

							if($content) {
								echo '<div class="column-content">'. $content .'</div>';
							}
						echo '</div>';
					endforeach;
				echo '</div>';
			endif;
			?>
		</div>
	</div>
</section>