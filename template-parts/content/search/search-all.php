<?php
/**
 * Template Parts - Search - Search All
 * 
 * @package mingo
 */

$search_term = $_GET['s'];

function perform_search_query($post_type, $posts_per_page, $search_term) {
    $args = array(
        'posts_per_page'    => $posts_per_page,
        'post_type'         => $post_type,
        's'                 => $search_term,
        'relevanssi'        => true,
        'facetwp'           => true
    );

    $query = new WP_Query();
    $query->parse_query($args);
    relevanssi_do_query($query);

    return $query;
}

$post_query         = perform_search_query('post', 3, $search_term);
$event_query        = perform_search_query('events', 3, $search_term);
$people_query       = perform_search_query('people', 4, $search_term);
$page_query         = perform_search_query('page', 6, $search_term);

function render_search_results($query, $title, $facet, $post_count_threshold, $template_part, $grid_class) {
    $post_type_link = get_post_type_archive_link($facet);
    if ($query->have_posts()) {
        $post_count = $query->found_posts;
        echo '<div class="search__' . esc_attr($facet) . ' search-group">';

            echo '<div class="group-headline">';
        
                echo '<h4 class="headline">' . esc_html($title) . ' <span class="number">' . esc_html($post_count) . '</span></h4>';
            
                if ($post_count > $post_count_threshold) {
                    echo '<div class="link-wrapper"><a class="btn btn__outline" href="'. $post_type_link .'">All ' . esc_html($title) . '</a></div>';
                }

            echo '</div>';
        
            echo '<div class="post__list ' . esc_attr($grid_class) . '">';

            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/' . $template_part, '');
            }

            wp_reset_postdata();

            echo '</div>';
        echo '</div>';
    }
}

if ($post_query->have_posts() || $page_query->have_posts() || $event_query->have_posts() || $people_query->have_posts()) {
    render_search_results($post_query, 'Blog', 'post', 3, 'post/post-teaser-card', '');
    render_search_results($event_query, 'Events', 'events', 3, 'events/events-teaser-card', '');
    render_search_results($people_query, 'People', 'people', 4, 'people/people-teaser-card', '');
    render_search_results($page_query, 'Pages', 'page', 4, 'search/search-teaser', '');
} else {
    get_template_part('template-parts/content/content', 'none');
}