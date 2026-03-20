<?php
/**
 * Get Links
 *
 * @package mingo
 */
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Links & Buttons
	1.1 - getButton
	1.2 - getLink
--------------------------------------------------------------*/

// 1.0 - Links & Buttons
// 1.1 - getButton
function getButton($btnArr = [], $linkClass = "", $icon = "") {
	if ($btnArr) {
		return '
		<a
	        href="'.$btnArr["url"].'"
	        class="btn '.$linkClass.'"
	        '.(!empty($btnArr["target"]) ? 'target="'.$btnArr["target"].'"' : '').'
	    >
	    	'.$btnArr["title"].'
	    	'.$icon.'
	    </a>
	    ';
	}
}


// 1.2 - getLink
function getLink($btnArr = [], $linkClass = "", $icon = "") {
	if ($btnArr) {
		return '
		<a
	        href="'.$btnArr["url"].'"
	        class="btn btn__link '.$linkClass.'"
	        '.(!empty($btnArr["target"]) ? 'target="'.$btnArr["target"].'"' : '').'
	    >
	    	'. $btnArr["title"] . $icon .'
	    </a>
	    ';
	}
}

// 1.3 - getNavLink 
function getNavLink($linkArr = [], $linkClass = "") {
	if (empty($linkArr) || empty($linkArr['url'])) {
		return '';
	}

	$href   	= esc_url($linkArr['url']);
	$title  	= $linkArr['title'] ?? '';
	$target 	= $linkArr['target'] ?? '_self';
	$attr_class = $linkClass !== '' ? ' class="' . esc_attr($linkClass) . '"' : '';

	return '<a href="' . $href . '"' . $attr_class . ' target="' . $target . '">' . $title . '</a>';
}