<?php
/**
 * Template Parts - Block - Settings
 * 
 * @package atlas
 * 
 * info: Handles Class & ID names
 */

// Block Anchor
$id = $className.'-'.$block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Block Class
if( !empty($block['className']) ) {
    $blockName = $block['className'] . ' ' . $blockName;
}