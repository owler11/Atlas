/**
 * SASS
 */
import '../sass/backend.scss';

/**
 * Node Modules
 */
import 'slick-carousel';
import 'magnific-popup';

/**
 * Components
 */
import { blocks } from './components/blocks.js';

import { tabToggle } from './components/tab.js';
import { accordionAnimation } from './components/accordion.js';

/**
 * JS
 */
const $ = require('jquery');

$(function () {
  blocks();
  // videoPlyr();

  tabToggle();
  accordionAnimation();

  // Initialize dynamic block preview (editor).
  if (window.acf) {
    // window.acf.addAction( 'render_block_preview/type=video', videoPlyr );
  }
});
