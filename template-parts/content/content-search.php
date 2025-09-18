<?php
/**
 * Template Parts - Content - Content Search
 * 
 * Template part for displaying the content of results in search page
 * 
 * @package mingo
 */

$post_type = get_post_type();
if ( 'post' == get_post_type() ) :
	$post_type = 'News';
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php relevanssi_the_title(); ?></a></h3>
		<p class="entry-permalink">
			<span><?php echo $post_type . ' · '; ?></span>
			<?php echo esc_url( get_permalink() ); ?>	
		</p>
		
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article>
