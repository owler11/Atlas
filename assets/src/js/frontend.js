/**
 * SASS
 */
import "../sass/frontend.scss";

/**
 * Node Modules
 */
import $ from "jquery";
import "slick-carousel";
import "magnific-popup";

// Make jQuery available globally
window.jQuery = jQuery;
window.$ = jQuery;

/**
 * Components
 */
import { slickSliders } from "./components/slider.js";
import { mobileMenu, primaryMenuSubmenus } from "./components/navigation.js";
import { toggleSearch } from "./components/toggle.js";
import { tabToggle } from "./components/tab.js";
import { dialogModal } from "./components/dialog.js";
import { statNumberAnimation } from "./components/animation.js";
import { accordionAnimation } from "./components/accordion.js";

/**
 * JS
 */
$(function () {
	console.log("Atlas Vite + WordPress loaded!");
	slickSliders();
	mobileMenu();
	primaryMenuSubmenus();
	toggleSearch();
	tabToggle();
	dialogModal();
	statNumberAnimation();
	accordionAnimation();
});

// Reinitialize popups after FacetWP reloads
$(document).on("facetwp-loaded", function () {
	dialogModal();
});
