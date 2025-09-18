<?php
/**
 * Template Parts - Block - Hero Resources
 * 
 * @package mingo
 */

$className = 'hero-resources';
$blockName = 'hero';

// ACF Fields
$title 				= $module['title'];
$headline 			= $module['headline'];
$content			= $module['content'];
$buttons			= $module['buttons'];
$overlay			= $module['overlay'];
$image				= $module['image'];
$resources			= $module['resources'];

$padding_top    = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$theme			= get_field('theme');
?>

<section class="hero <?php echo $className; ?>__hero padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?> theme-<?php echo $theme; ?>">
	<div class="container <?php echo $className; ?>__container">
		<div class="<?php echo $className; ?>__feature-post">
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
					$arrow = ($type == 'text') ? ' <i class="fa-solid fa-arrow-right"></i>' : '';

					echo getButton($link, 'btn__'.$type, $arrow);
				}

				echo '</div>';
			}

			if($overlay) {
				$overlay_formatted = number_format($overlay / 100, 2);
				echo '<div class="overlay '. $className .'-overlay" style="background-color: rgba(0, 0, 0, '. $overlay_formatted .');"></div>';
			}

			if($image) {
				echo '<div class="'. $className. '__bg">';
					echo wp_get_attachment_image($image, 'full');
				echo '</div>';
			}
			?>
		</div>

		<?php
		if($resources) :
			echo '<div class="'. $className. '__resources-grid">';
				foreach($resources as $item) :
					$post = get_post($item); 
					setup_postdata($post); 
					$id     = $post->ID;
					$args   = array(
						'id' => $id,
					);
					
					include( locate_template( 'template-parts/' . get_post_type($id) . '/' . get_post_type($id) . '-teaser.php', false, false, $args ) );
				endforeach;
			echo '</div>';
		endif;
		?>
	</div>
</section>