<?php

$scn_header = get_option("scn_header");
$scn_footer = get_option("scn_footer");
$scn_config = get_option("scn_config");

?>
<div class="wrap">
	<h1>Nastavení SIT Cookie notice</h1>
	<form method="post" action="options.php">
		<?php
		settings_fields("scn_options");
		do_settings_sections("scn_options");
		?>
		<table class="form-table">
            <tr valign="top">
                <th scope="row">Kódy do hlavičky</th>
                <td>
                    <textarea id="js-code-editor-scn-header" rows="5" name="scn_header" class="widefat textarea"><?php echo wp_unslash( $scn_header ); ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Kódy do patičky</th>
                <td>
                    <textarea id="js-code-editor-scn-footer" rows="5" name="scn_footer" class="widefat textarea"><?php echo wp_unslash(  $scn_footer ); ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Nastavení</th>
                <td>
                    <textarea id="js-code-editor-scn-config" rows="5" name="scn_config" class="widefat textarea"><?php echo wp_unslash( $scn_config ); ?></textarea>
                </td>
            </tr>
		</table>
		<?php
		submit_button();
		?>
	</form>
</div>
