<?php
/**
 * Plugin Name: Enhanced Crochet Posts
 * Plugin URL: https://www.stitchesandstrands.com
 * Text Domain: Enhanced Crochet Posts
 * Domain Path: /languages/
 * Description: Customize blog articles
 * Version: 1.2.0
 * Author: Rakayah Davidson
 * Author URI: https://www.stitchesandstrands.com
 * Contributors: Harminder kaur
 */

if (!defined('WPBAW_DIR')) {
    define('WPBAW_DIR', dirname(__FILE__)); // Plugin directory
    
}
if (!defined('PLUGIN_NAME')) {
    define('PLUGIN_NAME', "enhanced-crochet-posts"); // Plugin name
    
}
if (!defined('IMAGES')) {
    define('IMAGES', '/wp-content/plugins/' . PLUGIN_NAME . '/public/'); // image directory
}

include (WPBAW_DIR . '/include/functions.php'); // add functions to admin post page functionality
include (WPBAW_DIR . '/include/ajax.php');      // send and post data to db
include (WPBAW_DIR . '/include/metabox.php');   // add metabox to admin post page


/**
 * frontend code
 */
function frontend_code($content) {
    if(get_post_type()=='post') {
        if (!in_the_loop()) {
            return $content;
        }
        if (!is_singular()) {
            return $content;
        }
        if (!is_main_query()) {
            return $content;
        }
        $content.= include (WPBAW_DIR . '/include/frontpage.php');
        remove_filter('the_content', 'frontend_code');
        return '<div id="data_content">' . $content . '</div>';
    }
}
add_filter('the_content', 'frontend_code');


/**
 * Proper way to enqueue scripts and styles
 */
function wpdocs_theme_name_scripts() {
    
    wp_enqueue_script('custom_kit', "https://kit.fontawesome.com/a17a6a2519.js");
    wp_enqueue_style('custom_made', plugins_url('/public/css/style.css', __FILE__));
    wp_enqueue_script('custom_jquery', plugins_url('/public/js/jquery.min.js', __FILE__));
    wp_enqueue_script('custom_js', plugins_url('/public/js/popup.js', __FILE__));
}
add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts');
