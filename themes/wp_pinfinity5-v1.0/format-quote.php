<div class="quote-content">

<?php $url = get_post_meta($post->ID, 'ci_format_quote_cite', true); ?>
<?php if(empty($url)): ?>
<blockquote>
  <p><?php echo get_post_meta($post->ID, 'ci_format_quote_text', true); ?></p>
  <cite><?php echo get_post_meta($post->ID, 'ci_format_quote_credit', true); ?></cite>
</blockquote>
<?php else: ?>
<blockquote cite="<?php echo $url; ?>">
  <p><?php echo get_post_meta($post->ID, 'ci_format_quote_text', true); ?></p>
  <cite><a href="<?php echo $url; ?>"><?php echo get_post_meta($post->ID, 'ci_format_quote_credit', true); ?></a></cite>
</blockquote>
<?php endif; ?>

</div>


<div class="entry-content group">

  <?php ci_e_content(); ?>

</div>
