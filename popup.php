<?php

/**
 * Plugin Name: Pop-up Generator 
 * Description: Make your custom Pop-up at the Loader of Page
 * Version: 1.0
 * Author Name: Wajiha Ansari
 * Author URI: https://Wajiha.com
 * License: GPL2
 * Plugin URL: https://www.example.com
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    wp_die();
}

// Enqueue Admin Scripts and Styles (Both DASHBOARD + FRONTEND)
function Popup_scripts() {
    // Define the source URLs
    $src_js = plugin_dir_url(__FILE__) . 'js/main.js';
    $src_css = plugin_dir_url(__FILE__) . 'css/style.css';

    // Get the file modification times for versioning
    $src_ver_js = filemtime(plugin_dir_path(__FILE__) . 'js/main.js');
    $src_ver_css = filemtime(plugin_dir_path(__FILE__) . 'css/style.css');

    // Enqueue the java-script
    //It takes 5 Parameters
    //('handle','file path','Dependencies','Version','footer')
    //1. handle must be unique 2. source file path, 3.using any frameworks, 4. keeps on updating your files time to time, if ypu want t o add on footer]
    
    wp_enqueue_script('popup-js', $src_js, array('jquery'), $src_ver_js, true);
    // Enqueue the CSS
    wp_enqueue_style('popup-css', $src_css, array(), $src_ver_css);

    // Enqueue WordPress Media Uploader only in admin area
    if (is_admin()) {
        wp_enqueue_media();
    }
}
// Hook the function to load scripts/styles
add_action('wp_enqueue_scripts', 'Popup_scripts');
add_action('admin_enqueue_scripts', 'Popup_scripts');

// Add Menu to Sidebar in Admin Dashboard
function popup_func() {
    // Parent Menu
    add_menu_page(
        'Pop-up Gen',              // Page title
        'Pop-up Gen',              // Menu title
        'manage_options',          // Capability
        'Pop-up Gen',              // Menu slug
        'Popup_Gen_callback',      // Callback function for page content
        'dashicons-images-alt',    // Dashicon for the parent menu
        7                          // Menu position
    );
}

// Callback Function for Admin Page
function Popup_Gen_callback() {
    include "Admin/page.php";
}
add_action('admin_menu', 'popup_func');

// Frontend Display of the Pop-up
function show_popup() {
    ?>
    <div class="popup-wrapper" style="display:none;">
        <i class="close">&times;</i>
        <img src="<?php echo esc_url(get_option('pop-up-image', plugin_dir_url(__FILE__) . 'images/3.png')); ?>" alt="Popup Image">
    </div>
    <?php
}
add_action('wp_head', 'show_popup');
