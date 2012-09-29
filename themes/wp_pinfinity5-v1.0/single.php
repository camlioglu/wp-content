<?php get_header(); ?>

<?php

  the_post();

  $format = get_post_format($post->ID);

  if ( $format === false ) {
    $format = 'standard';
  }

?>

<div class="inner-container group">

<div class="box-hold group">
  <article id="post-<?php the_ID();?>" <?php post_class('entry box format-'.$format); ?>>
  <div class="entry-intro">
      <h1><?php the_title(); ?></h1>
          <span class="entry-meta">
            <?php _e('Posted by <strong>'. get_the_author() . '</strong>, on' ); ?> <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
          </span>

    <div class="single-heart-this">
      <?php li_display_love_link(); ?>
    </div>
    </div> <!-- .entry-intro -->

    <?php get_template_part('format-'.$format); ?>

    <?php get_template_part('part-social-share'); ?>

  </article>
</div> <!-- .box-hold -->

  <?php get_sidebar(); ?>

</div> <!-- .inner-container -->

<?php get_footer(); ?>