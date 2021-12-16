<?php
/**
 * Plugin Name: SIT cookienotice
 * Description: Cookie lišta pro Wordpress
 * Version: 1.2.0
 * Author: SIT:Jaroslav Dvořák
 **/

// Cesta k pluginu
if ( !defined('SCN_PLUGIN_PATH') ) {
    define( 'SCN_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );
}

require "cookie-config.php";
require "put-js-config.php";

// Vytvorime JS s konfiguraci
scn_put_js_config( $cookie_config );

// Assets

// Default CSS
add_action( 'wp_enqueue_scripts', 'scn_styles', 99 );
function scn_styles() {
    wp_enqueue_style( 'cookieconsent-css', SCN_PLUGIN_PATH . 'assets/cookieconsent.css' );
}

//Javascript

// Prepare file path to check
//$location = get_template_directory_uri();
//$location = str_replace( "http://", "", $location );
//$location = str_replace( "https://", "", $location );
//$location = str_replace( $_SERVER['HTTP_HOST'], "", $location );
//$location = $_SERVER['DOCUMENT_ROOT'] . $location;
//$filename = $location . "/cookie-config.js";

// Check if custom config file exists
// Mame vygenerovany JS config z ulozenych dat v admin?
//if ( file_exists( $filename ) ) {
    $config_path = get_template_directory_uri() . "/cookie-config.js";
//}
// Pokud ne, vlozime nejaky zaklad
//else {
//    $config_path = SCN_PLUGIN_PATH . 'cookie-config.js';
//}
//clearstatcache();

// Add this
add_action('wp_footer', function() use ( $config_path ) {
    // Vendor
    wp_enqueue_script( 'cookienotice-js', SCN_PLUGIN_PATH . 'assets/cookieconsent.js' );
    // Config
    $digits = 3;
    // Anti cache
    $rn = rand( pow( 10, $digits - 1 ), pow (10, $digits ) - 1 );
    wp_enqueue_script( 'cookie-config', $config_path, [], "1.0." . $rn );
} );

// Ulozene JS sledovaci kody vlozime tam, kam patri :)

// Add JS to head
add_action( "wp_head", function() {
    $scn_head = get_option("scn_head");
    if ( $scn_head && !current_user_can( 'administrator' ) && !current_user_can( 'editor' ) ) {
        echo wp_unslash( $scn_head );
    }
}, 99, 0 );

// Add JS to footer
add_action( "wp_footer", function() {
    $scn_footer= get_option("scn_footer");
    if ( $scn_footer && !current_user_can( 'administrator' ) && !current_user_can( 'editor' ) ) {
        echo wp_unslash( $scn_footer );
    }
}, 99, 0 );

// Odkaz na stranku naseho nastaveni v admin
// Submenu Hlavniho nastaveni
add_action( 'admin_menu', 'scn_add_admin_plugin_menu' );

function scn_add_admin_plugin_menu(){

    add_submenu_page(
        'options-general.php',
        'SIT Cookie notice',
        'SIT Cookie notice',
        'administrator',
        'scn-settings',
        'scn_add_admin_plugin_page' );

    //call register settings function
    add_action( 'admin_init', 'scn_register_plugin_settings' );
}

function scn_register_plugin_settings(){

    register_setting( "scn_options", "scn_head" );
    register_setting( "scn_options", "scn_footer" );
    register_setting( "scn_options", "scn_config" );

}

// Stranka nastaveni pluginu
function scn_add_admin_plugin_page(){
    require_once __DIR__ . "/views/admin-option-page.php";
}

// Ty textarea potrebujeme trochu chytrejsi :) Aby umeli editovat zdrojovy kod:
// Code hightlights
add_action( 'admin_enqueue_scripts', 'scn_add_page_scripts_enqueue_script' );

function scn_add_page_scripts_enqueue_script( $hook ) {

    if( 'settings_page_scn-settings' === $hook ) {
        wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
        wp_enqueue_script( 'js-code-editor', SCN_PLUGIN_PATH . 'assets/code-editor.js', array( 'jquery' ), '', true );

    }
}

// Jakmile zmenime nastaveni v admin, vygenerujeme soubor cookie-config.js
// After save options
add_action( 'updated_option', function( $option_name, $old_value, $value ) use ( $cookie_config ) {

    scn_put_js_config( $cookie_config );

}, 10, 3 );
