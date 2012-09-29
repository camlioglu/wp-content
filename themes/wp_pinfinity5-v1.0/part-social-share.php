<div class="social-share group">
  <div class="social-button social-facebook">
    <div class="fb-like" data-href="<?php echo urlencode(get_permalink()); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false"></div>
  </div>
  <div class="social-button social-twitter">
    <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
    <script>!function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.src = "//platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
      }
    }(document, "script", "twitter-wjs");</script>
  </div>
<?php
    if ( has_post_thumbnail() ) :
?>
    <div class="social-button social-pinterest">
    <?php $pinImgUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $pinImgUrl[0]; ?>?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="<?php _e('Pin It', CI_DOMAIN); ?>" /></a>
  </div>

 <?php endif; ?>


</div>
