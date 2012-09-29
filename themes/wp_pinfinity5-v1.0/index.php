<?php get_header(); ?>

<div id="box-container">
<div id="entry-listing" class="group">
<?php
  global $paged;

  $max_page = (int) $wp_query->max_num_pages;
  if ( $max_page > (int) 1 )
    $paged = ! $wp_query->query_vars['paged'] ? (int) 1 : $wp_query->query_vars['paged'];

// Show this widget area only on the first page and only if its populated with widgets
if ( (int) 1 == $paged && is_active_sidebar('first-box')  )
{
?>

<article id="intro" class="entry box">
  <div class="entry-content-cnt">
    <?php dynamic_sidebar('first-box'); ?>
  </div>
</article>

<?php } ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php
  $format = get_post_format($post->ID);

  if ( $format === false ) {
    $format = 'standard';
  }
//  get_template_part( 'template-listing', $format );

  $nofollow = '';
  if($format=='link')
  {
    $linkurl = get_post_meta($post->ID, 'ci_format_link_url', true);
    $nofollow = get_post_meta($post->ID, 'ci_format_link_nofollow', true);
    $nofollow = $nofollow=='nofollow' ? 'rel="nofollow"' : '';
  }
?>

<article id="post-<?php the_ID();?>" <?php post_class('entry box format-'.$format); ?>>
  <div class="entry-content-cnt">

    <?php if ( $format === 'standard' ) { ?>

    <div class="entry-content">
      <a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', CI_DOMAIN).' '.esc_attr(get_the_title()); ?>">
        <?php ci_e_content(); ?>
      </a>
    </div>

    <?php } else if ( $format === 'quote' ) { ?>

    <div class="entry-content">
      <blockquote cite="<?php echo $url; ?>">
        <p><?php echo get_post_meta($post->ID, 'ci_format_quote_text', true); ?></p>
        <cite><a href="<?php echo $url; ?>"><?php echo get_post_meta($post->ID, 'ci_format_quote_credit', true); ?></a></cite>
      </blockquote>
    </div>


    <?php
  } else if ( $format === 'gallery' ) {
      $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
      $attachments = get_posts($args);
      $image_count = count($attachments);
      $slider_enabled = get_post_meta($post->ID, 'ci_cpt_post_slider', true)!='disabled' ? true : false;

      if ( $slider_enabled && ( $image_count > 0 ) ) :
        ?>

        <div class="flexslider">
          <ul class="slides">
            <?php
            foreach ( $attachments as $attachment )
            {
              $attr = array(
                'alt'   => trim(strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) )),
                'title' => trim(strip_tags( $attachment->post_title )),
                'width' => '""',
                'height' => '""'
              );
              $img_attrs = wp_get_attachment_image_src( $attachment->ID, 'large' );
              echo '<li><a href="'.$img_attrs[0].'" rel="fancybox['.get_the_ID().']" title="">'.wp_get_attachment_image( $attachment->ID, 'ci_listing_gallery', false, $attr ).'</a></li>';
            }
            ?>
          </ul>
        </div>

        <?php endif; // slider_enabled ?>

    <?php } else if ($format == 'video') {
    $url = get_post_meta($post->ID, 'ci_format_video_url', true);
    ?>

    <?php if(!empty($url)): ?>
      <div class="entry-content">
        <?php
        global $wp_embed;
        echo $wp_embed->run_shortcode('[embed]' . $url . '[/embed]');
        ?>
      </div>
      <?php endif; ?>


    <?php
    } else if ( has_post_thumbnail() ) : ?>

    <div class="entry-content">
    <?php
      $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', true );
      echo '<a href="'. $url[0] .'" class="thumb" rel="fancybox['. $post->ID .']" title="">'.get_the_post_thumbnail($post->ID, 'ci_listing_thumb').'</a>';
    ?>
    </div>

    <?php endif; ?>



  </div>

  <div class="entry-desc">

    <?php if ( $format !== 'quote ') : ?>
    <h1><a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', CI_DOMAIN).' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h1>
    <?php endif; ?>

    <?php
      if ( $format === 'audio' ) :
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

      <?php endif; // endif format == audio ?>

    <div class="entry-meta group">
      <a class="comments-no" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>
      <?php li_display_love_link(); ?>

      <a class="entry-permalink" href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', CI_DOMAIN).' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
    </div>
  </div>
</article>

  <?php endwhile; endif; ?>

</div> <!-- #entry-listing -->

<div class="ci_load_more">
  <?php next_posts_link( __( '&laquo; Next Set of Entries', CI_DOMAIN ) ); ?>
</div>

</div>  <!-- #box-container -->

<?php get_footer(); ?>