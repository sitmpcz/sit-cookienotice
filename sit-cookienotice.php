<?php
/**
 * Plugin Name: SIT cookienotice
 * Description: Cookie lišta pro Wordpress
 * Version: 1.0.4
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

// Prepare file path to check
$location = get_template_directory_uri();
$location = str_replace( "http://", "", $location );
$location = str_replace( "https://", "", $location );
$location = str_replace( $_SERVER['HTTP_HOST'], "", $location );
$location = $_SERVER['DOCUMENT_ROOT'] . $location;
$filename = $location . "/cookienotice-config.js";

// Check if custom config file exists
if ( file_exists( $filename ) ) {
    $config_path = get_template_directory_uri() . "/cookienotice-config.js";
}
else {
    $config_path = SCN_PLUGIN_PATH . 'cookieconsent-config.js';
}
clearstatcache();

// Add this
add_action('wp_footer', function() use ( $config_path ) {
    wp_enqueue_script( 'cookienotice-js', SCN_PLUGIN_PATH . 'assets/cookieconsent.js' );
    wp_enqueue_script( 'cookienotice-config', $config_path );
} );
