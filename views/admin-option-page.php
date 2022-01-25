<?php

$scn_head = get_option("scn_head");
$scn_footer = get_option("scn_footer");

$scn_cookie_version = get_option("scn_cookie_version");
$scn_config_url = get_option("scn_config_url");

if ( $scn_config_url != "" ) {
    $scn_config_marketing = false;
    $scn_config_ga = false;
}

// Check if Polylang is there
if ( function_exists( 'pll_the_languages' ) ) {
    $langs = pll_the_languages( array( "raw" => 1 ) );
}
?>
<div class="wrap">
    <h1>Nastavení SIT Cookie notice</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields("scn_options");
        do_settings_sections("scn_options");
        ?>
        <table class="form-table">
            <tr>
                <th>
                    <label style="margin-bottom: 10px;">Kódy do hlavičky</label>
                    <p style="font-weight: normal;">Atributy: type="text/plain" data-cookiecategory="analytics"</p>
                </th>
                <td>
                    <textarea id="js-code-editor-scn-head" rows="5" name="scn_head" class="widefat textarea"><?php echo wp_unslash( $scn_head ); ?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <label style="margin-bottom: 10px;">Kódy do patičky</label>
                    <p style="font-weight: normal;">Atributy: type="text/plain" data-cookiecategory="marketing"</p>
                </th>
                <td>
                    <textarea id="js-code-editor-scn-footer" rows="5" name="scn_footer" class="widefat textarea"><?php echo wp_unslash(  $scn_footer ); ?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <label style="margin-bottom: 10px;">Soubor s nastavením</label>
                </th>
                <td>
                    <p>
                        <input type="radio" name="scn_cookie_version" value="ga" id="scn_config_ga"<?php echo ( $scn_cookie_version === "ga" ) ? " checked" : ""; ?>>
                        <label for="scn_config_ga">
                            Google Analytics
                        </label>
                    </p>
                    <p>
                        <input type="radio" name="scn_cookie_version" value="marketing" id="scn_config_marketing"<?php echo ( $scn_cookie_version === "marketing") ? " checked" : ""; ?>>
                        <label for="scn_config_marketing">
                            Marketing
                        </label>
                    </p>
                    <p style="margin-bottom: 20px;">
                        <input type="radio" name="scn_cookie_version" value="custom" id="scn_config_custom"<?php echo ( $scn_cookie_version === "custom" ) ? " checked" : ""; ?>>
                        <label for="scn_config_custom">
                            Vlastní
                        </label>
                    </p>
                    <?php
                    if ( $scn_cookie_version === "custom" ) :
                        ?>
                        <p>
                            <label for="scn_config_url">Vlastní cesta k souboru s nastavením:</label><br>
                            <input type="text" name="scn_config_url" id="scn_config_url" value="<?php echo $scn_config_url; ?>" class="regular-text">
                        </p>
                    <?php
                    endif;
                    ?>
                </td>
            </tr>
            <?php
            // Polylang languages
            if ( isset( $langs ) && $langs ) :
                ?>
                <tr>
                    <th>
                        <label style="margin-bottom: 10px;">Překlady</label>
                    </th>
                    <td>
                        <?php
                        foreach ( $langs as $key => $value ) :

                            $lang_slug = mb_strtolower( $value["slug"] );
                            $val = get_option( "scn_config_lang_$lang_slug" );

                            if ( $lang_slug !== "cs" && $lang_slug !== "cz" ):
                                ?>
                                <p>
                                    <label for="scn_config_lang_<?php echo $lang_slug; ?>">Nastavení pro jazyk <?php echo $value["name"]; ?>:</label><br>
                                    <input type="text" name="scn_config_lang_<?php echo $lang_slug; ?>" id="scn_config_lang_<?php echo $lang_slug; ?>" value="<?php echo $val; ?>" class="regular-text">
                                </p>
                            <?php
                            endif;
                        endforeach;
                        ?>
                    </td>
                </tr>
            <?php
            endif;
            ?>
        </table>
        <?php
        submit_button();
        ?>
    </form>
</div>
