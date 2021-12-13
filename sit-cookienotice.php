<?php
/**
 * Plugin Name: SIT cookienotice
 * Description: Cookie lišta pro Wordpress
 * Version: 1.0.1
 * Author: SIT:Jaroslav Dvořák
 **/

// Cesta k pluginu
if ( !defined('SCN_PLUGIN_PATH') ) {
    define( 'SCN_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );
}

// Assets

// Default CSS
add_action( 'wp_enqueue_scripts', 'scn_styles', 99 );
function scn_styles() {
    wp_enqueue_style( 'cookieconsent-css', SCN_PLUGIN_PATH . 'assets/cookieconsent.css' );
}

//Javascript
// Check if custom config file exists
if ( file_exists( get_template_directory_uri() . "/cookieconsent-config.js" ) ) {
    $config_path = get_template_directory_uri() . "/cookieconsent-config.js";
}
else {
    $config_path = SCN_PLUGIN_PATH . 'cookieconsent-config.js';
}
// Add this
add_action('wp_footer', 'scn_add_scripts');
function scn_add_scripts() {
    wp_enqueue_script( 'cookieconsent-js', SCN_PLUGIN_PATH . 'assets/cookieconsent.js' );
    wp_enqueue_script( 'cookieconsent-config', SCN_PLUGIN_PATH . 'cookieconsent-config.js' );
}
