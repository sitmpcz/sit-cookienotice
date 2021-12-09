<?php
/**
 * Plugin Name: SIT cookienotice
 * Description: Lepší adresy pro CPT a taxonomy
 * Version: 1.0.0
 * Author: SIT:Jaroslav Dvořák
 **/

// Cesta k pluginu
if ( !defined('SCN_PLUGIN_PATH') ) {
    define( 'SCN_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );
}

// Assets
add_action( 'wp_enqueue_scripts', 'scn_styles', 99 );
function scn_styles() {
    wp_enqueue_style( 'cookieconsent', SCN_PLUGIN_PATH . 'assets/cookieconsent.css' );
}

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

add_action('wp_body_open', 'scn_scripts');
function scn_scripts() {
    echo '<script defer src="' . SCN_PLUGIN_PATH . 'assets/cookieconsent.js"></script>';
    echo '<script defer src="' . SCN_PLUGIN_PATH . 'config.js"></script>';
}
