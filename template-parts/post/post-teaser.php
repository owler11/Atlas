<?php
/**
 * Template Parts - Post - Post Teaser
 * 
 * Template part for displaying the teaser of post on index and archive pages
 * 
 * @package mingo
 */

if (isset($args) && $args) {
	$id	= $args['id'];
} else {
	$id = get_the_ID();
}

$feature_image = get_field('featured_image', $id);
if (!$feature_image) :
	$feature_image = get_field('blog_default_image', 'option');
endif;

// Get Links
include dirname(__FILE__) . '/../components/single-links.php';

$classes = array(
	'post-teaser',
	'teaser'
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    <a class="wrapper post-wrapper" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>"<?php echo $download; ?>>
        <div class="post-image">
            <?php echo wp_get_attachment_image($feature_image, 'atlas_md'); ?>
        </div>
        <div class="post-content">
			<?php
			$categories = get_the_category($id);
			$separator = ' ';
			$output = '';
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$output .= '<span class="btn btn__text tag">' . esc_html( $category->name ) . '</span>' . $separator;
				}
				echo '<div class="btn-group">';
					echo trim( $output, $separator );
				echo '</div>';
			}
			?>

			<h5 class="title"><?php echo get_the_title($id); ?></h5>
			<?php
			echo '<p class="description">'. get_the_excerpt($id) .'</p>';
			?>

			<span class="btn btn__outline btn__small btn__post"><?php echo $link_text_val; ?></span>
		</div>
    </a>
</article>
