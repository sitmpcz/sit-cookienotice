<?php

$scn_head = get_option("scn_head");
$scn_footer = get_option("scn_footer");

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
                    <p style="font-weight: normal;">Atributy: type="text/plain" data-category="analytics"</p>
                </th>
                <td>
                    <textarea id="js-code-editor-scn-head" rows="5" name="scn_head" class="widefat textarea"><?php echo wp_unslash( $scn_head ); ?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <label style="margin-bottom: 10px;">Kódy do patičky</label>
                    <p style="font-weight: normal;">Atributy: type="text/plain" data-category="marketing"</p>
                </th>
                <td>
                    <textarea id="js-code-editor-scn-footer" rows="5" name="scn_footer" class="widefat textarea"><?php echo wp_unslash(  $scn_footer ); ?></textarea>
                </td>
            </tr>
        </table>
        <?php
        submit_button();
        ?>
    </form>
</div>
