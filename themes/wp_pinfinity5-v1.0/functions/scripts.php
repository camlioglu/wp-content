<?php
add_action('init', 'ci_register_theme_scripts');
function ci_register_theme_scripts()
{
	//
	// Register all front-end scripts here. There is no need to register them conditionally.
	//

	$key = '';

	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.js', array(), false, false);
	wp_register_script('fancybox', get_template_directory_uri().'/js/fancybox/source/jquery.fancybox.pack.js', array('jquery'), false, true);
	wp_register_script('jquery-superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), false, true);
	wp_register_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), false, true);
	wp_register_script('jquery-fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array('jquery'), false, true);
	wp_register_script('jquery-jplayer', get_template_directory_uri().'/js/jquery.jplayer.js', array('jquery'), false, true);
	wp_register_script('formLabels', get_template_directory_uri().'/js/jquery.formLabels1.0.js', array('jquery'), false, true);
	wp_register_script('isotope', get_template_directory_uri().'/js/jquery.isotope.js', array('jquery'), false, true);
	wp_register_script('infinitescroll', get_template_directory_uri().'/js/jquery.infinitescroll.min.js', array('jquery'), false, true);
	wp_register_script('jquery-cookie', get_template_directory_uri().'/js/jquery.cook.js', array('jquery'), false, true);

	wp_register_script('ci-front-scripts', get_template_directory_uri().'/js/scripts.js',
		array(
			'jquery',
			'isotope',
			'formLabels',
			'fancybox',
			'jquery-superfish',
			'infinitescroll',
			'jquery-flexslider',
			'jquery-cookie',
			'jquery-jplayer'),
		false, true);
}

add_action('wp_enqueue_scripts', 'ci_enqueue_theme_scripts');
function ci_enqueue_theme_scripts()
{
	//
	// Enqueue all (or most) front-end scripts here.
	// They can be also enqueued from within template files.
	//
//
//  if ( is_singular() && get_option( 'thread_comments' ) )
//    wp_enqueue_script( 'comment-reply' );


  wp_enqueue_script('modernizr');
	wp_enqueue_script('ci-front-scripts');

	//
	// Slider options export for ci-front-scripts
	//
	$params['slider_autoslide'] = ci_setting('slider_autoslide')=='enabled' ? true : false;
	$params['slider_effect'] = ci_setting('slider_effect');
	$params['slider_direction'] = ci_setting('slider_direction');
	$params['slider_duration'] = (string)ci_setting('slider_duration');
	$params['slider_speed'] = (string)ci_setting('slider_speed');
  $params['swfPath'] = (string)get_bloginfo('template_url').'/js';
	wp_localize_script('ci-front-scripts', 'ThemeOption', $params);

}

?>