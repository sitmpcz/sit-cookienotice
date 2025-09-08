<?php
/**
 * Plugin Name: SIT cookienotice
 * Description: Cookie lišta pro Wordpress
 * Version: 3.0.0
 * Author: SIT:Jaroslav Dvořák
 **/

// Cesta k pluginu
if ( !defined('SCN_PLUGIN_PATH') ) {
    define( 'SCN_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );
}

// Assets

// Default CSS
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'cookieconsent', 'https://cookie-notice.plzen.eu/default/cookieconsent.css' );
}, 99 );

//Javascript
add_action('wp_footer', function() {
    wp_enqueue_script( 'cookienotice', 'https://cookie-notice.plzen.eu/default/cookieconsent.js' );
} );

add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if ('cookienotice' === $handle) {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}, 10, 3 );

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
