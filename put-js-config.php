<?php

function scn_put_js_config( $config = "" ) {

    $scn_config = get_option("scn_config");
    $config_js = ( $scn_config ) ? : $config;

    $location = get_template_directory_uri();
    $location = str_replace( "http://", "", $location );
    $location = str_replace( "https://", "", $location );
    $location = str_replace( $_SERVER['HTTP_HOST'], "", $location );
    $location = $_SERVER['DOCUMENT_ROOT'] . $location;
    $filename = $location . "/cookie-config.js";

    file_put_contents( $filename, $config_js );

}
