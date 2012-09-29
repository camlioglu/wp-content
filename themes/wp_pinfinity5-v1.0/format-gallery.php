<?php
$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
$attachments = get_posts($args);
$image_count = count($attachments);
$slider_enabled = get_post_meta($post->ID, 'ci_cpt_post_slider', true)!='disabled' ? true : false;
?>


<?php if($slider_enabled): ?>
<?php if($image_count > 0): ?>
  <figure class="entry-image">
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
          $img_attrs = wp_get_attachment_image_src( $attachment->ID, 'ci_frontpage_thumb' );
          echo '<li><a href="'.$img_attrs[0].'" rel="fancybox['.get_the_ID().']" title="">'.wp_get_attachment_image( $attachment->ID, 'ci_frontpage_thumb', false, $attr ).'</a></li>';
        }
        ?>
      </ul>
    </div>
  </figure>
  <?php endif; ?>
<?php endif; ?>


<div class="entry-content group">

  <?php ci_e_content(); ?>

</div>
