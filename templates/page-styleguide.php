<?php
/**
 * Template Files - Styleguide Page
 * Template Name: Styleguide
 * 
 * @package atlas
 */

get_header(); 
?>

<section class="styleguide__wrapper">
	<div class="container styleguide__container">
		<main class="styleguide__main">
			<section id="typography" class="styleguide__section styleguide--grid">
				<h2 class="section-title">Typography</h2>
				<div class="type-intro">
					<div class="item">
						<p class="value" style="font-weight: 700;">Aa</p>
					</div>
					<div class="item">
						<p class="value" style="font-weight: 300;">21</p>
					</div>
					<div class="item">
						<ul>
							<li style="font-weight: 100;">Thin</li>
							<li style="font-weight: 300;">Light</li>
							<li style="font-weight: 400;">Regular</li>
							<li style="font-weight: 500;">Medium</li>
							<li style="font-weight: 600;">Semi Bold</li>
							<li style="font-weight: 700;">Bold</li>
						</ul>
					</div>
				</div>

				<div class="type-font">
					<div class="title">Sans Serif</div>
					<div class="item">
						<p class="label">Characters</p>
						<p class="value">Aa Bb Cc Dd Ee Ff Gg Hh Ii Jj Kk Ll Mm Nn Oo Pp Qq Rr Ss Tt Uu Vv Ww Xx Yy Zz</p>
					</div>
					<div class="item">
						<p class="label">Numerals</p>
						<p class="value">1 2 3 4 5 6 7 8 9 0 ! " # $ % & ' ( ) * + , - . / : ; < = > ? @ [ \ ] ^ _ ` { | } ~</p>
					</div>
				</div>

				<div class="typescale">
					<div class="title">Typescale</div>
					<div class="item">
						<h1>Headline (H1)</h1>
						<h2>Headline (H2)</h2>
						<h3>Headline (H3)</h3>
						<h4>Headline (H4)</h4>
						<h5>Headline (H5)</h5>
						<h6>Headline (H6)</h6>
						<p>Paragraph (P)</p>
					</div>
				</div>
			</section>

			<section id="colors" class="styleguide__section styleguide--grid">
				<h2 class="section-title">Colors</h2>
				<div class="color-group">
					<div class="color-block bg-primary">Primary</div>
					<div class="color-block bg-secondary">Secondary</div>
					<div class="color-block bg-accent">Accent</div>
				</div>
			</section>

			<section id="icons" class="styleguide__section styleguide--grid">
				<h2 class="section-title">Icons</h2>
				<div class="icon-list">
					<i class="fa-solid fa-close"></i>
					<i class="fa-solid fa-circle-xmark"></i>
					<i class="fa-solid fa-bars"></i>
					<i class="fa-solid fa-link"></i>
					<i class="fa-solid fa-arrow-right"></i>
					<i class="fa-solid fa-calendar-days"></i>
					<i class="fa-solid fa-calendar"></i>
					<i class="fa-solid fa-rocket-launch"></i>
					<i class="fa-solid fa-chevron-down"></i>
					<i class="fa-solid fa-chevron-left"></i>
					<i class="fa-solid fa-chevron-right"></i>
					<i class="fa-solid fa-cookie"></i>
					<i class="fa-solid fa-globe-stand"></i>
					<i class="fa-solid fa-house"></i>
				</div>
			</section>

			<section id="buttons" class="styleguide__section styleguide--grid">
				<h2 class="section-title">Buttons</h2>

				<div class="btn-group">
					<a class="btn btn__solid" href="#">Button Solid</a>
					<a class="btn btn__outline" href="#">Button Outline</a>
					<a class="btn btn__text" href="#">Button Text</a>
				</div>
			</section>

			<section id="forms" class="styleguide__section styleguide--grid">
				<h2 class="section-title">Forms</h2>
				<div class="form-group">
					<div class="item">
						<label for="name">Name</label>
						<input type="text" id="name" name="name">
					</div>
					<div class="item">
						<label for="email">Email</label>
						<input type="email" id="email" name="email">
					</div>
					<div class="item">
						<label for="message">Message</label>
						<textarea id="message" name="message"></textarea>
					</div>
					<div class="item">
						<button type="submit">Submit</button>
					</div>
				</div>

				<div class="form-group">
					<h3>Gravity Form</h3>
					<?php echo do_shortcode('[gravityform id="1" title="false"]'); ?>
				</div>
			</section>

			<section id="content" class="styleguide__section styleguide--grid">
				<h2 class="section-title">Content</h2>
				<div class="content-group">
					<div class="content-block">
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
			</section>
		</main>
	</div>
</section>


<?php get_footer(); ?>
