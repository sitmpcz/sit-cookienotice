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
    wp_enqueue_style( 'cookieconsent-css', SCN_PLUGIN_PATH . 'assets/cookieconsent.css' );
}
add_action('wp_footer', 'scn_add_scripts');
function scn_add_scripts() {
    wp_enqueue_script( 'cookieconsent-js', SCN_PLUGIN_PATH . 'assets/cookieconsent.js' );
    wp_enqueue_script( 'cookieconsent-config', SCN_PLUGIN_PATH . 'config.js' );
}
