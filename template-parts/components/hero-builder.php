<?php
/**
 * Template Parts - Page - Page Header
 * 
 * @package atlas
 */

$hero_builder = get_field('hero_builder') ?? [];

if ($hero_builder != '') :
	foreach ($hero_builder as $module) :
		$layout = str_replace('_', '-', $module['acf_fc_layout']);

		// Modules
		$template_path = locate_template( 'template-parts/blocks/hero-' . $layout . '.php', false, false );
		if ( $template_path ) {
			include( $template_path );
		}
	endforeach;
else :
	$default_path = locate_template( 'template-parts/blocks/hero-default.php', false, false );
	if ( $default_path ) {
		include( $default_path );
	}
endif;
?>