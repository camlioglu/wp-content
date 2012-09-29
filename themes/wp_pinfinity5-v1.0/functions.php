<?php 
	require_once('functions/constants.php');

	load_theme_textdomain( CI_DOMAIN, TEMPLATEPATH . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	if ( ! isset( $content_width ) ) $content_width = 516;

  require_once('functions/scripts.php');
  require_once('functions/loveit.php');
  require_once('functions/ci_development.php');
	require_once('functions/ci_generic.php');
	require_once('functions/ci_widgets.php');
	require_once('functions/nav_menus.php');
	require_once('functions/comments.php');
	require_once('functions/sidebars.php');
	require_once('functions/post_types.php');
	require_once('ci_panel/ci_panel.php');


	//
	// Define our various image sizes.
	//
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'ci_listing_thumb', 500, 9999, false);
	add_image_size( 'ci_listing_gallery', 500, 180, true);


	// Define our post formats
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'quote') );
	add_post_type_support( 'post', 'post-formats' );


	// Handle Feeds.
	ci_register_custom_feed();



	//If just activated, go to our options page.
	if ( is_admin() and isset($_GET['activated'] ) and $pagenow == "themes.php" )
	{
		ci_default_options(true);
		wp_redirect( 'themes.php?page=ci_panel.php' );
	}

  add_filter('admin_footer_text', 'ci_change_admin_footer');
function ci_change_admin_footer($str) {
  echo '<p><a href="http://www.cssigniter.com/">CSSIgniter</a> - <a href="http://www.cssigniter.com/support/">Theme Support</a></p>'.$str;
}

// Remove width and height attributes from the <img> tag.
// Remove also when an image is sent to the editor. When the user resizes the image from the handles, width and height
// are re-inserted, so expected behaviour is not lost.
add_filter('post_thumbnail_html', 'ci_remove_thumbnail_dimentions');
add_filter('image_send_to_editor', 'ci_remove_thumbnail_dimentions');
function ci_remove_thumbnail_dimentions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

add_filter('the_content', 'fancyboxrel', 12);
add_filter('get_comment_text', 'fancyboxrel');
add_filter('wp_get_attachment_link', 'fancyboxrel');
function fancyboxrel ($content)
{
  global $post;
  $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";

    $replacement = '<a$1href=$2$3.$4$5 rel="fancybox['.$post->ID.']"$6>$7</a>';

  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}

//remove default WordPress gallery styling
add_filter( 'use_default_gallery_style', '__return_false' );



/**
 * Infinite Scroll
 */
function custom_infinite_scroll_js() {
  if ( !is_singular() ) { ?>
  <script>
    var infinite_scroll = {
      loading: {
        img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
        msgText: "<?php _e( 'Loading the next set of entries...', 'CI_DOMAIN' ); ?>",
        finishedMsg: "<?php _e( 'All entries loaded.', 'CI_DOMAIN' ); ?>"
      },
      "nextSelector":".ci_load_more a",
      "navSelector":".ci_load_more a",
      "itemSelector":"article.entry",
      "contentSelector":"#entry-listing"
    };

    jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll	,
      function(newElements) {
      var $newElems = jQuery(newElements).addClass("newItem");
      $newElems.hide().imagesLoaded(function(){
        if( jQuery(".flexslider").length > 0) {
          jQuery(".flexslider").flexslider({
            'controlNav': true,
            'directionNav': true,
            'animation': ThemeOption.slider_effect,
            'slideDirection': ThemeOption.slider_direction,
            'slideshow': Boolean(ThemeOption.slider_autoslide),
            'slideshowSpeed': Number(ThemeOption.slider_speed),
            'animationDuration': Number(ThemeOption.slider_duration)
          });
        }
        jQuery(this).show();
        jQuery('#infscr-loading').fadeOut('normal');
        jQuery("#entry-listing").isotope('appended', $newElems );
        loadAudioPlayer(ThemeOption.swfPath);
      });
      });

  </script>

  <?php
  }
}
add_action( 'wp_footer', 'custom_infinite_scroll_js',100 );


?>