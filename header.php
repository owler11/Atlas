<?php
/**
 * Template Files - Header
 * 
 * @package mingo
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<!-- Meta Info
	================================================== -->	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Favicons
	================================================== -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo( 'template_url' ); ?>/assets/public/images/apple-touch-icon.png">
	<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/assets/public/images/favicon.png">
	<link rel="mask-icon" href="<?php bloginfo( 'template_url' ); ?>/assets/public/images/favicon.png" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

	<!-- Header Functions
	================================================== -->
	<script>
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'atlas' ); ?></a>

	<?php get_template_part( 'template-parts/layout/header/header', 'message-bar'  ); ?>
	<?php get_template_part( 'template-parts/layout/header/header', 'popup'  ); ?>
	<?php get_template_part( 'template-parts/layout/header/header', 'utility'  ); ?>
	<?php get_template_part( 'template-parts/layout/header/header', 'cookie'  ); ?>
	<?php get_template_part( 'template-parts/layout/header/header', 'masthead'  ); ?>

	<main id="content">
