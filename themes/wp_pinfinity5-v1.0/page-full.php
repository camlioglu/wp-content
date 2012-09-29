<?php
/*
 * Template Name: Page Full Width
 */
?>

<?php get_header(); the_post(); ?>


<div class="inner-container full group">

  <div class="box-hold group">
    <article id="post-<?php the_ID();?>" <?php post_class('entry box'); ?>>
      <div class="entry-intro">
        <h1><?php the_title(); ?></h1>

      </div> <!-- .entry-intro -->

      <?php if ( has_post_thumbnail() ) : ?>

      <figure class="entry-image">
        <?php
        $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large', true );
        echo '<a href="'. $url[0] .'" class="thumb" rel="fancybox['. $post->ID .']" title="">'.get_the_post_thumbnail($post->ID, 'ci_listing_thumb').'</a>';
        ?>
      </figure>

      <?php endif; ?>

      <div class="entry-content group">
      <?php the_content(); ?>
      </div>

      <?php get_template_part('part-social-share'); ?>

    </article>
  </div> <!-- .box-hold -->


</div> <!-- .inner-container -->

<?php get_footer(); ?>