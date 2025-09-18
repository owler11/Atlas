<?php
/**
 * Functions - Functions Menu
 * 
 * @package mingo
 * 
 * Usage: <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Register Menus
2.0 - Menus
3.0 - Walkers
4.0 - Fallback
5.0 - ACF for Menus
--------------------------------------------------------------*/



//1.0 - Register Menus
register_nav_menus(
	array(
		'primary' 	=> __( 'Primary', 'mingo' ),
		'utility' 	=> __( 'Utility', 'mingo' ),
		'footer' 	=> __( 'Footer', 'mingo' ),
		'legal' 	=> __( 'Legal', 'mingo' ),
	)
);


// 2.0 - Menus
function wp_primary_menu() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'primary',			// Adding custom nav id
		'menu_class'		=> 'menu-primary',		// Adding custom nav class
		'theme_location'	=> 'primary',			// Where it's located in the theme
		'depth'				=> 3,					// Limit the depth of the nav
		'fallback_cb'		=> 'false',				// Fallback function (see 4.0)
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',	
		'walker'			=> new Primary_Menu_Walker()
	));
} 

function wp_utility_menu() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'utility',			// Adding custom nav id
		'menu_class'		=> 'menu-utility',		// Adding custom nav class
		'theme_location'	=> 'utility',			// Where it's located in the theme
		'depth'				=> 1,					// Limit the depth of the nav
		'fallback_cb'		=> 'false',				// Fallback function (see 4.0)
		'items_wrap'		=> '<div class="utility-menu"><div class="container"><ul id="%1$s" class="%2$s" role="menubar">%3$s</ul></div></div>',
	));
} 

function wp_footer_menu() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'menu-footer',			// Adding custom nav id
		'menu_class'		=> 'menu-footer',		// Adding custom nav class
		'theme_location'	=> 'footer',			// Where it's located in the theme
		'depth'				=> 2,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
} 


// 3.0 - Walkers
/**
 * Create HTML list of nav menu items.
 *
 * @since 1.0.0
 * @uses Walker
 * @uses Walker_Nav_Menu
 */
class Primary_Menu_Walker extends Walker_Nav_Menu {
	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el() for parameters and longer explanation
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		/**
		 * Filter the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param array  $args  An array of arguments.
		 * @param object $item  Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		/**
		 * Filter the ID applied to a menu item's list item element.
		 * 
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= sprintf( '%s<li%s%s%s>',
			$indent,
			$id,
			$class_names,
			in_array( 'menu-item-has-children', $item->classes ) ? ' aria-haspopup="true" aria-expanded="false" tabindex="0"' : ''
		);
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		/**
		 * Filter a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string $title The menu item's title.
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class Mega_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Start the level (sub-menu)
    public function start_lvl(&$output, $depth = 0, $args = array()) {
		if ($depth === 0) {
            // Add the opening divs and ul for the first level
            $output .= '<div class="sub-menu__wrapper"><div class="sub-menu__container"><ul class="sub-menu">';
        } else {
            // Add only the ul for deeper levels
            $output .= '<ul class="sub-menu">';
        }
    }

    // End the level (sub-menu)
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        if ($depth === 0) {
            // Add the closing ul and divs for the first level
            $output .= '</ul></div></div>';
        } else {
            // Add only the closing ul for deeper levels
            $output .= '</ul>';
        }
    }
}

// 4.0 - Fallbacks
function mingo_primary_nav_fallback() {
	wp_page_menu( array(
		'show_home'		=> true,
		'menu_class'	=> '',		// Adding custom nav class
		'include'		=> '',
		'exclude'		=> '',
		'echo'			=> true,
		'link_before'	=> '',		// Before each link
		'link_after'	=> ''		// After each link
	));
}



// 5.0 - ACF for Menus
add_filter('acf/location/rule_types', 'acf_location_rules_types');
function acf_location_rules_types($choices) {
    $choices['Menu']['menu_level'] = 'Menu Level';
    return $choices;
}

add_filter('acf/location/rule_values/menu_level', 'acf_location_rule_values_level');
function acf_location_rule_values_level($choices) {
    $choices[0] = '0';
    $choices[1] = '1';
    $choices[2] = '2';

    return $choices;
}

add_filter('acf/location/rule_match/menu_level', 'acf_location_rule_match_level', 10, 4);
function acf_location_rule_match_level($match, $rule, $options, $field_group) {
  global $current_screen;
    if ($current_screen->id == 'nav-menus' && isset($options['nav_menu_item_depth'])) {
        if ($rule ['operator'] == "==") {
            $match = ($options['nav_menu_item_depth'] == $rule['value']);
        }
    }
    return $match;
}

// Menu Settings for Primary
add_filter('wp_nav_menu_args', 'primary_menu_args');
function primary_menu_args($args) {
	
	if ($args['theme_location'] == 'primary') {
		// Get the menu locations
		$locations = get_nav_menu_locations();

		// Get the menu ID by location
		$menu_id = $locations['primary'];
		
		// Get the menu object by ID
		$menu = wp_get_nav_menu_object($menu_id);
		
		// Get the ACF field value
		$menu_type = get_field('site_menu_type', $menu);

		// Store the value in a WordPress option
		if (!empty($menu_type)) {
            update_option('current_menu_type', $menu_type);
        }
		
		// Append the custom class to the existing menu class
		if (!empty($menu_type)) {
			$args['menu_class'] .= ' ' . esc_attr($menu_type);
		}

		if (!empty($menu_type) && $menu_type == 'horizontal') {
			$args['walker'] = new Mega_Walker_Nav_Menu();
		}
	}
	
	return $args;
}

// Menu Nav Items for Primary
add_filter('wp_nav_menu_objects', 'primary_menu_objects', 10, 2);
function primary_menu_objects( $items, $args ) {
    
    foreach( $items as &$item ) {
        
        // vars
        $type = get_field('children_type', $item);
        $icon = get_field('icon', $item);
        $description = get_field('description', $item);
		$link_type = get_field('link_type', $item);
        
		// append type
		if( !empty($type) ) {
			$item->classes[] = $type;
		}

		// append menu type
		if( !empty($link_type) ) {
			if( $link_type == 'button' ) {
				$item->classes[] = 'nav-button';
			}
			if( $link_type == 'disable' ) {
				$item->classes[] = 'disabled';
			}
		}
        
        // append icon
        if( $icon ) {
            $item->title .= $icon;

			$item->classes[] = 'has-icon';
        }
        
		// store description in a custom field
        if( $description ) {
            $item->description = $description;
			$item->classes[] = 'has-description';
        }
    }
    
    // return
    return $items;
}

// Use the walker_nav_menu_start_el filter to append the description
add_filter('walker_nav_menu_start_el', 'append_description_to_menu', 10, 4);
function append_description_to_menu($item_output, $item, $depth, $args) {
    // Check if the item has a description
    if (!empty($item->description)) {
        // Find the position of the closing </a> tag
        $pos = strpos($item_output, '</a>');

        // If the closing </a> tag is found, insert the description after it
        if ($pos !== false) {
            $item_output = substr_replace($item_output, '<span class="description">'. $item->description . '</span>', $pos + 4, 0);
        }
    }

    return $item_output;
}
