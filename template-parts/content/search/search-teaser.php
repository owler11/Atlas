<?php
/**
 * Template Parts - Search - Search Teaser
 * 
 * @package mingo
 */

?>

<article id="search-<?php the_ID(); ?>" <?php post_class('search-teaser teaser-list'); ?>>
    <div class="search-wrapper">
        <div class="search-content">
			<?php
			$categories = get_the_category();
			$separator = ' ';
			$output = '';
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$output .= '<a class="btn btn__small tag" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'atlas' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				echo '<div class="btn-group">';
					echo trim( $output, $separator );
				echo '</div>';
			}
			?>
			<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php
			echo the_excerpt();
			?>

			<a class="btn btn__text has-icon btn__post" href="<?php the_permalink(); ?>">Learn More<i class="fa-solid fa-angle-right"></i></a>
		</div>
    </div>
</article>