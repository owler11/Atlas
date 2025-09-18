<?php
/**
 * Template Parts - Block - Grid Icon
 * 
 * @package mingo
 */

$h_activate       = $heading['activate'];
$h_title          = $heading['title'];
$h_headline       = $heading['headline'];
$h_description    = $heading['description'];
$h_buttons        = $heading['buttons'];
$h_align          = $heading['text_align'];

if($h_activate) :
?>
    <div class="<?php echo $className; ?>__heading <?php echo $blockName; ?>__heading heading-<?php echo $h_align; ?>">
        <?php
        if($h_title) {
            echo '<h4 class="title">'. $h_title .'</h4>';
        }

        if($h_headline) {
            echo '<h2 class="headline">'. $h_headline .'</h2>';
        }
        
        if($h_description) {
            echo '<div class="description">'. $h_description .'</div>';
        }

        if($h_buttons) {
            echo '<div class="btn-group">';

            foreach($h_buttons as $button) {
                $b_link    = $button['link'];
                $b_type    = $button['type']; 

                echo getButton($b_link, 'btn__' . $b_type);
            }

            echo '</div>';
        }
        ?>
    </div>
<?php endif; ?>