<?php
/*
Template Name: page
*/
?>
<?php get_header(); ?>
<div class="home fix">
  <div class="main">
    <div class="fix">
      
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  			<div class="post single fix" id="post-<?php the_ID(); ?>">
  			  <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title() ?></a></h2>
  			  <div class="meta">
  			    <?php edit_post_link(' (edit this)', '', ''); ?>
  			  </div>
  			  <div class="entry">
  					<?php the_content('<p>Leia mais&raquo;</p>'); ?>
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
  				</div>
  			</div>
  		<?php endwhile; else : ?>
  		<?php endif; ?>
  	<?php include (TEMPLATEPATH . '/inc/spo.php'); ?>	
  	</div>
  </div>          
           <?php include (TEMPLATEPATH . '/sidebar.php'); ?>
</div>
</div>
<?php include (TEMPLATEPATH . '/inc/bar.php'); ?>

<div class="footer"
	<?php if ( get_option('social_bgfooter2') != "" || get_option('social_footer2_height') != "") {?> 					
	style = "
		<?php if ( get_option('social_bgfooter2') != "" ) : ?>
			background: url('<?php echo get_option('social_bgfooter2'); ?>');
		<?php endif; ?>
		
		<?php if ( get_option('social_footer2_height') != "" ) : ?>
			height: <?php echo get_option('social_footer2_height'); ?>px;
		<?php endif; ?>
	";
	<?php } ?>	
>

<?php include (TEMPLATEPATH . '/inc/footer.php'); ?>
</div>