<?php if ( has_post_thumbnail() ) : ?>

<figure class="entry-image">
  <?php
  $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', true );
  echo '<a href="'. $url[0] .'" class="thumb" rel="fancybox['. $post->ID .']" title="">'.get_the_post_thumbnail($post->ID, 'ci_listing_thumb').'</a>';
  ?>
</figure>

<?php endif; ?>


<div class="entry-content group">

  <?php ci_e_content(); ?>

</div>
