<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php 
	$ci_defaults['google_analytics_code'] = '';
//	$ci_defaults['google_maps_api_key'] = '';

	add_action('wp_head', 'ci_register_analytics_scripts');
	function ci_register_analytics_scripts()
	{
		// Load Google Analytics code, if available.
		if(ci_setting('google_analytics_code'))
		{
			echo html_entity_decode(ci_setting('google_analytics_code'));
		}
	}
?>
<?php else: ?>
	<fieldset class="set">
		<p class="guide"><?php _e('Paste here your Google Analytics Code, as given by the Analytics website, and it will be automatically included on every page.', CI_DOMAIN); ?></p>
		<label for="ga_code"><?php _e('Google Analytics Code', CI_DOMAIN); ?>:</label>
		<textarea id="ga_code" name="<?php echo THEME_OPTIONS; ?>[google_analytics_code]" rows="5"><?php echo $ci['google_analytics_code']; ?></textarea>
	</fieldset>

<!--
	<fieldset class="set">
		<p class="guide"><?php _e('Enter here your Google Maps API Key. While your maps will be displayed at first without an API key, if you get a lot of visits to your site (more than 25.000 per day currently), the maps might stop working. In that case, you need to issue a key from <a href="https://code.google.com/apis/console/">Google Accounts</a>', CI_DOMAIN); ?></p>
		<fieldset>
			<label for="google_maps_api_key"><?php _e('Google Maps API Key', CI_DOMAIN); ?></label>
			<input id="google_maps_api_key" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[google_maps_api_key]" value="<?php echo $ci['google_maps_api_key']; ?>" />
		</fieldset>
	</fieldset>
-->
<?php endif; ?>