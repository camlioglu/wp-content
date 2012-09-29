<form action="<?php echo esc_url(home_url('/')); ?>" class="searchform" method="get" role="search">
  <input size="27" type="text" title="<?php echo (get_search_query()!="" ? get_search_query() : __('Search', CI_DOMAIN) ); ?>" class="s" name="s">
  <a type="submit" class="searchsubmit"><img src="<?php echo get_template_directory_uri(); ?>/images/search.png" alt="<?php _e('GO', CI_DOMAIN); ?>"></a>
</form>