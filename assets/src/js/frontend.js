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
import { popup } from "./components/popup.js";
import { blocks } from "./components/blocks.js";
import { initSlideShows } from "./components/slideshow.js";
import { mobileMenu, primaryMenuSubmenus } from "./components/navigation.js";
import { tabToggle } from "./components/tab.js";
import { dialogModal } from "./components/dialog.js";
import { statNumberAnimation } from "./components/animation.js";
import { accordionAnimation } from "./components/accordion.js";

/**
 * JS
 */
$(function () {
  console.log("Atlas Vite + WordPress loaded!");
  popup();
  initSlideShows();
  blocks();
  mobileMenu();
  primaryMenuSubmenus();
  tabToggle();
  dialogModal();
  statNumberAnimation();
  accordionAnimation();
});

// Reinitialize popups after FacetWP reloads
$(document).on("facetwp-loaded", function () {
  dialogModal();
});
