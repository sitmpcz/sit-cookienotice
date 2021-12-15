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
                    <textarea name="scn_header" value="<?php echo $scn_header; ?>" class="code-editor-scn widefat textarea"></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Kódy do patičky</th>
                <td>
                    <textarea name="scn_footer" value="<?php echo $scn_header; ?>" class="code-editor-scn widefat textarea"></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Nastavení</th>
                <td>
                    <textarea name="scn_config" value="<?php echo $scn_config; ?>" class="code-editor-scn widefat textarea"></textarea>
                </td>
            </tr>
		</table>
		<?php
		submit_button();
		?>
	</form>
</div>
