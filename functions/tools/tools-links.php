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
function getButton($btnArr = [], $linkClass = "") {
	if ($btnArr) {
		return '
		<a
	        href="'.$btnArr["url"].'"
	        class="btn '.$linkClass.'"
	        target="'.$btnArr["target"].'"
	    >
	    	'.$btnArr["title"].'
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
	        target="'.$btnArr["target"].'"
	    >
	    	'. $btnArr["title"] . $icon .'
	    </a>
	    ';
	}
}
