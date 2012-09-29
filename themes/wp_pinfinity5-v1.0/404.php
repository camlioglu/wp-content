<?php get_header(); ?>


<div class="inner-container half group">

  <div class="box-hold group">
    <article class="box entry group">
      <div class="entry-intro">
        <h1><?php _e( 'Not Found', CI_DOMAIN ); ?></h1>
      </div> <!-- .entry-intro -->


      <div class="entry-content group">
        <p><?php _e( 'Oh, no! The page you requested could not be found. Perhaps searching will help...', CI_DOMAIN ); ?></p>

        <?php get_search_form(); ?>
      </div>


    </article>
  </div> <!-- .box-hold -->


</div> <!-- .inner-container -->

<?php get_footer(); ?>