<?php
/**
 * Widgets
 *
 * @package mingo
 */
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Stock Photography
--------------------------------------------------------------*/



// 1.0 - Stock Photography
function stock_photography_dashboard_widget() {
    echo '<p>Looking for stock photography? Here are some great resources:</p>';
    echo '<ul>
            <li><a href="https://unsplash.com/" target="_blank">Unsplash</a></li>
            <li><a href="https://www.pexels.com/" target="_blank">Pexels</a></li>
            <li><a href="https://pixabay.com/" target="_blank">Pixabay</a></li>
          </ul>';
}

function add_stock_photography_dashboard_widget() {
    wp_add_dashboard_widget(
        'stock_photography_widget',         // Widget slug.
        'Stock Photography Resources',      // Title.
        'stock_photography_dashboard_widget' // Display function.
    ); 
}
add_action('wp_dashboard_setup', 'add_stock_photography_dashboard_widget' );
