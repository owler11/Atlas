<?php
/**
 * Functions Hook
 * 
 * @package mingo
 */

/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
TABLE OF CONTENTS: 
1.0 - Theme Activation
--------------------------------------------------------------*/


// 1.0 - Theme Activation
add_action('after_switch_theme', 'notify_on_theme_activation');

function notify_on_theme_activation() {
    // Get the current site URL
    $site_url = get_site_url();
    
    // Get the admin email (you can replace it with your own if needed)
    $admin_email = get_option('admin_email');
    
    // Set the email to notify
    $to = 'hosting@seekbrevity.com';  // Replace with your email
    
    // Set subject and message
    $subject = 'Theme Activated';
    $message = "The theme has been activated on the following site: \n\n" . $site_url . "\n\n";
    
    // Optional: Add other info like server details, IP address, etc.
    $message .= "Admin Email: " . $admin_email . "\n";
    $message .= "Server IP: " . $_SERVER['SERVER_ADDR'] . "\n";
    $message .= "User IP: " . $_SERVER['REMOTE_ADDR'] . "\n";

    // Set email headers (from email can be customized)
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    // Send the email
    wp_mail($to, $subject, $message, $headers);
}