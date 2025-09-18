<?php
/**
 * Template Parts - Components - Single Links
 * 
 * @package mingo
 * 
 */

if (isset($args) && $args) {
	$id	= $args['id'];
} else {
	$id = get_the_ID();
}

$link 		    = get_field('link', $id);
$file 		    = get_field('file', $id);
$link_text	    = get_field('link_text', $id);

if($file) {
    $link_url   = $file['url'];
} elseif($link && $link['url'] !== '#') {
    $link_url   = $link['url'];
} else {
    $link_url   = get_the_permalink($id);
}

$link_text_val 	= ($link_text) ? $link_text : 'Learn More';
$link_target    = ($link && $link['target']) ? $link['target'] : '_self';
$download       = ($file) ? ' download' : '';