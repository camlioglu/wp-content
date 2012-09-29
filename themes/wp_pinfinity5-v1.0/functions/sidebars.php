<?php

function ci_widgets_init() {

	register_sidebar(array(
		'name' => __( 'Top Bar', CI_DOMAIN),
		'id' => 'top_bar',
		'description' => __( 'Top Widget Bar of the Theme. Only the Search and CI_SOCIAL widgets are allowed here.', CI_DOMAIN),
		'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

  register_sidebar(array(
    'name' => __( 'First Box Widget', CI_DOMAIN),
    'id' => 'first-box',
    'description' => __( 'This is the first box of your homepage layout. You can put any widgets here.', CI_DOMAIN),
    'before_widget' => '<aside id="%1$s" class="widget %2$s group">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));

}
add_action( 'widgets_init', 'ci_widgets_init' );

?>