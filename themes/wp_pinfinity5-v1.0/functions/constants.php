<?php

//
// These need to be changed manually on every theme
//
if(!defined('CI_THEME_NAME')) 		define('CI_THEME_NAME', 'pinfinity');
if(!defined('CI_THEME_VERSION')) 	define('CI_THEME_VERSION', '1.0');
if(!defined('CI_DOCS'))				define('CI_DOCS', 'http://www.cssigniter.com/support/viewtopic.php?f=36&t=206');
if(!defined('CI_FORUM'))			define('CI_FORUM', 'http://www.cssigniter.com/support/viewforum.php?f=36');




//
// These are generated and should be (more or less) constant throughout CSSIgniter templates.
//
if(!defined('WP_THEME_URL'))		define('WP_THEME_URL', get_stylesheet_directory_uri());
if(!defined('WP_UPLOADIFY_URL'))	define('WP_UPLOADIFY_URL', get_stylesheet_directory_uri() . "/ci_panel/uploadify");
if(!defined('WP_UPLOAD_URL'))		define('WP_UPLOAD_URL', get_template_directory() . "/ci_panel/uploads");
if(!defined('CI_DOMAIN'))			define('CI_DOMAIN', 'ci_'.CI_THEME_NAME);
if(!defined('CI_SAMPLE_CONTENT'))	define('CI_SAMPLE_CONTENT', CI_DOMAIN.'_sample_content');
if(!defined('THEME_OPTIONS')) 		define('THEME_OPTIONS', 'ci_'.CI_THEME_NAME.'_theme_options');

?>