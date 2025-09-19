<?php
/**
 * Functions - Tools Template Tags
 *
 * @package atlas
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Posted On
2.0 - Posted By
3.0 - Entry Categories
4.0 - Entry Footer
5.0 - Body Classes
6.0 - Pingback Header
--------------------------------------------------------------*/


//1.0 - Posted On
if ( ! function_exists( 'atlas_posted_on' ) ) :
	function atlas_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'atlas' ),
			$time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;


//2.0 - Posted By
if ( ! function_exists( 'atlas_posted_by' ) ) :
	function atlas_posted_by() {
		$byline = sprintf(
			esc_html_x( '%s', 'post author', 'atlas' ),
			'<span class="author vcard">' . esc_html( get_the_author() ) . '</span>'
		);
		echo '<span class="byline"> ' . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'atlas_posted_by_link' ) ) :
	function atlas_posted_by_link() {
		$byline = sprintf(
			esc_html_x( '%s', 'post author', 'atlas' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="byline"> ' . $byline . '</span>';
	}
endif;

//3.0 - Post Categories
if ( ! function_exists( 'atlas_post_categories' ) ) :
	function atlas_post_categories() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category();
			if ( $categories_list ) {
				echo '<ul class="post-cats">';
					foreach($categories_list as $cat) :
						echo '<li>' . $cat->name . '</li>';
					endforeach;
				echo '</ul>';
			}
		}
	}
endif;

if ( ! function_exists( 'atlas_post_categories_link' ) ) :
	function atlas_post_categories_link() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'atlas' ) );
			if ( $categories_list ) {
				printf( '<div class="post-cats">' . esc_html__( '%1$s', 'atlas' ) . '</div>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;


//4.0 - Entry Footer
if ( ! function_exists( 'atlas_entry_footer' ) ) :
	function atlas_entry_footer() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'atlas' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				wp_kses(
					__( 'Edit <span class="screen-reader-text">%s</span>', 'atlas' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
	
	
//5.0 - Body Classes
function atlas_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'atlas_body_classes' );


//6.0 - Pingback Header
function atlas_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'atlas_pingback_header' );


