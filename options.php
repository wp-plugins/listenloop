<div class="wrap">
<h2>ListenLoop</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('listenloop'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">ListenLoop Public Key:</th>
<td><input type="text" name="listenloop_public_key" value="<?php echo get_option('listenloop_public_key'); ?>" /></td>
</tr>

</tr>

</table>

<input type="hidden" name="action" value="update" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
