<div class="box comment-form">
  <div class="box-content">
    <?php if(comments_open()): ?>
      <?php get_template_part('comment-form'); ?>
    <?php else : ?>
    <p><?php _e('Comments are closed.', CI_DOMAIN); ?></p>
    <?php endif; ?>
  </div>
</div>


<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die (__('Please do not load this page directly. Thanks!', CI_DOMAIN));
if ( post_password_required() ) {
  echo '<p class="nocomments">' . _e('This post is password protected. Enter the password to view comments.', CI_DOMAIN) . '</p>';
  return;
}
?>

<?php if (have_comments()): ?>
<div id="comments" class="box post-comments">
  <div class="box-content">
  <h3><?php comments_number(__('No comments', CI_DOMAIN), __('1 comment', CI_DOMAIN), __('% comments', CI_DOMAIN)); ?></h3>

  <ol id="comment-list" class="group">
    <?php wp_list_comments(array(
    'callback' => 'ci_comment'
    )); ?>
  </ol>
  <div class="comments-pagination"><?php paginate_comments_links(); ?></div>

  </div>
</div>
<?php else: ?>
<?php if(!comments_open() and ci_setting('comments_off_message')=='enabled'): ?>
<div class="box post-comments">
  <div class="box-content">
    <p><?php _e('Comments are closed.', CI_DOMAIN); ?></p>
  </div>
</div>
  <?php endif; ?>
<?php endif; ?>


