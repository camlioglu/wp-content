<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php 
if(!function_exists('ci_social_services')){
function ci_social_services()
{
	$services = array(
		'twitter' => 'Twitter', 
		'youtube' => 'YouTube', 
		'myspace' => 'MySpace', 
		'facebook' => 'Facebook', 
		'gplus' => 'Google+', 
		'lnkdin' => 'LinkedIn', 
		'pinterest' => 'Pinterest', 
		'flickr' => 'Flickr', 
		'wordpress' => 'WordPress.com', 
		'dribbble' => 'Dribbble',
		'picasa' => 'Picasa'
	);
	return $services;
}}

	$ci_defaults['social_rss_show'] 		= 'enabled';
	$ci_defaults['social_rss_text'] 		= __('Subscribe to our RSS feed.', CI_DOMAIN);

	$ci_defaults['social_twitter_show'] 	= 'enabled';
	$ci_defaults['social_twitter_url'] 		= 'http://twitter.com/cssigniter';
	$ci_defaults['social_twitter_text'] 	= __('Follow us on twitter.', CI_DOMAIN);

	$ci_defaults['social_youtube_show'] 	= '';
	$ci_defaults['social_youtube_url'] 		= '#';
	$ci_defaults['social_youtube_text']		= __('Check out our videos on YouTube.', CI_DOMAIN);

	$ci_defaults['social_myspace_show'] 	= '';
	$ci_defaults['social_myspace_url'] 		= '#';
	$ci_defaults['social_myspace_text']		= __('Listen to our music on MySpace.', CI_DOMAIN);

	$ci_defaults['social_facebook_show']	= 'enabled';
	$ci_defaults['social_facebook_url'] 	= 'http://www.facebook.com/cssigniter';
	$ci_defaults['social_facebook_text']	= __('Like us on Facebook.', CI_DOMAIN);

	$ci_defaults['social_gplus_show'] 	= '';
	$ci_defaults['social_gplus_url'] 	= '#';
	$ci_defaults['social_gplus_text']	= __('Join our circle in Google+', CI_DOMAIN);

	$ci_defaults['social_lnkdin_show'] 	= '';
	$ci_defaults['social_lnkdin_url'] 	= '#';
	$ci_defaults['social_lnkdin_text']	= __('Let\'s meet in LinkedIn', CI_DOMAIN);

	$ci_defaults['social_pinterest_show'] 	= '';
	$ci_defaults['social_pinterest_url'] 	= '#';
	$ci_defaults['social_pinterest_text']	= __('See our pinboards on Pinterest', CI_DOMAIN);

	$ci_defaults['social_flickr_show'] 		= '';
	$ci_defaults['social_flickr_url'] 		= '#';
	$ci_defaults['social_flickr_text']		= __('See our photos on Flickr', CI_DOMAIN);

	$ci_defaults['social_wordpress_show'] 	= '';
	$ci_defaults['social_wordpress_url'] 	= '#';
	$ci_defaults['social_wordpress_text']	= __('Visit our Wordpress.com blog', CI_DOMAIN);

	$ci_defaults['social_dribbble_show'] 	= 'enabled';
	$ci_defaults['social_dribbble_url'] 	= 'http://dribbble.com/Klou';
	$ci_defaults['social_dribbble_text']	= __('See our Dribbble shots.', CI_DOMAIN);

	$ci_defaults['social_dribbble_show'] 	= 'enabled';
	$ci_defaults['social_dribbble_url'] 	= 'http://dribbble.com/Klou';
	$ci_defaults['social_dribbble_text']	= __('See our Dribbble shots.', CI_DOMAIN);

	$ci_defaults['social_picasa_show'] 		= '';
	$ci_defaults['social_picasa_url'] 		= '#';
	$ci_defaults['social_picasa_text']		= __('See our photos on Picasa.', CI_DOMAIN);

?>
<?php else: ?>
	
	<fieldset class="set">
		<p class="guide"><?php _e('Enter the URLs of your accounts on the following social media websites. The relevant icons will be displayed wherever you place the included -=CI SOCIAL=- widget. Unchecking and/or leaving an empty URL will hide the associated icon.' , CI_DOMAIN); ?></p>
		<fieldset>
			<fieldset>
				<input type="checkbox" class="check" id="social_rss_show" name="<?php echo THEME_OPTIONS; ?>[social_rss_show]" value="enabled" <?php checked($ci['social_rss_show'], 'enabled'); ?> />
				<label for="social_rss_show"><?php _e('Enable RSS icon', CI_DOMAIN); ?></label>	
			</fieldset>
			<fieldset>
				<label for="social_rss_text"><?php _e('RSS Text', CI_DOMAIN); ?></label>
				<input id="social_rss_text" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[social_rss_text]" value="<?php echo $ci['social_rss_text']; ?>" />
			</fieldset>
		</fieldset>
		<?php $services = ci_social_services(); ?>
		<?php foreach($services as $key => $value): ?>
			<?php
				$field_show = 'social_'.$key.'_show';
				$field_url = 'social_'.$key.'_url';
				$field_text = 'social_'.$key.'_text';
			?>
			<fieldset class="social-set">
				<fieldset>
					<input type="checkbox" class="check" id="<?php echo $field_show; ?>" name="<?php echo THEME_OPTIONS; ?>[<?php echo $field_show; ?>]" value="enabled" <?php checked($ci[$field_show], 'enabled'); ?> />
					<label for="<?php echo $field_show; ?>"><?php _e('Enable '.$value.' icon', CI_DOMAIN); ?></label>	
				</fieldset>
				<fieldset>
					<label for="<?php echo $field_url; ?>"><?php _e($value.' URL', CI_DOMAIN); ?></label>
					<input id="<?php echo $field_url; ?>" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[<?php echo $field_url; ?>]" value="<?php echo $ci[$field_url]; ?>" />
				</fieldset>
				<fieldset>
					<label for="<?php echo $field_text; ?>"><?php _e($value.' Text', CI_DOMAIN); ?></label>
					<input id="<?php echo $field_text; ?>" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[<?php echo $field_text; ?>]" value="<?php echo $ci[$field_text]; ?>" />
				</fieldset>
			</fieldset>
		<?php endforeach; ?>
	</fieldset>

<?php endif; ?>