<?php add_filter('pre_option_link_manager_enabled', '__return_true' );?>
<?php

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'topright',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'fooleft',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'bannerhome',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'bannersidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

function widget_search() {

?>

  <?php include (TEMPLATEPATH . '/searchform.php'); ?>

<?php

}

function widget_about() {

?>

  <div id="about" class="widget">

    <h2>Quem somos nós {<?php the_author(); ?>}</h2>

    <p><?php the_author_description(); ?>&nbsp;<a href="#">Leia mais</a></p>

  </div>

<?php

}

function widget_categories() {

?>

  <div id="categories" class="widget">

	<h3>Categorias</h3>

		<?php $args = array(
			'show_option_all'    => '',
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'none',
			'show_count'         => 0,
			'hide_empty'         => 1,
			'use_desc_for_title' => 1,
			'child_of'           => 0,
			'feed'               => '',
			'feed_type'          => '',
			'feed_image'         => '',
			'exclude'            => '',
			'exclude_tree'       => '',
			'include'            => '',
			'hierarchical'       => 1,
			'title_li'           => __( 'Categorias' ),
			'show_option_none'   => __('Sem caterogorias'),
			'number'             => null,
			'echo'               => 1,
			'depth'              => 0,
			'current_category'   => 0,
			'pad_counts'         => 0,
			'taxonomy'           => 'category',
			'walker'             => null
		);
		
		wp_list_categories( $args ); ?>

  </div>

<?php

}

if ( function_exists('register_sidebar_widget') ) {

    register_sidebar_widget(__('Search'), 'widget_search');

    register_sidebar_widget(__('Categories'), 'widget_categories');

    register_sidebar_widget(__('About'), 'widget_about');

}

function gte_recent_updated_posts(){

	global $wpdb, $post;

	$recentupdatethis = $wpdb->get_results("SELECT $wpdb->posts.ID, post_title, post_name, post_date, post_type, post_status, post_modified FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER by post_modified_gmt DESC limit 5");

	foreach ($recentupdatethis as $post) {

		$post_title = htmlspecialchars(stripslashes($post->post_title));

		echo "<li><a href=\"".get_permalink()."\">$post_title</a></li>";

	}
}

function get_hottopics($limit = 10) {

    global $wpdb, $post;

    $mostcommenteds = $wpdb->get_results("SELECT  $wpdb->posts.ID, post_title, post_name, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '".gmdate("Y-m-d H:i:s")."' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT $limit");

    foreach ($mostcommenteds as $post) {

			$post_title = htmlspecialchars(stripslashes($post->post_title));

			$comment_total = (int) $post->comment_total;

			echo "<li><a href=\"".get_permalink()."\">$post_title&nbsp;<strong>($comment_total)</strong></a></li>";

    }

}

function mw_recent_comments(

	$no_comments = 10,

	$show_pass_post = false,

	$title_length = 50, 	// shortens the title if it is longer than this number of chars

	$author_length = 30,	// shortens the author if it is longer than this number of chars

	$wordwrap_length = 50, // adds a blank if word is longer than this number of chars

	$type = 'all', 	// Comments, trackbacks, or both?

	$format = '<li>%date%: <a href="%permalink%" title="%title%">%title%</a> (from %author_full%)</li>',

	$date_format = 'd.m.y, H:i',

	$none_found = '<li>No comments.</li>',	// None found

	$type_text_pingback = 'Pingback from',

	$type_text_trackback = 'Trackback from',

	$type_text_comment = 'from'

	) {

	//Language...

	$mwlang_anonymous = 'Anonym'; // Anonymous

	$mwlang_authorurl_title_before = 'Website of &lsaquo;';

	$mwlang_authorurl_title_after = '&rsaquo; turn to';

    global $wpdb;

    $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, comment_date, post_title, comment_type

				FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID

				WHERE post_status IN ('publish','static')";

	switch($type) {

		case 'all':

			// add nothing

			break;

		case 'comment_only':

			//

			$request .= "AND $wpdb->comments.comment_type='' ";

			break;

		case 'trackback_only':

			$request .= "AND ( $wpdb->comments.comment_type='trackback' OR $wpdb->comments.comment_type='pingback' ) ";

			break;

	 default:

 		//

			break;

	}

	if (!$show_pass_post) $request .= "AND post_password ='' ";

	$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";

	$comments = $wpdb->get_results($request);

    $output = '';

	if ($comments) {

    	foreach ($comments as $comment) {

			// Permalink to post/comment

			$loop_res['permalink'] = get_permalink($comment->ID). '#comment-' . $comment->comment_ID;

			// Title of the post

			$loop_res['post_title'] = stripslashes($comment->post_title);

			$loop_res['post_title'] = wordwrap($loop_res['post_title'], $wordwrap_length, ' ' , 1);

			if (strlen($loop_res['post_title']) >= $title_length) {

				$loop_res['post_title'] = substr($loop_res['post_title'], 0, $title_length) . '&#8230;';

			}

			// Author's name only

        	$loop_res['author_name'] = stripslashes($comment->comment_author);

			$loop_res['author_name'] = wordwrap($loop_res['author_name'], $wordwrap_length, ' ' , 1);

			if ($loop_res['author_name'] == '') $loop_res['author_name'] = $mwlang_anonymous;

			if (strlen($loop_res['author_name']) >= $author_length) {

				$loop_res['author_name'] = substr($loop_res['author_name'], 0, $author_length) . '&#8230;';

			}

			// Full author (link, name)

			$author_url = $comment->comment_author_url;

			if (empty($author_url)) {

				$loop_res['author_full'] = $loop_res['author_name'];

			} else {

				$loop_res['author_full'] = '<a href="' . $author_url . '" title="' . $mwlang_authorurl_title_before . $loop_res['author_name'] . $mwlang_authorurl_title_after . '">' . $loop_res['author_name'] . '</a>';

			}

			// Comment type

			if ( $comment->comment_type == 'pingback' ) {

				$loop_res['comment_type'] = $type_text_pingback;

			} elseif ( $comment->comment_type == 'trackback' ) {

				$loop_res['comment_type'] = $type_text_trackback;

			} else {

				$loop_res['comment_type'] = $type_text_comment;

			}

			// Date of comment

			$loop_res['comment_date'] = mysql2date($date_format, $comment->comment_date);

			// Output element

			$element_loop = str_replace('%permalink%', $loop_res['permalink'], $format);

			$element_loop = str_replace('%title%', $loop_res['post_title'], $element_loop);

			$element_loop = str_replace('%author_name%', $loop_res['author_name'], $element_loop);

			$element_loop = str_replace('%author_full%', $loop_res['author_full'], $element_loop);

			$element_loop = str_replace('%date%', $loop_res['comment_date'], $element_loop);

			$element_loop = str_replace('%type%', $loop_res['comment_type'], $element_loop);

			$output .= $element_loop . "\n";

		} //foreach

		$output = convert_smilies($output);

	} else {

		$output .= $none_found;

    }

    echo $output;

}

// below are widget custom to custom the widget looks without the default //

function widget_mypopulartopic() {

?>

<?php if(function_exists("akpc_most_popular")) : ?>

<h3><?php _e('Most Popular'); ?></h3>

<ul class="list">

<?php akpc_most_popular(); ?>

</ul>

<?php endif; ?>

<?php

}

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('Popular Post'), 'widget_mypopulartopic');

function widget_myhottopic() {

?>

<?php if(function_exists("get_hottopics")) : ?>

<h3><?php _e('Most Comments'); ?></h3>

<ul class="list">

<?php get_hottopics(); ?>

</ul>

<?php endif; ?>

<?php

}

if ( function_exists('register_sidebar_widget') )

    register_sidebar_widget(__('Most Comments'), 'widget_myhottopic');

function widget_myrecentcoms() {

?>

<h3><?php _e('Recent Comments'); ?></h3>

<ul class="list">

<?php if(function_exists("get_recent_comments")) : ?>

<?php get_recent_comments(); ?>

<?php else : ?>

<?php mw_recent_comments(10, false, 55, 35, 35, 'all', '<li><a href="%permalink%" title="%title%">%author_name%</a>&nbsp;in&nbsp;%title%</li>','d.m.y, H:i'); ?>

<?php endif; ?>

</ul>

<?php

}

if ( function_exists('register_sidebar_widget') ){

    register_sidebar_widget(__('Recent Comments'), 'widget_myrecentcoms');
}

function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {

	global $request, $posts_per_page, $wpdb, $paged;

	if(empty($prelabel)) {

		$prelabel  = '<strong>&laquo;</strong>';

	}

	if(empty($nxtlabel)) {

		$nxtlabel = '<strong>&raquo;</strong>';

	}

	$half_pages_to_show = round($pages_to_show/2);

	if (!is_single()) {

		if(!is_category()) {

			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);		

		} else {

			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		

		}

		$fromwhere = $matches[1];

		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");

		$max_page = ceil($numposts /$posts_per_page);

		if(empty($paged)) {

			$paged = 1;

		}

		if($max_page > 1 || $always_show) {

			echo "$before <div class='Nav'><span>($max_page): </span>";

			if ($paged >= ($pages_to_show-1)) {

				echo '<a href="'.get_pagenum_link().'">&laquo; Primeira</a> ... ';

			}

			previous_posts_link($prelabel);

			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {

				if ($i >= 1 && $i <= $max_page) {

					if($i == $paged) {

						echo "<strong class='on'>$i</strong>";

					} else {

						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';

					}

				}

			}

			next_posts_link($nxtlabel, $max_page);

			if (($paged+$half_pages_to_show) < ($max_page)) {

				echo ' ... <a href="'.get_pagenum_link($max_page).'">Ultima &raquo;</a>';

			}

			echo "</div> $after";

		}

	}

}

function social_subpanel() {

     if (isset($_POST['save_social_settings'])) {

       $option_facebook = $_POST['facebook'];

       $option_twitter = $_POST['twitter'];

       $option_youtube = $_POST['youtube'];

       $option_tumblr = $_POST['tumblr'];
	   
	   $option_feedburner = $_POST['feedburner'];
	   
	   $option_feedburner_email = $_POST['feedburner_email'];
	   
	   $option_headerh1color = $_POST['headerh1color'];	   
	   
	   $option_headerh1acolor = $_POST['headerh1acolor'];	   
	   
	   $option_headerh1ahover = $_POST['headerh1ahover'];	   
	   
	   $option_headerh1bghover = $_POST['headerh1bghover'];	   
	   
	   $option_headerh2color = $_POST['headerh2color'];	   
	   
	   $option_topnavlicolor = $_POST['topnavlicolor'];	   
	   
	   $option_topnavliacolor = $_POST['topnavliacolor'];	   
	   
	   $option_topnavliahover = $_POST['topnavliahover'];	   
	   
	   $option_topnavlibghover = $_POST['topnavlibghover'];	   
	   
	   $option_logo = $_POST['logo'];	   
	   
	   $option_bgheader = $_POST['bgheader'];	   
  
	   $option_bgbody = $_POST['bgbody'];	

	   $option_bgrepeat = $_POST['bgrepeat'];	   	   
	   
	   $option_bgposition = $_POST['bgposition'];	   	   
	   
	   $option_bgattachment = $_POST['bgattachment'];	   	   	   
	   
	   $option_bgcolor = $_POST['bgcolor'];	

	   $option_bgfooter = $_POST['bgfooter'];		   
	   
	   $option_thumb_text = $_POST['thumb_text'];

       update_option('social_facebook', $option_facebook);

       update_option('social_twitter', $option_twitter);

       update_option('social_youtube', $option_youtube);

       update_option('social_tumblr', $option_tumblr);
	   
	   update_option('social_feedburner', $option_feedburner);
	   
	   update_option('social_feedburner_email', $option_feedburner_email);
	   
	   update_option('social_headerh1color', $option_headerh1color);
	   
	   update_option('social_headerh1acolor', $option_headerh1acolor);
	   
	   update_option('social_headerh1ahover', $option_headerh1ahover);
	   
	   update_option('social_headerh1bghover', $option_headerh1bghover);
	   
	   update_option('social_headerh2color', $option_headerh2color);
	   
	   update_option('social_topnavlicolor', $option_topnavlicolor);
	   
	   update_option('social_topnavliacolor', $option_topnavliacolor);
	   
	   update_option('social_topnavliahover', $option_topnavliahover);
	   
	   update_option('social_topnavlibghover', $option_topnavlibghover);
	   
	   update_option('social_logo', $option_logo);
	   
	   update_option('social_bgheader', $option_bgheader);	   
   
	   update_option('social_bgbody', $option_bgbody);
	   
	   update_option('social_bgfooter', $option_bgfooter);	   
	   
	   update_option('social_bgrepeat', $option_bgrepeat);
	   
	   update_option('social_bgposition', $option_bgposition);
	   
	   update_option('social_bgattachment', $option_bgattachment);	   
	   
	   update_option('social_bgcolor', $option_bgcolor);
	   
	   update_option('social_thumb_text', $option_thumb_text);
   	   
       ?> <div class="updated"><p>social settings saved</p></div>
	<?php }

	?>

	<div class="wrap">

		<h2>social Settings</h2>

		<form method="post">

		<table class="form-table">

         <tr valign="top">

          <th scope="row">Perfis</th>

          <td>
		  
		  Facebook: <input name="facebook" type="text" id="facebook" value="<?php echo get_option('social_facebook'); ?>" size="30" />
		  Twitter:<input name="twitter" type="text" id="twitter" value="<?php echo get_option('social_twitter'); ?>" size="30" />
		  Youtube:<input name="youtube" type="text" id="youtube" value="<?php echo get_option('social_youtube'); ?>" size="30" />
		  Tumblr:<input name="tumblr" type="text" id="tumblr" value="<?php echo get_option('social_tumblr'); ?>" size="30" /></p>
		  RSS:<input name="feedburner" type="text" id="feedburner" value="<?php echo get_option('social_feedburner'); ?>" size="120" /></p>
		  RSS por e-mail:<input name="feedburner_email" type="text" id="feedburner_email" value="<?php echo get_option('social_feedburner_email'); ?>" size="120" /></p>
		  
		  </td>
		
		<tr valign="top">
		  <th scope="row">Personaliza&ccedil;&atilde;o</th>

          <td>

		  Cabecalho h1 (RGB): #<input name="headerh1color" type="text" id="headerh1color" value="<?php echo get_option('social_headerh1color'); ?>" size="20" /><br>
		  Cabecalho h1 a (RGB): #<input name="headerh1acolor" type="text" id="headerh1acolor" value="<?php echo get_option('social_headerh1acolor'); ?>" size="20" />
		  Cabecalho h1 a:hover (RGB): #<input name="headerh1ahover" type="text" id="headerh1ahover" value="<?php echo get_option('social_headerh1ahover'); ?>" size="20" />
		  Cabecalho h1 a-bg:hover (RGB): #<input name="headerh1bghover" type="text" id="headerh1bghover" value="<?php echo get_option('social_headerh1bghover'); ?>" size="20" /><br>
		  Cabecalho h2 (RGB): #<input name="headerh2color" type="text" id="headerh2color" value="<?php echo get_option('social_headerh2color'); ?>" size="20" /><br>
		  Navegacao li (RGB): #<input name="topnavlicolor" type="text" id="topnavlicolor" value="<?php echo get_option('social_topnavlicolor'); ?>" size="20" /><br>
		  Navegacao li a (RGB): #<input name="topnavliacolor" type="text" id="topnavliacolor" value="<?php echo get_option('social_topnavliacolor'); ?>" size="20" />
		  Navegacao li a:hover (RGB): #<input name="topnavliahover" type="text" id="topnavliahover" value="<?php echo get_option('social_topnavliahover'); ?>" size="20" />
		  Navegacao li a-bg:hover (RGB): #<input name="topnavlibghover" type="text" id="topnavlibghover" value="<?php echo get_option('social_topnavlibghover'); ?>" size="20" /></p>
		  
		  Logo: <input name="logo" type="text" id="logo" value="<?php echo get_option('social_logo'); ?>" size="200" /><br>
		  Fundo topo: <input name="bgheader" type="text" id="bgheader" value="<?php echo get_option('social_bgheader'); ?>" size="200" /><br>
		  	  
		  Fundo rodape: <input name="bgfooter" type="text" id="bgfooter" value="<?php echo get_option('social_bgfooter'); ?>" size="200" /><br>		  		  
		  Fundo corpo imagem: <input name="bgbody" type="text" id="bgbody" value="<?php echo get_option('social_bgbody'); ?>" size="200" /><br>
		  Fundo corpo imagem repeat: <input name="bgrepeat" type="text" id="bgrepeat" value="<?php echo get_option('social_bgrepeat'); ?>" size="40" />
		  <br>não repete: no-repeat
		  <br>repete vertical e horizontal: repeat
		  <br>repete vertical: repeat-y
		  <br>repete horizontal: repeat-x</p>

		  Fundo corpo imagem position: <input name="bgposition" type="text" id="bgposition" value="<?php echo get_option('social_bgposition'); ?>" size="40" />
		  <br>x-pos y-pos
		  <br>x-% y-%
		  <br>top left
		  <br>top center
		  <br>top right
		  <br>center left
		  <br>center center
		  <br>center right
		  <br>bottom left
		  <br>bottom center
		  <br>bottom right</p>

		  Fundo corpo imagem attachment: <input name="bgattachment" type="text" id="bgattachment" value="<?php echo get_option('social_bgattachment'); ?>" size="40" />
		  <br>imagem fixa na tela: fixed
		  <br>imagem "rola" com a tela: scroll</p>

		  Fundo corpo cor (RGB): #<input name="bgcolor" type="text" id="bgcolor" value="<?php echo get_option('social_bgcolor'); ?>" size="20" /><br>
		  Exibe texto na miniatura de post: (s/n) <input name="thumb_text" type="text" id="thumb_text" value="<?php echo get_option('social_thumb_text'); ?>" size="1" /><br>		  
		  
		  </td>
		  
        </table>

        <div class="submit">

           <input type="submit" name="save_social_settings" value="<?php _e('Save Settings', 'save_social_settings') ?>" />

        </div>

        </form>

    </div>

<?php } // end social_subpanel()

function social_admin_menu() {

   if (function_exists('add_options_page')) {

        add_options_page('social Settings', 'social', 8, basename(__FILE__), 'social_subpanel');

        }

}

add_action('admin_menu', 'social_admin_menu'); 

function recent_cmts($num) {

	global $wpdb;

	$query = ("SELECT ID, post_title, comment_author, comment_id, comment_author_email, comment_date, comment_post_ID FROM  $wpdb->posts, $wpdb->comments WHERE $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND $wpdb->comments.comment_approved = '1' AND $wpdb->comments.comment_type = '' AND comment_author != '' ORDER BY $wpdb->comments.comment_date DESC LIMIT $num");

	$result = mysql_query($query);

		while ($data = mysql_fetch_row($result)) {

		echo '<li class="recent-cmts">';

			echo '<img style="float: left; margin-right: 10px; padding: 3px; background:#fff;" src="http://www.gravatar.com/avatar.php?gravatar_id=';

			echo md5($data[4]);

			echo '&amp;size=20&amp;default=';

			echo bloginfo('template_url');

			echo '/images/24.gif';

			echo '" alt="';

			echo $data[2];

			echo '&#39;s Gravatar" height="20" width="20" class="recent_gravatars" />';

			echo '<div style="margin-left:12px;"><a href="';

			echo get_permalink($data[0]);

			echo "#comment-$data[3]";

			echo '" title="';

			echo 'commented on &raquo; ';

			echo $data[1];

			echo '"><strong>';

			echo $data[2];

			echo '</strong></a><br/><small>[';

			echo $data[5];

			echo ']</small></div>';

		echo '</li>';

		}

	}

function fb_replace_wp_version() {

	if ( !is_admin() ) {

		global $wp_version;

		// random value

		$v = intval( rand(0, 9999) );

		if ( function_exists('the_generator') ) {

			// eliminate version for wordpress >= 2.4

			add_filter( 'the_generator', create_function('$a', "return null;") );

			// add_filter( 'wp_generator_type', create_function( '$a', "return null;" ) );

			// for $wp_version and db_version

			$wp_version = $v;

		} else {

			// for wordpress < 2.4

			add_filter( "bloginfo_rss('version')", create_function('$a', "return $v;") );

			// for rdf and rss v0.92

			$wp_version = $v;

		}

	}

}

if ( function_exists('add_action') ) {

	add_action('init', fb_replace_wp_version, 1);

}

/*     Variables     */

@define('CATEGORYTAGGING_VERSION', '2.4'); // Version

@define('CATEGORYTAGGING_BUILD', 1); // Build version

@define('CATEGORYTAGGING_ROOT', get_bloginfo('url') . '/' . PLUGINDIR . '/category-tagging/'); // Category Tagging directory

/*     Category Cloud Function <cattag_tagcloud>     */

function cattag_tagcloud(

	$min_scale = 10,

	$max_scale = 30,

	$min_include = 0,		// The minimum count to include a tag in the cloud. The default is 0 (include all tags).

	$sort_by = 'NAME_ASC',	// NAME_ASC | NAME_DESC | WEIGHT_ASC | WEIGHT_DESC

	$exclude = '',			// Tags to be excluded

	$include = '',			// Only these tags will be considered if you enter one ore more IDs

	$format = '<li><a rel="tag" href="%link%" title="%description% (%count%)" style="font-size:%size%pt">%title%<sub style="font-size:60%; color:#ccc;">%count%</sub></a></li>',

	$notfound = 'No tags found.'

	) {

	##############################################

	# Globals, variables, etc.

	##############################################

	$opt = array();

	$min_scale = (int) $min_scale;

	$max_scale = (int) $max_scale;

	$min_include = (int) $min_include;

	$exclude = preg_replace('/[^0-9,]/', '', $exclude);	// remove everything except 0-9 and comma

	$include = preg_replace('/[^0-9,]/', '', $include);	// remove everything except 0-9 and comma

	##############################################

	# Prepare order

	##############################################

	switch (strtoupper($sort_by)) {

		case 'NAME_DESC':

			$opt['$orderby'] = 'name';

			$opt['$ordertype'] = 'DESC';

	   		break;

		case 'WEIGHT_ASC':

			$opt['$orderby'] = 'count';

			$opt['$ordertype'] = 'ASC';

	   		break;

		case 'WEIGHT_DESC':

			$opt['$orderby'] = 'count';

			$opt['$ordertype'] = 'DESC';

	   		break;

		case 'RANDOM':	// Will be shuffled later 

			$opt['$orderby'] = 'name';

			$opt['$ordertype'] = 'ASC';

	   		break;

		default:	// 'NAME_ASC'

			$opt['$orderby'] = 'name';

			$opt['$ordertype'] = 'ASC';

	}

	##############################################

	# Retrieve categories

	##############################################	

	$catObjectOpt = array('type' => 'post', 'child_of' => 0, 'orderby' => $opt['$orderby'], 'order' => $opt['$ordertype'],

			'hide_empty' => true, 'include_last_update_time' => false, 'hierarchical' => 0, 'exclude' => $exclude, 'include' => $include,

			'number' => '', 'pad_counts' => false);

	$catObject = get_categories($catObjectOpt); // Returns an object of the categories

	##############################################

	# Prepare array

	##############################################

	// Convert object into array

	$catArray = cattag_aux_object_to_array($catObject); 

	// Remove tags

	$helper  = array_keys($catArray);	// for being able to unset 

	foreach( $helper as $cat ) { 

		if ( $catArray[$cat]['category_count'] < $min_include ) {

			unset($catArray[$cat]);

		}

	}

	// Exit if no tag found

	if (count($catArray) == 0) {

		return $notfound;

	}

	##############################################

	# Prepare font scaling

	##############################################

	// Get counts for calculating min and max values

	$countsArr = array();

	foreach( $catArray as $cat ) { $countsArr[] = $cat['category_count']; }

	$count_min = min($countsArr);

	$count_max = max($countsArr);

	// Calculate

	$spread_current = $count_max - $count_min; 

	$spread_default = $max_scale - $min_scale;

	if ($spread_current <= 0) { $spread_current = 1; };

	if ($spread_default <= 0) { $spread_default = 1; }

	$scale_factor = $spread_default / $spread_current;

	##############################################

	# Loop thru the values and create the result

	##############################################

	// Shuffle... -- thanks to Alex <http://www.artsy.ca/archives/159>

	if ( strtoupper($sort_by) == 'RANDOM') {

		$catArray = cattag_aux_shuffle_assoc($catArray);

	}

	$result = '';

	foreach( $catArray as $cat ) {

		// format

		$element_loop = $format;

		// font scaling		

		$final_font = (int) (($cat['category_count'] - $count_min) * $scale_factor + $min_scale);

		// replace identifiers

		$element_loop = str_replace('%link%', get_category_link($cat['cat_ID']), $element_loop);

		$element_loop = str_replace('%title%', $cat['cat_name'], $element_loop);

		$element_loop = str_replace('%description%', $cat['category_description'], $element_loop);

		$element_loop = str_replace('%count%', $cat['category_count'], $element_loop);

		$element_loop = str_replace('%size%', $final_font, $element_loop);

		// result

		$result .= $element_loop . "\n";	

	}

	$result = "\n" . '<!-- Tag Cloud, generated by \'Category Tagging\' plugin - http://blog.bull3t.me.uk/ -->' . "\n" . $result; // Please do not remove this line.

	return $result;

}

/*     Related Posts Function <cattag_related_posts>     */

function cattag_related_posts(

	$order = 'DATE_DESC',

	$limit = 5,

	$exclude = '',

	$display_posts = true,

	$display_pages = false,	

	$format = '<li><a href="%permalink%" title="%title%">%title%</a></li>',

	$dateformat = 'd.m',

	$notfound = '<li>No related posts found.</li>',

	$limit_days = 365

	) {

	##############################################

	# Globals, variables, etc.

	##############################################

	global $wpdb, $post, $wp_version;

	$limit = (int) $limit;

	$exclude = preg_replace('/[^0-9,]/','',$exclude);	// remove everything except 0-9 and comma

	##############################################

	# Prepare selection of posts and pages

	##############################################

	if ( ($display_posts === true) AND ($display_pages === true) ) {

		// Display both posts and pages

		$poststatus = "IN('publish', 'static')";

	} elseif ( ($display_posts === true) AND ($display_pages === false) ) {

		// Display posts only

		$poststatus = "= 'publish'";

	} elseif ( ($display_posts === false) AND ($display_pages === true) ) {

		// Display pages only

		$poststatus = "= 'static'";

	} else {

		// Nothing can be displayed

		return $notfound;

	}

	##############################################

	# Prepare exlusion of categories

	##############################################	

	$exclude_ids_sql = ($exclude == '') ? '' : 'AND post2cat.category_id NOT IN(' . $exclude . ')';

	##############################################

	# Put the category IDs into a comma-separated string

	##############################################

	$catsList = '';

	$count = 0;

	foreach((get_the_category()) as $loop_cat) { 

		// Add category id to list

		$catsList .= ( $catsList == '' ) ? $loop_cat->cat_ID : ',' . $loop_cat->cat_ID;

	}

	##############################################

	# Prepare order

	##############################################

	switch (strtoupper($order)) {

		case 'RANDOM':

			$order_by = 'RAND()';

			break;

		default:	// 'DATE_DESC'

			$order_by = 'posts.post_date DESC';

	}

	##############################################

	# Set limit of posting date. 86400 seconds = 1 day

	##############################################

	$timelimit = '';

	if ($limit_days != 0) $timelimit = 'AND posts.post_date > ' . date('YmdHis', time() - $limit_days*86400);

	##############################################

 	# SQL query. DISTINCT is here for getting a unique result without duplicates

	##############################################

	// since we support >= WP 2.1 only, stuff like AND posts.post_date < '" . current_time('mysql') . "'

	// is not necessary as future posts now gain the post_status of 'future' 

	if ($wp_version < "2.3") {

		// check wp version - if lower than 2.3 use old database format of 'categories' and 'post2cat'

		$queryresult = $wpdb->get_results("SELECT DISTINCT posts.ID, posts.post_title, posts.post_date, posts.comment_count

								FROM $wpdb->posts posts, $wpdb->post2cat post2cat

								WHERE posts.ID <> $post->ID

								AND posts.post_status $poststatus

								AND posts.ID = post2cat.post_id

								AND post2cat.category_id IN($catsList)

								$timelimit

								$exclude_ids_sql

								ORDER BY $order_by 

								LIMIT $limit

								");

	} else {

		// check wp version - if higher than 2.3 change to new database format of 'terms'

		$queryresult = $wpdb->get_results("SELECT DISTINCT posts.ID, posts.post_title, posts.post_date, posts.comment_count

								FROM $wpdb->posts posts, $wpdb->term_relationships term_relationships, $wpdb->term_taxonomy term_taxonomy

								WHERE posts.ID <> $post->ID

								AND posts.post_status $poststatus

								AND posts.ID = term_relationships.object_id

								AND term_relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id

								AND term_taxonomy.term_id IN($catsList)

								$timelimit

								$exclude_ids_sql

								ORDER BY $order_by 

								LIMIT $limit

								");

	}

	##############################################

	// Return the related posts

	##############################################

	$result = '';

	if (count($queryresult) > 0) {

		foreach($queryresult as $tag_loop) {

			// Date of post

			$loop_postdate = mysql2date($dateformat, $tag_loop->post_date);

			// Get format

			$element_loop = $format;

			// Replace identifiers

			$element_loop = str_replace('%date%', $loop_postdate, $element_loop);

			$element_loop = str_replace('%permalink%', get_permalink($tag_loop->ID), $element_loop);

			$element_loop = str_replace('%title%', $tag_loop->post_title, $element_loop);

			$element_loop = str_replace('%commentcount%', $tag_loop->comment_count, $element_loop);

			// Add to list

			$result .= $element_loop . "\n";

		}

		$result = "\n" . '<!--  -->' . "\n" . $result; 

		return $result;

	} else {

		return $notfound;

	}

}

################################################################################

# Additional functions

################################################################################

function cattag_aux_object_to_array($obj) {

	// dumps all the object properties and its associations recursively into an array

	// Source: http://de3.php.net/manual/de/function.get-object-vars.php#62470

       $_arr = is_object($obj) ? get_object_vars($obj) : $obj;

       foreach ($_arr as $key => $val) {

               $val = (is_array($val) || is_object($val)) ? cattag_aux_object_to_array($val) : $val;

               $arr[$key] = $val;

       }

       return $arr;

}

function cattag_aux_shuffle_assoc($input_array) {

	   if(!is_array($input_array) or !count($input_array))

	       return null;

	   $randomized_keys = array_rand($input_array, count($input_array));

	   $output_array = array();

	   foreach($randomized_keys as $current_key) {

	       $output_array[$current_key] = $input_array[$current_key];

	       unset($input_array[$current_key]);

	   }

	   return $output_array;

}

?>
