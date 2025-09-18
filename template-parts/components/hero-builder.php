<?php
/**
 * Template Parts - Page - Page Header
 * 
 * @package mingo
 */

$hero_builder = get_field('hero_builder');
?>

<?php
if ($hero_builder != '') :
	foreach ($hero_builder as $module) :
		$layout = str_replace('_', '-', $module['acf_fc_layout']);
		
		// Modules
		include( locate_template( 'template-parts/blocks/hero-' . $layout . '.php', false, false ) );

	endforeach;
else :
	include( locate_template( 'template-parts/blocks/hero-default.php', false, false ) );
endif;
?>