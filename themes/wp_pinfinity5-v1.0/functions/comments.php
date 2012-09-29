<?php

function ci_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <span class="comment-meta">
      <?php _e('Posted by ', CI_DOMAIN); ?><strong><?php echo get_comment_author_link(); ?></strong>, <?php _e('at ', CI_DOMAIN);?> <time datetime="<?php get_comment_date(); ?>">J<?php get_comment_date(); ?></time> &mdash; <a class="comment-reply-link" href="#commentform"><?php _e('Reply', CI_DOMAIN); ?></a>
    </span>

    <div class="comment-text group">
      <?php echo get_avatar($comment, 50); ?>

      <div class="comment-copy">
        <?php comment_text(); ?>
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <p><em><?php _e( 'Your comment is awaiting moderation.', CI_DOMAIN ); ?></em></p>
        <?php endif; ?>
      </div>
    </div>
  </li>

		<?php break; ?>
		
		<?php 	
			case 'pingback':
			case 'trackback':
		?>

			<li class="comment group pingback">
				<p><?php _e( 'Pingback:', CI_DOMAIN ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', CI_DOMAIN), ' ' ); ?></p></li>
			<?php break; ?>
	<?php endswitch; ?>		
		
		
<?php
	
}

?>