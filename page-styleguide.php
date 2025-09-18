<?php
/**
 * Template Files - Styleguide Page
 * Template Name: Styleguide
 * 
 * @package mingo
 */

get_header(); 
?>

<style>
.sg-wrapper .grid {
	> div {
		border-radius: 6px;
		padding: 8px 12px;
		text-align: center;
		background-color: #eee;
	}
}
.btn-group {
	margin: 0 0 12px;
}

.btn-group i {
	font-size: 24px;
}
.color-block {
	aspect-ratio: 1/1;
	padding: 30px;
	display: flex;
	justify-content: center;
	align-items: center;
	font-size: 18px;
	text-align: center;
	border-radius: 6px;
	min-width: 200px;
	color: white;
}
</style>

<div class="wrapper sg-wrapper block-wrapper">
	<div class="container sg-container block-container">
		<div class="sg-content">
			<div class="wysiwyg__grid content-left">
				<h1 class="no-top-margin">Styleguide</h1>
				<h6>Source Sans 3</h6>
				<h5 class="no-top-margin">Aa Bb Cc Dd Ee Ff Gg Hh Ii Jj Kk Ll Mm Nn Oo Pp Qq Rr Ss Tt Uu Vv Ww Xx Yy Zz</h5>
				<h1>Headline (H1)</h1>
				<h2>Headline (H2)</h2>
				<h3>Headline (H3)</h3>
				<h4>Headline (H4)</h4>
				<h5>Headline (H5)</h5>
				<h6>Headline (H6)</h6>
				<p>WYSIWYG <strong>bold</strong> <em>italic</em> <u>underline</u> <del>strikethrough</del> link, consectetur adipiscing elit. Sed eleifend augue vehicula, semper tortor vitae, dapibus dui. Ut id dui id ante semper eleifend vel et erat. Vestibulum sodales sed nibh quis porttitor. Nunc quis mattis arcu, sed finibus urna.</p>
				<p>Ut id dui id ante semper eleifend vel et erat. Vestibulum sodales sed nibh quis porttitor. Nunc quis mattis arcu, sed finibus urna. Morbi quis commodo orci, a scelerisque mi. Maecenas at elit ex.</p>
				<ul>
					<li>Bulleted List Item</li>
					<li>Bulleted List Item</li>
				</ul>
				<ol>
					<li>Numbered List Item</li>
					<li>Numbered List Item</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="wrapper sg-wrapper block-wrapper">
	<div class="container sg-container block-container">
		<h2>Button</h2>
		<div class="btn-group">
			<a class="btn" href="#">Button</a>
			<a class="btn btn__outline" href="#">Button Outline</a>
			<a class="btn btn__primary" href="#">Button Primary</a>
			<a class="btn btn__secondary" href="#">Button Secondary</a>
			<a class="btn btn__accent" href="#">Button Accent</a>
			<a class="btn btn__ghost" href="#">Button Ghost</a>
			<a class="btn" href="#">Button<span class="icomoon icon-close-circle"></span></a>
		</div>

		<div class="btn-group">
			<a class="btn btn__link" href="#">Button Link</a>
		</div>

		<div class="btn-group">
			<a class="btn btn__small" href="#">Button Small</a>
			<a class="btn btn__large" href="#">Button Large</a>
		</div>
	</div>	
</div>

<div class="wrapper sg-wrapper block-wrapper">
	<div class="container sg-container block-container">
		<h2>Icon</h2>
		<div class="btn-group">
			<i class="fa-solid fa-close"></i>
			<i class="fa-solid fa-circle-xmark"></i>
			<i class="fa-solid fa-bars"></i>
			<i class="fa-solid fa-link"></i>
			<i class="fa-solid fa-arrow-right"></i>
			<i class="fa-solid fa-calendar-days"></i>
			<i class="fa-solid fa-calendar"></i>
			<i class="fa-solid fa-checkmark"></i>
			<i class="fa-solid fa-chevron-down"></i>
			<i class="fa-solid fa-chevron-left"></i>
			<i class="fa-solid fa-chevron-right"></i>
			<i class="fa-solid fa-cookie"></i>
			<i class="fa-solid fa-globe-stand"></i>
			<i class="fa-solid fa-house"></i>
		</div>
	</div>
</div>

<div class="wrapper sg-wrapper block-wrapper">
	<div class="container sg-container block-container">
		<h2>Colors</h2>
		<div class="btn-group">
			<div class="color-block bg-primary">Primary</div>
			<div class="color-block bg-secondary">Secondary</div>
			<div class="color-block bg-accent">Accent</div>
		</div>
	</div>
</div>

<div class="wrapper sg-wrapper block-wrapper">
	<div class="container sg-container block-container">
		<h2>Grid</h2>
		<div class="grid grid-cols-12">
			<div>01</div>
			<div>02</div>
			<div>03</div>
			<div>04</div>
			<div>05</div>
			<div>06</div>
			<div>07</div>
			<div>08</div>
			<div>09</div>
			<div>10</div>
			<div>11</div>
			<div>12</div>
		</div>
	</div>	
</div>

<?php get_footer(); ?>
