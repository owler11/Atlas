<?php
/**
 * Template Parts - Block - People
 * 
 * @package mingo
 */

// Gutenberg Preview Image
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
    return;
}

// Block Class
$className = 'people';
$blockName = 'block';

include dirname(__FILE__) . '/../components/block-settings.php';

// ACF Fields
$fields     = get_fields();
$people     = $fields['people'] ?? '';

$padding_top    = $fields['padding_top'] ?? 'medium';
$padding_bottom = $fields['padding_bottom'] ?? 'medium';
$theme          = $fields['theme'] ?? 'default';
?>

<section id="<?php echo esc_attr($id); ?>" class="wrapper <?php echo $className; ?>__wrapper <?php echo $blockName; ?>__wrapper theme-<?php echo $theme; ?> padding-t-<?php echo $padding_top; ?> padding-b-<?php echo $padding_bottom; ?>">
	<div class="container <?php echo $className; ?>__container">

        <?php
        if($people) :
            // Convert array of post IDs to WP_Query
            $people_query = new WP_Query(array(
                'post_type'     => 'people',
                'post__in'      => $people,
                'post_status'   => 'publish',
                'orderby'       => 'post__in'
            ));
        ?>
        <div class="grid <?php echo $className; ?>-grid">
            
            <?php
            if($people_query->have_posts()) :
                while($people_query->have_posts()) : $people_query->the_post();
                    include( locate_template( 'template-parts/' . get_post_type() . '/' . get_post_type() . '-teaser.php', false, false) );
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            
        </div>
        <?php
        endif;
        ?>
    </div>
</section>