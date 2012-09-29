<?php
//
// Displays the love it button
//
function li_display_love_link() {

  global $post;

    ob_start();

    // retrieve the total love count for this item
    $love_count = li_get_love_count($post->ID);

    if ( !li_user_has_loved_post(get_the_ID() )) {
      if (is_singular()) {

       $output = '<a data-post-id="' . get_the_ID() . '" class="heart-this" href="#" title="'.__('Love this.', CI_DOMAIN).'">'.'<span class="heart-icon"></span><span class="heart-no">'.$love_count.'</span></a>';

      } else {
        $output = '<a data-post-id="' . get_the_ID() . '" class="heart-this" href="#" title="'.__('Love this.', CI_DOMAIN).'"><span class="heart-no">'.$love_count.'</span></a>';

      }

    } else {

      if ( is_singular() ) {

        $output = '<a data-post-id="' . get_the_ID() . '" class="heart-this loved" href="#" title="'.__('You love this.', CI_DOMAIN).'">'.'<span class="heart-icon"></span><span class="heart-no">'.$love_count.'</span></a>';


      } else {
        $output = '<a data-post-id="' . get_the_ID() . '" class="heart-this loved" href="#" title="'.__('You love this.', CI_DOMAIN).'"><span class="heart-no">'.$love_count.'</span></a>';

      }
    }

  echo $output;
}

// check whether a user has loved an item
function li_user_has_loved_post($post_id) {

  if ( !empty($_COOKIE['ci_love_it_cookie']) ) {
    $cookie = $_COOKIE['ci_love_it_cookie'];
    $cookie_array = explode(",", $cookie);

    if ( in_array($post_id, $cookie_array) ) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }

}

// increments a love count
function li_mark_post_as_loved($post_id) {

  // retrieve the love count for $post_id
  $love_count = get_post_meta($post_id, '_li_love_count', true);
  if($love_count)
    $love_count = $love_count + 1;
  else
    $love_count = 1;

  if(update_post_meta($post_id, '_li_love_count', $love_count)) {
    return true;
  }
  return false;
}

// returns a love count for a post
function li_get_love_count($post_id) {
  $love_count = get_post_meta($post_id, '_li_love_count', true);
  if($love_count)
    return $love_count;
  return 0;
}

// processes the ajax request
function li_process_love() {
  if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['love_it_nonce'], 'love-it-nonce') ) {
    if( li_mark_post_as_loved($_POST['item_id']) ) {
      echo 'loved';
    } else {
      echo 'failed';
    }
  }
  die();
}
add_action('wp_ajax_love_it', 'li_process_love');
add_action('wp_ajax_nopriv_love_it', 'li_process_love');

function li_front_end_js() {
    wp_enqueue_script('love-it', get_template_directory_uri().'/js/loveit.js', array('jquery'), false, true);
  wp_localize_script( 'love-it', 'love_it_vars',
      array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('love-it-nonce'),
        'already_loved_message' => __('You have already loved this item.', 'love_it'),
        'error_message' => __('Sorry, there was a problem processing your request.', 'love_it')
      )
    );
}
add_action('wp_enqueue_scripts', 'li_front_end_js');

?>