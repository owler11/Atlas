/**
 * SASS
 */
import '../sass/frontend.scss';

/**
 * Node Modules
 */
import jQuery from 'jquery';
import 'slick-carousel';
import 'magnific-popup';

// Make jQuery available globally
window.jQuery = jQuery;
window.$ = jQuery;

/**
 * Components
 */
import { popup } from './components/popup.js';
import { blocks } from './components/blocks.js';
import { initSlideShows } from './components/slideshow.js';
import { menuWalker, mobileMenu, menuChildrenToggle, searchToggle, menuDrilldown } from './components/navigation.js';
// import { videoPlyr } from './components/video.js';
import { tabToggle } from './components/tab.js';
import { dialogModal } from './components/dialog.js';
import { statNumberAnimation } from './components/animation.js';
import { accordionAnimation } from './components/accordion.js';

/**
 * JS
 */
$(function() {
    popup();
    initSlideShows();
    blocks();
    menuWalker();
    mobileMenu();
    menuChildrenToggle();
    searchToggle();
    // videoPlyr();
    menuDrilldown();
    tabToggle();
    dialogModal();
    statNumberAnimation();
    accordionAnimation();
});

// Reinitialize popups after FacetWP reloads
$(document).on('facetwp-loaded', function() {
    dialogModal();
});