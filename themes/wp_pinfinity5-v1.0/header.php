<!doctype html>
<!--[if lt IE 7]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7" > <![endif]-->
<!--[if IE 7]>
<html <?php language_attributes(); ?> class="no-js ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html <?php language_attributes(); ?> class="no-js ie8 lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>
        <?php
        ci_e_title();

        // If using the YOAST WordPress SEO plugin, comment the line above, and uncomment the line below.
        //wp_title('');

        // Likewise, most SEO plugins will ask you to edit the above wp_title() in some way that they need it to be.
        // Do exactly as they require, as doing otherwise might have an impact on your search engine rankings.
        ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic|Yanone+Kaffeesatz' rel='stylesheet'
          type='text/css'>

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/colors/default.css" type="text/css"
          media="screen"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/fancybox/source/jquery.fancybox.css">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <?php if (ci_setting('favicon')): ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php ci_e_setting('favicon'); ?>"/>
    <?php endif; ?>

    <?php wp_head(); ?>

</head>

<?php
$alt_layout = ci_setting('layout') == 'alt' ? ' alt ' : '';
?>
<body <?php body_class($alt_layout); ?>>
<?php do_action('after_open_body_tag'); ?>

<?php if (is_singular()): ?>
<div id="fb-root"></div>
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <?php endif; ?>

<header id="header">
    <div class="pre-head show-on-mobile">
        <div class="wrap group">
            <div class="pre-head-wgt group">
                <?php dynamic_sidebar('public_top'); ?>
            </div>
            <!-- .header-wgt -->
        </div>
    </div>
    <!-- .pre-head -->

    <div id="site-head">
        <div class="wrap group">
            <hgroup class="logo textual">
                <h1><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
            </hgroup>

            <div class="header-wgt group">
                <?php dynamic_sidebar('public_top'); ?>
            </div>
            <!-- .header-wgt -->
        </div>
        <!-- .wrap < #header -->
    </div>
    <!-- #site-head -->

    <nav>
        <div class="wrap group">
            <?php
            if (has_nav_menu('ci_main_menu'))
                wp_nav_menu(array(
                    'theme_location' => 'ci_main_menu',
                    'fallback_cb' => '',
                    'container' => '',
                    'menu_id' => 'navigation',
                    'menu_class' => 'group'
                ));
            else
                wp_page_menu(array('menu_class' => 'group'));
            ?>
        </div>
        <!-- .wrap < nav -->
    </nav>
</header>


<section id="main">
    <div class="wrap group">