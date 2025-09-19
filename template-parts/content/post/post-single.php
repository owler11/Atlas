<?php
/**
 * Template Parts - Post - Post Single
 * 
 * @package mingo
 */

$featured_image = get_field('featured_image');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>
	<div class="container post-single-container">
		<header class="post-single-header">
			<h1 class="post-title"><?php the_title(); ?></h1>

			<div class="grid post-single-grid">
				<div class="post-single-description">
					<?php
					if(has_excerpt()) :
						echo '<p class="post-excerpt">' . get_the_excerpt() . '</p>';
					endif;
					?>

					<ul class="post-single-meta meta">
						<li class="author">By <?php the_author(); ?></li>
						<li class="date"><?php echo get_the_date(); ?></li>
					</ul>
				</div>

				<div class="post-single-share">
					<?php
					$categories = get_the_category();
					$separator = '';
					$output = '';
					if ( ! empty( $categories ) ) {
						foreach( $categories as $category ) {
							$output .= '<a class="btn btn__outline tag" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'atlas' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
						}
						echo '<div class="btn-group">';
							echo trim( $output, $separator );
						echo '</div>';
					}
					?>
					<?php get_template_part( 'template-parts/components/social', 'share' ); ?>
				</div>
			</div>
		</header>

		<?php
		if ($featured_image) :
		?>
		<div class="post-single-image">
			<?php echo wp_get_attachment_image($featured_image, 'atlas_xl'); ?>
		</div>
		<?php
		endif; 
		?>
	</div>

	<div class="post-single-content">
		<?php the_content(); ?>
	</div>
</article>

