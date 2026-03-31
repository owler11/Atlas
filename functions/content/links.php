<?php
/**
 * Get Links
 *
 * @package atlas
 */
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Links & Buttons
	1.1 - atlas_get_button
	1.2 - atlas_get_nav_link
--------------------------------------------------------------*/

// 1.0 - Links & Buttons
// 1.1 - atlas_get_button
function atlas_get_button( $btnArr, string $linkClass = '', string $icon = '' ): string {
	if ( empty( $btnArr ) ) {
		return '';
	}

	$url    = esc_url( $btnArr['url'] ?? '#' );
	$title  = esc_html( $btnArr['title'] ?? '' );
	$target = ! empty( $btnArr['target'] ) ? ' target="' . esc_attr( $btnArr['target'] ) . '"' : '';
	$class  = esc_attr( trim( "btn $linkClass" ) );

	return "<a href=\"{$url}\" class=\"{$class}\"{$target}>{$title}{$icon}</a>";
}


// 1.2 - atlas_get_nav_link
function atlas_get_nav_link($linkArr = [], $linkClass = "") {
	if (empty($linkArr) || empty($linkArr['url'])) {
		return '';
	}

	$href        = esc_url( $linkArr['url'] );
	$title       = esc_html( $linkArr['title'] ?? '' );
	$target      = $linkArr['target'] ?? '';
	$attr_class  = $linkClass !== '' ? ' class="' . esc_attr( $linkClass ) . '"' : '';
	// Only emit target on _blank; include rel for security (tab-napping prevention)
	$target_attr = ( $target === '_blank' ) ? ' target="_blank" rel="noopener noreferrer"' : '';

	return '<a href="' . $href . '"' . $attr_class . $target_attr . '>' . $title . '</a>';
}