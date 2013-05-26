<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/ico" />
  
<title><?php wp_title(''); if (function_exists('is_tag') and is_tag()) { ?> <?php } elseif (is_search()) { ?> Busca por <?php echo wp_specialchars($s,1); } if ( !(is_404()) && (is_search()) or (is_single()) or (is_page()) or (function_exists('is_tag') and is_tag()) or (is_archive()) ) { ?> | <?php } ?> <?php bloginfo('name'); ?></title>
  
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/easySlider1.7.css" type="text/css" media="screen" />
<link title="style" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<!--[if lt IE 8]><script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script><![endif]-->
<!--/borky IE 7CSS-->
<!--/Custom JS-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/misc.js"></script>
<script type="text/javascript" src="/wp-includes/js/prototype.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fabtabulous.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/easySlider1.7.js"></script>

	<style type="text/css"> body {
	
	<?php if ( get_option('social_bgbody') != "") : ?>	
		background-image: url("<?php echo get_option('social_bgbody'); ?>");
	<?php endif; ?>

	<?php if ( get_option('social_bgrepeat') != "") : ?>	
		background-repeat: <?php echo get_option('social_bgrepeat'); ?>;
	<?php endif; ?>
	
	<?php if ( get_option('social_bgposition') != "") : ?>	
		background-position: <?php echo get_option('social_bgposition'); ?>;
	<?php endif; ?>
	
	<?php if ( get_option('social_bgattachment') != "") : ?>	
		background-attachment: <?php echo get_option('social_bgattachment'); ?>;
	<?php endif; ?>
	
	<?php if ( get_option('social_bgcolor') != "") : ?>	
		background-color:#<?php echo get_option('social_bgcolor'); ?>;
	<?php endif; ?>	
	
	} </style>


<?php wp_head(); ?>
</head>

<body>

<div id="header" class="fix"
	<?php if ( get_option('social_bgheader') != "") : ?> style="background: url('<?php echo get_option('social_bgheader'); ?>') no-repeat 0 0;"
	<?php endif; ?>
	
>
	<style type="text/css">
	#header h1 a:link, #header h1 a:visited, #header h1 a:active {

	<?php if ( get_option('social_headerh1acolor') != "") : ?>	
		color:#<?php echo get_option('social_headerh1acolor'); ?>;
	<?php endif; ?>
	
	}
	
	#header h1 a:hover {

	<?php if ( get_option('social_headerh1ahover') != "") : ?>	
		color:#<?php echo get_option('social_headerh1ahover'); ?>;
	<?php endif; ?>	   

	<?php if ( get_option('social_headerh1bghover') != "") : ?>	
		background:#<?php echo get_option('social_headerh1bghover'); ?>;
	<?php endif; ?>	   
	
	}
	
	#header h1 {
	
	<?php if ( get_option('social_headerh1color') != "") : ?>	
		color:#<?php echo get_option('social_headerh1color'); ?>;
	<?php endif; ?>	   

	}
	
	#header h2 {
	
	<?php if ( get_option('social_headerh2color') != "") : ?>	
		color:#<?php echo get_option('social_headerh2color'); ?>;
	<?php endif; ?>	   
	
	}
	</style>
	
<!--/Top navigation-->
<div id="topnav">

<style type="text/css">
#topnav li {

	<?php if ( get_option('social_topnavlicolor') != "") : ?>	
		color:#<?php echo get_option('social_topnavlicolor'); ?>;
	<?php endif; ?>	   

}
#topnav li a:link, #topnav li a:visited, #topnav li a:active {

	<?php if ( get_option('social_topnavliacolor') != "") : ?>	
		color:#<?php echo get_option('social_topnavliacolor'); ?>;
	<?php endif; ?>
	
	}
#topnav li a:hover {

	<?php if ( get_option('social_topnavliahover') != "") : ?>	
		color:#<?php echo get_option('social_topnavliahover'); ?>;
	<?php endif; ?>	   
	
	<?php if ( get_option('social_topnavlibghover') != "") : ?>	
		background:#<?php echo get_option('social_topnavlibghover'); ?>;
	<?php endif; ?>
	
	}
</style>

<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</div>
<!--/End Top navigation-->	
	
<!--Feeds e social-->
<div id="topsocial">

	<?php if (get_option('social_feedburner') != "") { ?>
	<li><a href="<?php echo get_option('social_feedburner'); ?>" title="RSS">
	<img width=36 height=37 src=<?php bloginfo("template_url")?>/images/feedrss.png alt="RSS"></a> <?php } ?>

	<?php if (get_option('social_feedburner_email') != "") { ?>
	<a href="<?php echo get_option('social_feedburner_email'); ?>" title="E-mail">
	<img width=36 height=37 src=<?php bloginfo("template_url")?>/images/feedemail.png alt="Email"></a> <?php } ?>
	
	<?php if (get_option('social_facebook') != "") { ?>
	<a href="http://facebook.com/<?php echo get_option('social_facebook'); ?>" title="Facebook">
	<img width=36 height=37 src=<?php bloginfo("template_url")?>/images/facebook.png alt="Facebook"></a> <?php } ?>
	
	<?php if (get_option('social_twitter') != "") { ?>
	<a href="http://twitter.com/<?php echo get_option('social_twitter'); ?>" title="Twitter">
	<img width=36 height=37 src=<?php bloginfo("template_url")?>/images/twitter.png alt="Twitter"></a> <?php } ?>
	
	<?php if (get_option('social_tumblr') != "") { ?>
	<a href="http://<?php echo get_option('social_tumblr'); ?>/tumblr.com" title="Tumblr">
	<img width=36 height=37 src=<?php bloginfo("template_url")?>/images/tumblr.png alt="Tumblr"></a> <?php } ?>
				
	<?php if (get_option('social_youtube') != "") { ?>
	<a href="http://youtube.com/<?php echo get_option('social_youtube'); ?>" title="Youtube">
	<img width=36 height=37 src=<?php bloginfo("template_url")?>/images/youtube.png alt="Youtube"></a> <?php } ?>
</div>
<!--End Feeds and social-->

<div id="mast">

	<?php if ( get_option('social_logo') != ""){ ?>
			<img width=300 height=200 src="<?php echo get_option('social_logo'); ?>" alt=""/>
		<?php }
	?>
							
</div><!--End mast-->

<div id="blurb">
<?php if ( function_exists('dynamic_sidebar')) : dynamic_sidebar('blurb'); endif; ?>

</div><!--End blurb-->

<div id="titulo">
<h1><a href="<?php echo get_settings('home'); ?>/" title="Home"><?php bloginfo('name'); ?></a></h1>
</div>

<div id="descricao">
<h2><?php bloginfo('description'); ?></h2>
</div>

<div class="bluetop">
<?php include (TEMPLATEPATH . '/inc/bluetop.php'); ?> 
</div>

</div><!--End Header-->

<div id="main-wrapper">