<div id="blurb"

	<?php if ( get_option('social_nav_width') != "") {?> 					
	style = "
		<?php if ( get_option('social_nav_width') != "" ) : ?>
			width:<?php echo get_option('social_nav_width'); ?>px;
		<?php endif; ?>		
	";
	<?php } ?>
	
>

<?php if ( function_exists('dynamic_sidebar')) : dynamic_sidebar('blurb'); endif; ?>

</div>