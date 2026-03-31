<?php
/**
 * Functions - Content - Menus
 *
 * ACF menu renderers.
 * Keys: menu_primary, menu_utility, menu_footer.
 * Primary class contract: primary-menu__list, primary-menu__item, primary-menu__link, primary-menu__trigger, primary-menu__submenu.
 * JS init: primaryMenuSubmenus(), mobileMenu().
 * Used by: header-primary, header-utility, footer.
 * Supports 3 levels: top-level items, children (2nd), grandchildren (3rd) via ACF nested repeaters.
 *
 * @package atlas
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Primary Menu
2.0 - Utility Menu
3.0 - Footer Menu
    3.1 - Flat Menu Helper
--------------------------------------------------------------*/

// 1.0 - Primary
function atlas_render_menu_primary() {
	$items = get_field('menu_primary', 'option');
	if (empty($items) || ! is_array($items)) return;

	$sub_index = 0; // Submenu (children) index per top-level item

	echo '<ul class="primary-menu__list">';

	foreach ($items as $item) {
		// ACF fields
		$link         = $item['link'] ?? []; // Top-level link
		$children     = is_array( $item['children'] ?? null ) ? $item['children'] : []; // Children
		$has_children = ! empty( $children );

		// List item (li) classes
		$item_classes = ['primary-menu__item'];
		if ($has_children) $item_classes[] = 'primary-menu__item--has-dropdown';

		// Submenu ID (ARIA attributes belong on the <button>, not the <li>)
		$sub_id = 'primary-menu-sub-' . (++$sub_index);

		// Top-level link
		echo '<li class="' . esc_attr( implode( ' ', $item_classes ) ) . '">';

		if (! empty($link['url'])) {
			echo atlas_get_nav_link($link, 'primary-menu__link');
		}

		// Submenu dropdown: trigger button + submenu list
		if ($has_children) {
			// ARIA labels
			$trigger_label = esc_attr__('Toggle submenu', 'atlas');
			$submenu_label = esc_attr__('Submenu', 'atlas');

			// Trigger button
			echo '<button type="button"';
			echo ' class="primary-menu__trigger js-accordion-trigger"';
			echo ' aria-expanded="false" aria-controls="' . esc_attr($sub_id) . '" aria-label="' . $trigger_label . '">';
			echo '<i class="fa-solid fa-angle-down" aria-hidden="true"></i>';
			echo '</button>';

			// Submenu list (2nd level; items may have 3rd level)
			echo '<ul class="primary-menu__submenu" id="' . esc_attr($sub_id) . '" role="menu" aria-label="' . $submenu_label . '">';
			$sub_sub_index = 0;

			foreach ($children as $child) {
				$child_link = $child['link'] ?? [];
				$grandchildren = $child['grandchildren'] ?? [];
				$grandchildren = is_array($grandchildren) ? $grandchildren : [];
				$has_grandchildren = ! empty($grandchildren);

				// 3rd level: item with dropdown
				if ($has_grandchildren) {
					// Generate a unique ID for the sub-submenu
					$sub_sub_id = $sub_id . '-' . (++$sub_sub_index);
					echo '<li class="primary-menu__item primary-menu__item--has-dropdown" role="none">';
					
					// Output the link
					if (! empty($child_link['url'])) {
						echo atlas_get_nav_link($child_link, 'primary-menu__link');
					}
					
					// Trigger button
					echo '<button type="button" class="primary-menu__trigger js-accordion-trigger" aria-expanded="false" aria-controls="' . esc_attr($sub_sub_id) . '" aria-label="' . $trigger_label . '">';
					echo '<i class="fa-solid fa-angle-down" aria-hidden="true"></i></button>';
					
					// Submenu list
					echo '<ul class="primary-menu__submenu" id="' . esc_attr($sub_sub_id) . '" role="menu" aria-label="' . $submenu_label . '">';
					
					// Grandchildren
					foreach ($grandchildren as $grandchild) {
						$g_link = $grandchild['link'] ?? [];
						if (empty($g_link['url'])) continue;
						echo '<li class="primary-menu__item" role="none">' . atlas_get_nav_link($g_link, 'primary-menu__link') . '</li>';
					}
					
					echo '</ul></li>';
				} else {
					// 2nd level: link only
					if (empty($child_link['url'])) continue;
					echo '<li class="primary-menu__item" role="none">' . atlas_get_nav_link($child_link, 'primary-menu__link') . '</li>';
				}
			}
			echo '</ul>';
		}

		echo '</li>';
	}

	echo '</ul>';
}

/* Sample HTML output
 *
 * BASIC STRUCTURE:
 *
	<ul class="primary-menu__list">
		<li class="primary-menu__item">
			<a href="/" class="primary-menu__link">Nav Item</a>
		</li>
		...
	</ul>
 *
 * ITEM WITH CHILDREN:
 *
	<li class="primary-menu__item primary-menu__item--has-dropdown">
		<a href="/" class="primary-menu__link">Nav Item</a>
		<button type="button" class="primary-menu__trigger js-accordion-trigger" aria-expanded="false" aria-controls="primary-menu-sub-1" aria-label="Toggle submenu">
			<i class="fa-solid fa-angle-down" aria-hidden="true"></i>
		</button>
		<ul class="primary-menu__submenu" id="primary-menu-sub-1" role="menu" aria-label="Submenu">
			<li class="primary-menu__item" role="none">
				<a href="/" class="primary-menu__link">Sub Item</a>
			</li>
		</ul>
	</li>
 *
 */


// 2.0 - Utility
function atlas_render_menu_utility() {
	atlas_render_menu_flat( 'menu_utility', 'utility-menu' );
}

// 3.0 - Footer
function atlas_render_menu_footer() {
	atlas_render_menu_flat( 'menu_footer', 'footer-menu' );
}

// 3.1 - Flat Menu Helper
// Shared renderer for single-level menus (utility, footer).
// $acf_key:    ACF option field key (e.g. 'menu_utility')
// $css_prefix: BEM block prefix (e.g. 'utility-menu') — outputs __list, __item, __link classes
function atlas_render_menu_flat( $acf_key, $css_prefix ) {
	$items = get_field( $acf_key, 'option' );
	if ( empty( $items ) || ! is_array( $items ) ) return;

	echo '<ul class="' . esc_attr( $css_prefix ) . '__list">';
	foreach ( $items as $item ) {
		$link = $item['link'] ?? [];
		if ( empty( $link['url'] ) ) continue;
		echo '<li class="' . esc_attr( $css_prefix ) . '__item">'
			. atlas_get_nav_link( $link, $css_prefix . '__link' )
			. '</li>';
	}
	echo '</ul>';
}
