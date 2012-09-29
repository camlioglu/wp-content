<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
  $ci_defaults['slider_autoslide'] 	= 'enabled';
  $ci_defaults['slider_effect'] 		= 'fade';
  $ci_defaults['slider_direction'] 	= 'horizontal';
  $ci_defaults['slider_speed'] 		= 3000;
  $ci_defaults['slider_duration']		= 600;

	$ci_defaults['preview_content'] 	= 'disabled'; //enabled means content, disabled means excerpt
	$ci_defaults['excerpt_length'] 		= 50;
	$ci_defaults['excerpt_text'] 		= '[...]';

	$ci_defaults['read_more_text'] 		= 'Read More &raquo;';
	$ci_defaults['title_separator']		= '|';
	$ci_defaults['comments_off_message']= 'enabled';
	
	function ci_read_more($post_id=false, $return=false)
	{
		global $post;

		if($post_id===false)
			$post_id = $post->ID;

		$link = '<a class="ci-more-link" href="'. get_permalink($post_id) . '"><span>' . ci_setting('read_more_text') . '</span></a>';
		if($return===true)
			return $link;
		else
			echo $link;
			
	}

	// Handle the excerpt.
	add_filter('excerpt_length', 'ci_excerpt_length');
	function ci_excerpt_length($length) {
		return ci_setting('excerpt_length');
	}

	add_filter('excerpt_more', 'ci_excerpt_more');
	function ci_excerpt_more($more) {
		return ci_setting('excerpt_text');
	}
	
	add_filter('the_content_more_link', 'ci_change_read_more');
	function ci_change_read_more($morelink) {
		return str_replace('(more...)', ci_setting('read_more_text'), $morelink);
	}
	
?>
<?php else: ?>

<fieldset class="set">
  <p class="guide"><?php _e('The following options control the gallery items slider. You may enable or disable auto-sliding by checking the appropriate option and further control its behavior.' , CI_DOMAIN); ?></p>
  <fieldset>
    <input type="checkbox" id="slider_autoslide" class="check" name="<?php echo THEME_OPTIONS; ?>[slider_autoslide]" value="enabled" <?php checked($ci['slider_autoslide'], 'enabled'); ?> />
    <label for="slider_autoslide"><?php _e('Enable auto-slide', CI_DOMAIN); ?></label>
  </fieldset>
  <fieldset>
    <label for="slider_effect"><?php _e('Slider Effect', CI_DOMAIN); ?></label>
    <select id="slider_effect" name="<?php echo THEME_OPTIONS; ?>[slider_effect]">
      <option value="fade" <?php selected($ci['slider_effect'],'fade'); ?>><?php _e('Fade', CI_DOMAIN); ?></option>
      <option value="slide" <?php selected($ci['slider_effect'],'slide'); ?>><?php _e('Slide', CI_DOMAIN); ?></option>
    </select>
  </fieldset>
  <fieldset>
    <label for="slider_direction"><?php _e('Slide Direction (only for <b>Slide</b> effect)', CI_DOMAIN); ?></label>
    <select id="slider_direction" name="<?php echo THEME_OPTIONS; ?>[slider_direction]">
      <option value="horizontal" <?php selected($ci['slider_direction'],'horizontal'); ?>><?php _e('Horizontal', CI_DOMAIN); ?></option>
      <option value="vertical" <?php selected($ci['slider_direction'],'vertical'); ?>><?php _e('Vertical', CI_DOMAIN); ?></option>
    </select>
  </fieldset>
  <fieldset>
    <label for="slider_speed"><?php _e('Slideshow speed in milliseconds (smaller number means faster)', CI_DOMAIN); ?></label>
    <input id="slider_speed" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[slider_speed]" value="<?php echo esc_attr($ci['slider_speed']); ?>" />
  </fieldset>
  <fieldset>
    <label for="slider_duration"><?php _e('Animation duration in milliseconds (smaller number means faster)', CI_DOMAIN); ?></label>
    <input id="slider_duration" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[slider_duration]" value="<?php echo esc_attr($ci['slider_duration']); ?>" />
  </fieldset>
</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('You can select whether you want the Content or the Excerpt to be displayed on listing pages.', CI_DOMAIN); ?></p>
		<fieldset>
			<label><?php _e('Use the following on listing pages', CI_DOMAIN); ?></label>
			<p>
				<input type="radio" class="radio" id="use_excerpt" name="<?php echo THEME_OPTIONS; ?>[preview_content]" value="disabled" <?php checked($ci['preview_content'], 'disabled'); ?> />
				<label for="use_excerpt" class="radio"><?php _e('Use the Excerpt', CI_DOMAIN); ?></label>
			</p>
			<p>
				<input type="radio" class="radio" id="use_content" name="<?php echo THEME_OPTIONS; ?>[preview_content]" value="enabled" <?php checked($ci['preview_content'], 'enabled'); ?> />
				<label for="use_content" class="radio"><?php _e('Use the Content', CI_DOMAIN); ?></label>
			</p>
		</fieldset>
	</fieldset>
	
	<fieldset class="set">
		<p class="guide"><?php _e('You can set what the Read More text will be. This applies to the Content when the More Tag is set.', CI_DOMAIN); ?></p>
		<fieldset>
			<label for="read_more_text"><?php _e('Read More text', CI_DOMAIN); ?></label>
			<input id="read_more_text" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[read_more_text]" value="<?php echo $ci['read_more_text']; ?>" />
		</fieldset>
	</fieldset>
	
	<fieldset class="set">
		<p class="guide"><?php _e('You can define how long the Excerpt will be (in words). You can also set the text that appears when the excerpt is auto-generated and is automatically cut-off. These options only apply to the Excerpt.', CI_DOMAIN); ?></p>
		<fieldset>
			<label for="excerpt_length"><?php _e('Excerpt length (in words)', CI_DOMAIN); ?></label>
			<input id="excerpt_length" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[excerpt_length]" value="<?php echo $ci['excerpt_length']; ?>" />
		</fieldset>
		<fieldset>
			<label for="excerpt_text"><?php _e('Excerpt auto cut-off text', CI_DOMAIN); ?></label>
			<input id="excerpt_text" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[excerpt_text]" value="<?php echo $ci['excerpt_text']; ?>" />
		</fieldset>
	</fieldset>
	
		<fieldset class="set">
		<p class="guide"><?php _e('The title separator is inserted between various elements within the title tag of each page. Leading and trailing spaces are automatically inserted where appropriate.', CI_DOMAIN); ?></p>
		<fieldset>
			<label for="title_separator"><?php _e('Title separator', CI_DOMAIN); ?></label>
			<input id="title_separator" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[title_separator]" value="<?php echo $ci['title_separator']; ?>" />
		</fieldset>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('You can enable and disable the "Comments are closed" message displayed on the bottom of each post when the comments are closed.' , CI_DOMAIN); ?></p>
		<fieldset>
			<input type="checkbox" id="comments_off_message" class="check" name="<?php echo THEME_OPTIONS; ?>[comments_off_message]" value="enabled" <?php checked($ci['comments_off_message'], 'enabled'); ?> />
			<label for="comments_off_message"><?php _e('Show "Comments are closed" message', CI_DOMAIN); ?></label>
		</fieldset>
	</fieldset>

<?php endif; ?>