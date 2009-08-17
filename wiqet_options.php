<div class="wrap">
<h2>Wiqet Configuration Settings</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<div class="wiqetExplain">
<strong>Activate your Wiqet:</strong>
Send us an e-mail with your domein name e.g. <span class="emphisize">"http://*.yourdomain.com"</span> and a request for an api key via
our <a href="http://www.wiqet.com/?pageid=10&lang=english" target="_blank">contact form.</a> 
You will receive the API-key from us within 24 hours.
<br><br>
We are currently in the process of automating this feature.
</div>

<table class="form-table">

<tr valign="top">
<th scope="row">API key</th>
<td><input type="text" name="customer_id" value="<?php echo get_option('customer_id'); ?>" /></td>
<td scope="row">( Please enter your API key provided via e-mail.)</td>
</tr>
 
<tr valign="top">
<th scope="row"></th>
<td><input type="hidden" name="unique_id" value="<?php if(get_option('unique_id')){ echo get_option('unique_id'); } else{ echo uniqid(1); } ?>" /></td>
<td scope="row"> </td>
</tr>


</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="customer_id,unique_id" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
