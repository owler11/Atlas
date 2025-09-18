<?php
/**
 * Template Parts - Components - Social Share
 * 
 * @package mingo
 * 
 * $currentUrl => get_the_permalink()
 * $subject => Yoast Title ??? Post Title
 * $excerpt => Yoast excerpt ??? Summary ??? get_the_excerpt()
 */


$currentUrl = get_the_permalink();
$subject = get_the_title();

if (has_excerpt() ) :
    $excerpt = get_the_excerpt();
else :
    $excerpt = '';
endif;

$mailtoTitle = $subject;
$mailtoURL = $currentUrl;
$mailtoBody = $mailtoTitle . '%0A' . $mailtoURL;

$socials = array(
    'facebook' => array(
        'name' => 'facebook',
        'icon' => 'fa-brands fa-facebook-f',
        'base' => 'https://www.facebook.com/sharer/sharer.php?u='.$currentUrl
    ),
    'twitter' => array(
        'name' => 'twitter',
        'icon' => 'fa-brands fa-x-twitter',
        'base' => 'https://twitter.com/intent/tweet?text='.$currentUrl
    ),
    'linkedin' => array(
        'name' => 'linkedin',
        'icon' => 'fa-brands fa-linkedin-in',
        'base' => 'https://www.linkedin.com/shareArticle?mini=true&url='.$currentUrl,
        'details' => array(
            'subject' => '&title='.urlencode($subject),
            'body' => '&summary='.urlencode($excerpt),
        ),
    ),
    'email' => array(
        'name' => 'email',
        'icon' => 'fa-solid fa-envelope',
        'base' => 'mailto:your@friend.com',
        'details' => array(
            'subject' => '?subject=Check%20this%20out!',
            'body' => '&body='.$mailtoBody,
        ),
    ),
);

$url = get_permalink(get_the_ID());
?>

<div class="social-share">

    <?php
    foreach ($socials as $social){
        $shareURL = $social['base'];

        if (isset($social['details'])){
            $shareURL .= $social['details']['subject'];
            $shareURL .= $social['details']['body'];
        }

        echo '
        <a href="'. $shareURL .'" target="_blank" class="'. $social['name'] .'">
            <i class="'.$social['icon'].'"></i>
        </a>
        ';
    }
    ?>

</div>