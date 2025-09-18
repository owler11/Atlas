<?php
/**
 * Template Parts - Block - Hero Stacked
 * 
 * @package mingo
 */

$className = 'hero-stacked';
$blockName = 'hero';

// ACF Fields
$title 			= $module['title'];
$headline 		= $module['headline'];
$content		= $module['content'];
$buttons		= $module['buttons'];
$content_align	= $module['content_alignment'];
$content_color	= $module['content_color'];

$fg_media_type 	= $module['foreground_media_type'];
$image			= $module['image'];
$video_type		= $module['video_type'];
$video			= $module['video'];
$video_mp4		= $module['video_mp4'];
$no_media 		= ($fg_media_type == 'none') ? ' no-media' : '';

$bg_media_type 	= $module['background_media_type'];
$bg_video		= $module['background_video'];
$bg_image		= $module['background_image'];
$bg_overlay		= $module['background_overlay'];
$padding_top    = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$theme			= get_field('theme');
?>

<section class="hero <?php echo $className; ?>-hero <?php echo $blockName; ?>-hero padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?> theme-<?php echo $theme . $no_media; ?>">
	<?php
	echo '<div class="'. $className .'-bg '. $blockName .'-bg bg-'. $theme .'">';
		// BG Overlay
		if($bg_overlay) {
			$overlay_formatted = number_format($bg_overlay / 100, 2);
			echo '<div class="bg-overlay '. $className .'-bg-overlay" style="background-color: rgba(0, 0, 0, '. $overlay_formatted .');"></div>';
		}

		// BG Media
		if($bg_media_type == 'video' && $bg_video) {
			echo '<video class="video '. $className .'-bg-video" autoplay loop muted playsinline>';
				echo '<source src="'. $bg_video["url"] .'" type="video/mp4">';
			echo '</video>';
		} 
		
		if($bg_media_type == 'image' && $bg_image) {
			echo '<div class="bg-image '. $className .'-bg-image">';
				echo wp_get_attachment_image($bg_image, 'full', false, ['class' => 'bg-image']);
			echo '</div>';
		}

		if($bg_media_type == 'none') {
			echo '<div class="hero-stacked-bg theme-'. $theme .'"></div>';
		}
	echo '</div>';
	?>
	<div class="container <?php echo $className; ?>-container <?php echo $blockName; ?>-container">
		<div class="grid <?php echo $className; ?>-grid <?php echo $blockName; ?>-grid">
			<div class="content <?php echo $className; ?>-content <?php echo $blockName; ?>-content content-<?php echo $content_align; ?> content-<?php echo $content_color; ?>">
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
			if($fg_media_type != 'none') :
			?>
			<div class="media <?php echo $className; ?>-media <?php echo $blockName; ?>-media">
				<?php
				if ($video && ($video_type == 'youtube' || $video_type == 'vimeo')) {
					echo '<div class="player" data-plyr-provider="'. $video_type .'" data-plyr-embed-id="'. $video .'"></div>';
				} elseif ($video_mp4 && $video_type == 'mp4') {
					$image_url 	= ($image) ? wp_get_attachment_url($image) : '';
					$poster 	= ($image) ? ' poster="'. $image_url .'"' : '';
					echo '<video class="video" autoplay loop muted playsinline'. $poster .'>';
						echo '<source src="'. $video_mp4['url'] .'" type="video/mp4">';
					echo '</video>';
				} elseif ($image) {
					echo wp_get_attachment_image($image, 'full');
				}
				?>
			</div>
			<?php
			endif;
			?>
		</div>
	</div>
</section>