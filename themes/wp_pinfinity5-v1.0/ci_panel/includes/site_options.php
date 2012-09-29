<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	$ci_defaults['logotext'] 		= get_bloginfo('name');
	$ci_defaults['logo']			= '';
	$ci_defaults['favicon']			= '';
	$ci_defaults['stylesheet']		= 'default';
	$ci_defaults['layout']			= 'default';
?>
<?php else: ?>
	<fieldset class="set">
		<p class="guide"><?php _e('You can set general blog options in this page. Your original WordPress settings will not be changed.', CI_DOMAIN); ?></p>
		<fieldset>
			<label for="logo-text"><?php _e('Logo text', CI_DOMAIN); ?></label>
			<input id="logo-text" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[logotext]" value="<?php echo $ci['logotext']; ?>" />
		</fieldset>

		<fieldset>
			<label for="logo-url"><?php _e('Upload your logo', CI_DOMAIN); ?></label>
			<input id="logo-url" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[logo]" value="<?php echo $ci['logo']; ?>" class="uploaded"/>
			<input type="submit" class="ci-upload button" value="Upload image" />
		</fieldset>
	</fieldset>
	<fieldset class="set">
		<p class="guide"><?php _e('Select your color scheme.', CI_DOMAIN); ?></p>
		<fieldset>
		<?php $stylesheet = $ci['stylesheet']; ?>
			<label for="stylesheet"><?php _e('Color scheme', CI_DOMAIN); ?></label>
			<select id="stylesheet" name="<?php echo THEME_OPTIONS; ?>[stylesheet]">
				<option value="default" <?php selected($stylesheet,'default'); ?>><?php _e('Default', CI_DOMAIN); ?></option>
				<option value="red" <?php selected($stylesheet,'blue'); ?>><?php _e('Red', CI_DOMAIN); ?></option>
				<option value="green" <?php selected($stylesheet,'green'); ?>><?php _e('Green', CI_DOMAIN); ?></option>
				<option value="purple" <?php selected($stylesheet,'purple'); ?>><?php _e('Purple', CI_DOMAIN); ?></option>
				<option value="pink" <?php selected($stylesheet,'magenta'); ?>><?php _e('Pink', CI_DOMAIN); ?></option>
				<option value="mustard" <?php selected($stylesheet,'magenta'); ?>><?php _e('Mustard', CI_DOMAIN); ?></option>
			</select>
		</fieldset>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Select the layout of the site. There are two available layouts to choose. The default, where the Page and Posts content is centered and alternative, where they are left aligned.', CI_DOMAIN); ?></p>
		<fieldset>
		<?php $layout = $ci['layout']; ?>
			<label for="layout"><?php _e('Site layout', CI_DOMAIN); ?></label>
			<select id="layout" name="<?php echo THEME_OPTIONS; ?>[layout]">
				<option value="default" <?php selected($layout,'default'); ?>><?php _e('Default - Posts and Pages are Centered', CI_DOMAIN); ?></option>
				<option value="alt" <?php selected($layout,'alt'); ?>><?php _e('Alternative - Posts and Pages Left Aligned', CI_DOMAIN); ?></option>
			</select>
		</fieldset>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('Here you can upload your favicon. The favicon is a small, 16x16 icon that appears besides your URL in the address bar, in open tabs and/or in bookmarks. We recommend you create your favicon from an existing square image, using appropriate online services such as <a href="http://tools.dynamicdrive.com/favicon/">Dynamic Drive</a> and <a href="http://www.favicon.cc/">favicon.cc</a>', CI_DOMAIN); ?></p>
		<label for="favicon"><?php _e('Upload your favicon', CI_DOMAIN); ?></label>
		<input id="favicon" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[favicon]" value="<?php echo $ci['favicon']; ?>" class="uploaded"/>
		<input type="submit" class="ci-upload button" value="Upload image" />
		<div class="up-preview"><?php if (isset($ci['favicon']) ? '<img src="'.$ci['favicon'].'" />' : '' );  ?></div>
	</fieldset>


<?php endif; ?>