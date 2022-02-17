<?php
/**
 * Plugin Name: SIT cookienotice
 * Description: Cookie lišta pro Wordpress
 * Version: 2.2.5
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
    wp_enqueue_style( 'cookieconsent-css', 'https://cookie-notice.plzen.eu/cookieconsent.css' );
}

//Javascript

add_action('wp_footer', function() {

    // Vendor
    wp_enqueue_script( 'cookienotice-js', 'https://cookie-notice.plzen.eu/cookieconsent.js' );

    // Set config
    $scn_cookie_version = get_option("scn_cookie_version");
    $scn_config_url = get_option("scn_config_url");

    if ( $scn_cookie_version === "ga" ) {
        $config_url = 'https://cookie-notice.plzen.eu/cookie-config.js';
    }
    else if ( $scn_cookie_version === "marketing" ) {
        $config_url = 'https://cookie-notice.plzen.eu/cookie-market-config.js';
    }
    else if ( $scn_config_url === "custom" ) {
        $config_url = esc_url( $scn_config_url );
    }
    else {
        $config_url = '';
    }

    if ( $config_url != "" ) {
        // Translates
        if ( function_exists( 'pll_current_language' ) ) {
            $current_lang = mb_strtolower(  pll_current_language( "slug" ) );
            if ( $current_lang !== "cs" && $current_lang !== "cz" ) {
                $config_url = get_option( "scn_config_lang_$current_lang" );
            }
        }

        if ( $config_url != "" ) {
            wp_enqueue_script( 'cookienotice-config-js', $config_url );
        }
    }
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
    register_setting( "scn_options", "scn_cookie_version" );
    register_setting( "scn_options", "scn_config_url" );

    // Check if Polylang is there
    if ( function_exists( 'pll_the_languages' ) ) {
        // Language must be set
        if ( pll_current_language() !== false ) {
            $langs = pll_the_languages( array( "raw" => 1 ) );
            if ( $langs ) {
                foreach ( $langs as $key => $value ) {
                    $lang_slug = mb_strtolower( $value["slug"] );
                    if ( $lang_slug !== "cs" && $lang_slug !== "cz" ) {
                        register_setting( "scn_options", "scn_config_lang_" . $lang_slug );
                    }
                }
            }
        }
    }

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
