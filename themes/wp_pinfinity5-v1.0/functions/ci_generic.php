<?php 

/**
 * Echoes the web page title, depending on context.
 * 
 * @access public
 * @return void
 */
function ci_e_title()
{
	echo ci_title();
}

/**
 * Returns the web page title, depending on context.
 * 
 * @access public
 * @return string
 */
function ci_title()
{
	global $page, $paged;
	
	$sitename = ci_setting('logotext');
	$site_description = ci_setting('slogan');
	$sep = ci_setting('title_separator');
	$sep = ((!empty($sep)) ? ' '.$sep.' ' : ' | ');
	
	$title='';
	
	$title .= wp_title($sep, false, 'right'); 
	
	$title .= (!empty($sitename) ? $sitename : get_bloginfo('name'));
	
	if ((is_home() or is_front_page()))
		$title .= $sep . (!empty($site_description) ? $site_description : get_bloginfo('description'));
	
	//If in a page, include it in the title, mostly for SEO and bookmarking purposes.
	if ( $paged >= 2 or $page >= 2 )
		$title .= $sep . sprintf( __( 'Page %s', CI_DOMAIN ), max( $paged, $page ) );
		
	return $title;
}

/**
 * Returns an associative array of theme-dependend strings, that can be used as class names.
 * 
 * @access public
 * @return array
 */
function ci_theme_classes()
{
	$version = str_replace('.', '-', CI_THEME_VERSION);
	$classes['theme'] = "ci-" . CI_THEME_NAME;
	$classes['theme_version'] = "ci-" . CI_THEME_NAME . '-' . $version;
	return $classes;	
}


/**
 * Echoes the content or the excerpt, depending on user preferences.
 * 
 * @access public
 * @return void
 */
function ci_e_content($more_link_text = null, $stripteaser = false)
{
	global $post, $ci;
	if (is_single() or is_page())
		the_content(); 
	else
	{
		if(ci_setting('preview_content')=='enabled')
		{
			the_content($more_link_text, $stripteaser);
		}
		else
		{
			the_excerpt();
		}
	}
}

/**
 * Returns a string depending on the value of $num.
 * 
 * When $num equals zero, string $none is returned.
 * When $num equals one, string $one is returned.
 * When $num is greater than one, string $many is returned.
 * 
 * @access public
 * @param int $num
 * @param string $none
 * @param string $one
 * @param string $many
 * @return string
 */
function ci_inflect($num, $none, $one, $many){
	if ($num==0)
		return $none;
	if ($num==1)
		return $one;
	if ($num>1)
		return $many;
}

/**
 * Echoes a string depending on the value of $num.
 * 
 * When $num equals zero, string $none is echoed.
 * When $num equals one, string $one is echoed.
 * When $num is greater than one, string $many is echoed.
 * 
 * @access public
 * @param int $num
 * @param string $none
 * @param string $one
 * @param string $many
 * @return void
 */
function ci_e_inflect($num, $none, $one, $many){
	echo ci_inflect($num, $none, $one, $many);
}


/**
 * Returns a string of all the categories, tags and taxonomies the current post is under.
 * 
 * @access public
 * @param string $separator
 * @return string
 */
function ci_list_cat_tag_tax($separator=', ')
{
	global $post;

	$taxonomies = get_post_taxonomies();

	$i = 0;
	$the_terms = array();
	$the_terms_temp = array();
	$the_terms_list = '';
	foreach($taxonomies as $taxonomy)
	{
		$the_terms_temp[] = get_the_term_list($post->ID, $taxonomy, '', $separator, '');
	}

	foreach($the_terms_temp as $term)
	{
		if(!empty($term))
			$the_terms[] = $term;
	}
	
	$terms_count = count($the_terms);
	for($i=0; $i < $terms_count; $i++)
	{
		$the_terms_list .= $the_terms[$i];
		if ($i < ($terms_count-1))
			$the_terms_list .= $separator;
	}
	
	if (!empty($the_terms_list))
		return $the_terms_list;	
	else
		return __('Uncategorized');
}

/**
 * Echoes a string of all the categories, tags and taxonomies the current post is under.
 * 
 * @access public
 * @param string $separator
 * @return void
 */
function ci_e_list_cat_tag_tax($separator=', ')
{
	echo ci_list_cat_tag_tax($separator);
}



/**
 * Echoes pagination links if applicable. If wp_pagenavi plugin exists, it uses it instead.
 * 
 * @access public
 * @return void. 
 */
function ci_pagination()
{ 
	global $wp_query;
	if ($wp_query->max_num_pages > 1): ?>
		<div id="paging" class="navigation group">
			<?php if (function_exists('wp_pagenavi')): ?>
				<?php wp_pagenavi(); ?>
			<?php else: ?>
				<div class="nav-previous alignleft shadow"><?php next_posts_link( __( '<span class="nav-prev-symbol nav-symbol">&laquo;</span> Older posts', CI_DOMAIN ) ); ?></div>
				<div class="nav-next alignright shadow"><?php previous_posts_link( __( 'Newer posts <span class="nav-next-symbol nav-symbol">&raquo;</span>', CI_DOMAIN) ); ?></div>
			<?php endif; ?>
		</div>
	<?php endif;
}


/**
 * Echoes a CSSIgniter setting.
 * 
 * @access public
 * @param string $setting
 * @return void
 */
function ci_e_setting($setting)
{
	echo ci_setting($setting);
}

/**
 * Returns a CSSIgniter setting, or boolean FALSE on failure.
 * 
 * @access public
 * @param string $setting
 * @return string|false
 */
function ci_setting($setting)
{
	global $ci;
	if (isset($ci[$setting]) and (!empty($ci[$setting])))
		return $ci[$setting];
	else
		return FALSE;
}


/**
 * Returns the CSSIgniter logo snippet, either text or image if available.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return string
 */
function ci_logo($before="", $after=""){ 
	$snippet = $before;
		
    $snippet .= '<a href="'.home_url().'">';

    if(ci_setting('logo')){
		$snippet .= '<img src="'.ci_setting('logo').'" alt="'.ci_setting('logotext').'" />';
	} 
	else{
		$snippet .= ci_setting('logotext');
	}

    $snippet .= '</a>';
    
    $snippet .= $after;

    return $snippet;
}

/**
 * Echoes the CSSIgniter logo snippet, either text or image if available.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return void
 */
function ci_e_logo($before="", $after=""){ 
	echo ci_logo($before, $after);
}


/**
 * Returns the CSSIgniter slogan snippet, surrounded by optional strings.
 * When slogan is empty, false is returned.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return string
 */
function ci_slogan($before="", $after=""){ 
	$slogan = ci_setting('slogan');
	$snippet = $before.$slogan.$after;
	if (!empty($slogan))
		return $snippet;
	else
		return FALSE;
}

/**
 * Echoes the CSSIgniter slogan snippet, surrounded by optional strings.
 * When slogan is empty, nothing is echoed.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return void
 */
function ci_e_slogan($before="", $after=""){ 
	$slogan = ci_slogan($before, $after);
	if ($slogan) echo $slogan;
}




/**
 * Returns the date and time of the last posted post.
 * 
 * @access public
 * @return array
 */
function ci_last_update()
{
	global $post;
	$data = array();
	$posts = get_posts('numberposts=1&order=DESC&orderby=date');
	foreach ($posts as $post)
	{
		setup_postdata($post);	
		$data['date'] = get_the_date();
		$data['time'] = get_the_time();
	}
	return $data;
}


/**
 * Checks whether the current post has a Read More tag. Must be used inside the loop.
 * 
 * @access public
 * @return true|false
 */
function has_readmore()
{
	global $post;
	if(strpos(get_the_content(), "#more-")===FALSE)
		return FALSE;
	else
		return TRUE;
}

/**
 * Checks whether a page uses a specific page template.
 * 
 * @access public
 * @param string $page_template The page template you want to check if it's used.
 * @param int $pageid (Optional) The post id of the page you want to check. If null, checks the global post id.
 * @return true|false
 */
function has_page_template($page_template, $pageid=null)
{
	$template = get_template_of_page($pageid);
	if($template == $page_template)
	{
		return TRUE;
	}
	return FALSE;
}

/**
 * Returns the page template that is used on a specific page.
 * 
 * @access public
 * @param int $pageid (Optional) The post id of the page you want to check. If null, checks the global post id.
 * @return true|false
 */
function get_template_of_page($pageid=null)
{
	if ($pageid===null)
	{
		global $post;
		$pageid = $post->ID;
	}
	return get_post_meta($pageid, '_wp_page_template', true);
}

/**
 * Formats a price (amount of money) with a currency symbol, according to the setting specified in the panel.
 * 
 * @access public
 * @param float $amount An amount of money to format.
 * @return string
 */
function format_price($amount, $return_empty=FALSE)
{
	$string = '';
	if($return_empty===FALSE and empty($amount))
	{
		return FALSE;
	}
	
	if(ci_setting('price_currency'))
	{
		if(ci_setting('currency_position')=='before')
		{
			return ci_setting('price_currency') . $amount;
		}
		else
		{
			return $amount . ci_setting('price_currency');
		}
	}
	else
	{
		return $amount;
	}
}



/**
 * Retrieve or display list of posts as a dropdown (select list).
 *
 * @since 2.1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @param string $name Optional. Name of the select box.
 *  * @return string HTML content, if not displaying.
 */
function wp_dropdown_posts($args = '', $name='post_id') {
	$defaults = array(
		'depth' => 0, 
		'post_parent' => 0,
		'selected' => 0, 
		'echo' => 1,
		//'name' => 'page_id', // With this line, get_posts() doesn't work properly. 
		'id' => '',
		'show_option_none' => '', 'show_option_no_change' => '',
		'option_none_value' => '', 
		'post_type' => 'post', 'post_status' => 'publish'
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$pages = get_posts($r);
	$output = '';
	// Back-compat with old system where both id and name were based on $name argument
	if ( empty($id) )
		$id = $name;

	if ( ! empty($pages) ) {
		$output = "<select name='" . esc_attr( $name ) . "' id='" . esc_attr( $id ) . "'>\n";
		if ( $show_option_no_change )
			$output .= "\t<option value=\"-1\">$show_option_no_change</option>";
		if ( $show_option_none )
			$output .= "\t<option value=\"" . esc_attr($option_none_value) . "\">$show_option_none</option>\n";
		$output .= walk_page_dropdown_tree($pages, $depth, $r);
		$output .= "</select>\n";
	}

	$output = apply_filters('wp_dropdown_posts', $output);

	if ( $echo )
		echo $output;

	return $output;
}


/**
 * Multi-byte version of str_replace.
 *
 * @param string $needle The value being searched.
 * @param string $replacement The value that replaces the found needle.
 * @param string $haystack The string being searched and replaced on.
 * @return string
 */

function mb_str_replace($needle, $replacement, $haystack)
{
	return implode($replacement, mb_split($needle, $haystack));
}



//////////////////////////////////////////////////
//
// FEEDS
//
//////////////////////////////////////////////////

/**
 * Returns the site's custom feed URL, or the default if custom doesn't exist.
 * 
 * @access public
 * @return string
 */
function ci_rss_feed()
{
	if (ci_setting('feedburner_feed'))
		return ci_setting('feedburner_feed');
	else
		return get_bloginfo('rss2_url');
}

function ci_register_custom_feed()
{
	// Register FeedBurner feed if exists, else register automatic feeds.
	if (ci_setting('feedburner_feed'))
		add_action('wp_head', 'ci_feedburner_feed');
	else
		add_theme_support( 'automatic-feed-links' );
}

function ci_feedburner_feed()
{
	$s = '<link rel="alternate" type="application/rss+xml" title="'.get_bloginfo('name').' RSS Feed" href="'.ci_setting('feedburner_feed').'" />';
	echo $s;
}



add_action('after_setup_theme', 'ci_default_fields_set');
function ci_default_fields_set() { ci_default_options(false); }
function ci_default_options($assign_defaults=false)
{
	global $ci, $ci_defaults;
	
	if ($assign_defaults==true)
	{
		$ci = wp_parse_args($ci, $ci_defaults);
		update_option(THEME_OPTIONS, $ci);
	}
	else
	{
		foreach ($ci_defaults as $name=>$value)
		{
			if(!isset($ci[$name]))
				$ci[$name]='';
		}
	}
	
}

function ci_add_wmode_transparent($html) {

  if (strpos($html, "<embed src=" ) !== false) {
    $html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
    return $html;
  }
  else {
    if(strpos($html, "wmode=transparent") == false){
      if(strpos($html, "?fs=" ) !== false){
        $search = array('?fs=1', '?fs=0');
        $replace = array('?fs=1&wmode=transparent', '?fs=0&wmode=transparent');
        $html = str_replace($search, $replace, $html);
        return $html;
      }
      else{
        $youtube_embed_code = $html;
        $patterns[] = '/youtube.com\/embed\/([a-zA-Z0-9._-]+)/';
        $replacements[] = 'youtube.com/embed/$1?wmode=transparent';
        return preg_replace($patterns, $replacements, $html);
      }
    }
    else{
      return $html;
    }
  }
}
add_filter('embed_oembed_html', 'ci_add_wmode_transparent');


?>