<?php
/**
 * Template Files - Styleguide Page
 * Template Name: Styleguide
 * 
 * @package mingo
 */

get_header(); 
?>

<section class="styleguide__wrapper">
	<div class="container styleguide__container">
		<div class="styleguide__grid">
			<aside class="styleguide__aside">
				<h3 class="styleguide__title">Styleguide</h3>
				<ul class="navigation">
					<li class="navigation__item">
						<span class="title">Guide</span>
						<ul class="navigation__sub-menu">
							<li class="navigation__sub-item">
								<a href="#typography" class="navigation__sub-link">Typography</a>
							</li>
							<li class="navigation__sub-item">
								<a href="#colors" class="navigation__sub-link">Colors</a>
							</li>
							<li class="navigation__sub-item">
								<a href="#layout-grid" class="navigation__sub-link">Layout & Grid</a>
							</li>
							<li class="navigation__sub-item">
								<a href="#icons" class="navigation__sub-link">Icons</a>
							</li>
						</ul>
					</li>

					<li class="navigation__item">
						<span class="title">Components</span>
						<ul class="navigation__sub-menu">
							<li class="navigation__sub-item">
								<a href="#buttons" class="navigation__sub-link">Buttons</a>
							</li>
							<li class="navigation__sub-item">
								<a href="#forms" class="navigation__sub-link">Forms</a>
							</li>
							<li class="navigation__sub-item">
								<a href="#cards" class="navigation__sub-link">Content</a>
							</li>
						</ul>
					</li>
				</ul>
			</aside>
			
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

				<section id="layout-grid" class="styleguide__section styleguide--grid">
					<h2 class="section-title">Layout & Grid</h2>
					<div class="styleguide-section__grid">
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
	</div>
</section>

<script>
// Get all navigation links and sections
const navLinks = document.querySelectorAll('.navigation__sub-link');
const sections = document.querySelectorAll('.styleguide__section');

// Function to remove active class from all nav items
function removeActiveClasses() {
    document.querySelectorAll('.navigation__sub-item').forEach(item => {
        item.classList.remove('active');
    });
}

// Function to add active class to a specific nav item
function setActiveLink(id) {
    removeActiveClasses();
    const activeLink = document.querySelector(`.navigation__sub-link[href="#${id}"]`);
    if (activeLink) {
        // Get the parent .navigation__sub-item and add active class
        const navItem = activeLink.closest('.navigation__sub-item');
        if (navItem) {
            navItem.classList.add('active');
        }
    }
}

// Smooth scroll on click
navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = link.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);
        
        if (targetSection) {
            targetSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            setActiveLink(targetId);
        }
    });
});

// Intersection Observer for scroll detection
const observerOptions = {
    root: null,
    rootMargin: '-20% 0px -70% 0px',
    threshold: 0
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            setActiveLink(entry.target.id);
        }
    });
}, observerOptions);

// Observe all sections
sections.forEach(section => {
    observer.observe(section);
});

// Set initial active state on page load
window.addEventListener('load', () => {
    const hash = window.location.hash.substring(1);
    if (hash) {
        setActiveLink(hash);
    } else {
        // Set first link as active if no hash
        if (sections.length > 0) {
            setActiveLink(sections[0].id);
        }
    }
});
</script>

<?php get_footer(); ?>
