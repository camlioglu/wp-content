<?php if ( has_post_thumbnail() ) : ?>

<figure class="entry-image">
  <?php
  $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', true );
  echo '<a href="'. $url[0] .'" class="thumb" rel="fancybox['. $post->ID .']" title="">'.get_the_post_thumbnail($post->ID, 'ci_listing_thumb').'</a>';
  ?>
</figure>

<?php endif; ?>

<div class="entry-content group">

<?php
$url = get_post_meta($post->ID, 'ci_format_audio_url', true);
?>


  <div class="audio-wrap" data-audio-id="<?php the_ID(); ?>" data-audio-file="<?php echo $url; ?>">
  <div id="jp-<?php the_ID(); ?>" class="jp-jplayer"></div>

  <div id="jp-play-<?php the_ID(); ?>" class="jp-audio">
    <div class="jp-type-single">
      <div class="jp-gui jp-interface">
        <ul class="jp-controls">
          <li><a href="#" class="jp-play" tabindex="1"><?php _e('Play', CI_DOMAIN); ?></a></li>
          <li><a href="#" class="jp-pause" tabindex="1"><?php _e('Pause', CI_DOMAIN); ?></a></li>
        </ul>


        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>

        <div class="jp-current-time"></div>

      </div>
    </div>
  </div>
</div> <!-- .audio-wrap -->


<?php ci_e_content(); ?>

</div>
