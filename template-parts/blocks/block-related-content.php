<?php
/**
 * Template Parts - Block - Related Content
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'related-content';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields             = get_fields();
$title              = $fields['title'] ?? '';
$headline           = $fields['headline'] ?? '';
$link               = $fields['link'] ?? '';
$content_type       = $fields['content_type'] ?? '';
$post_type          = $fields['post_type'] ?? '';
$manual_selection   = $fields['manual_selection'] ?? '';

$padding_top        = $fields['padding_top'] ?? 'medium';
$padding_bottom     = $fields['padding_bottom'] ?? 'medium';
$theme              = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <div class="<?php echo $className; ?>__heading <?php echo $blockName; ?>__heading heading-left">
            <?php
            if($title) :
                echo '<h4 class="title">'. $title .'</h4>';
            endif;

            if($headline) :
                echo '<h2 class="headline">'. $headline .'</h2>';
            endif;

            if($link) :
                echo '<a class="btn btn__link" href="'. $link['url'] .'" target="'. $link['target'] .'">'. $link['title'] .'<i class="fa-solid fa-arrow-right"></i></a>';
            endif;
            ?>
        </div>

        <div class="<?php echo $className; ?>-main <?php echo $blockName; ?>-main js-slider-related-content">
            <?php
            if($content_type == 'post-type') :
                $args = array(
                    'post_type'         => $post_type,
                    'posts_per_page'    => 3,
                    'order'             => 'DESC',
                    'orderby'           => 'date'
                );

                $query = new WP_Query($args);

                if($query->have_posts()) :
                    while($query->have_posts()) :
                        $query->the_post();
                        $id     = get_the_ID();
                        $args   = array(
                            'id' => $id,
                        );
                        
                        include( locate_template( 'template-parts/' . get_post_type($id) . '/' . get_post_type($id) . '-teaser.php', false, false, $args ) );

                    endwhile;
                    wp_reset_postdata();
                endif;
            elseif($content_type == 'manual') :
                if ($manual_selection) :
                    foreach ($manual_selection as $item) :
                        $post = get_post($item); 
                        setup_postdata($post); 
                        $id     = $post->ID;
                        $args   = array(
                            'id' => $id,
                        );
                      
                        include( locate_template( 'template-parts/' . get_post_type($id) . '/' . get_post_type($id) . '-teaser.php', false, false, $args ) );
                    endforeach;
                    wp_reset_postdata();
                endif;
            endif;
            ?>
        </div>
    </div>
</section>