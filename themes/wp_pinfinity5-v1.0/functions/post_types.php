<?php
//
// Include all custom post types here (one custom post type per file)
//
require_once('post_types/post.php');

add_action( 'init', 'ci_tax_create_taxonomies');
function ci_tax_create_taxonomies() {
	//
	// Create all taxonomies here.
	//

}


add_action('admin_enqueue_scripts', 'ci_load_post_scripts');
function ci_load_post_scripts($hook)
{
	//
	// Add here all scripts and styles, to load on all admin pages.
	//
	
	
	if('post.php' == $hook or 'post-new.php' == $hook)
	{
		//
		// Add here all scripts and styles, specific on post edit screens.
		//
		wp_enqueue_script('ci-post-edit-scripts', get_template_directory_uri().'/js/post_edit_scripts.js', array(), false, true);

	}
}




add_filter('request', 'ci_feed_request');
function ci_feed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type'])){

		$qv['post_type'] = array();
		$qv['post_type'] = get_post_types($args = array(
	  		'public'   => true,
	  		'_builtin' => false
		));
		$qv['post_type'][] = 'post';
	}
	return $qv;
}
?>