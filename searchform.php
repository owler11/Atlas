<?php
/**
 * Template Files - Search Form
 * 
 * @package mingo
 */

?>

<form role="search" method="get" class="search-form custom" action="<?php echo home_url( '/' ); ?>"> 
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search', 'label' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search', 'label' ) ?>" />
    </label>
    <button class="search-submit" arial-label="Submit">
        <i class="fa-solid fa-search"></i>
        <span class="sr-only">Search</span>
    </button>
</form>