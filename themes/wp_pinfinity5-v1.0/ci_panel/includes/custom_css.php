<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php 
	$ci_defaults['custom_css'] = '';


	// 110 is the priority. It's important to be a big number, i.e. low priority.
	// Low priority means it will execute AFTER the other hooks, hence this will override other styles previously set.
	// Custom Background has a priority of 100, so this custom css can override the background.
	add_action('wp_head', 'ci_custom_css', 110);
	function ci_custom_css() {
		global $ci;
		$css = $ci['custom_css'];	
		
		if (!empty($css)) 
		{
			$css = "<style type=\"text/css\">\n" . $css . "</style>\n";
			echo stripslashes($css);
		}	
	}
?>
<?php else: ?>
	<fieldset class="set">
		<p class="guide"><?php _e('Paste here any custom CSS code you might have.', CI_DOMAIN); ?></p>
		<label for="c_css"><?php _e('CSS Code', CI_DOMAIN); ?>:</label>
		<textarea id="c_css" name="<?php echo THEME_OPTIONS; ?>[custom_css]" rows="5"><?php echo $ci['custom_css']; ?></textarea>
	</fieldset>
<?php endif; ?>