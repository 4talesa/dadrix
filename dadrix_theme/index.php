<?php get_header(); ?>
 
<div class="home fix">

  <div class="main">
    <div class="fix">
      
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  			<div class="post" id="post-<?php the_ID(); ?>">
  			  <div class="thumb main" 
				<?php if ( get_option('social_thumb_text_width') != "" || get_option('social_thumb_text_height') != "") {?> 					
					style = "
					<?php if ( get_option('social_thumb_text_width') != "" ) : ?>
						width:<?php echo get_option('social_thumb_text_width'); ?>px;
					<?php endif; ?>
					<?php if ( get_option('social_thumb_text_height') != "") : ?>
						height:<?php echo get_option('social_thumb_text_height'); ?>px;
					<?php endif; ?>
					";
				<?php } ?> >
  			    <p class="thumb-balloon"><?php comments_popup_link('0', '1', '%'); ?></p>  			    
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">						
						<div class="thumb-text">
							<?php
								$image = get_post_meta($post->ID, 'thumbnail', true);					
								if($image != ''){ ?>
									<img width="235" height="150" src="<?php echo $image; ?>" alt="" class="alignleft"/>
								<?php }
							?>
							<?php if ( get_option('social_thumb_text') == "s") : ?>	
								<?php the_excerpt(); ?>												
							<?php endif; ?>							
						</div>
					</a>			
					<div class="thumb-title">
						<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title() ?></a></h2>
					</div>				  
  				</div><!--/Retrieves info from custom fields-->	
  			</div>
  		  <?php endwhile; ?>
  			
  		  <?php else : ?>
  		  <div class="post single">
    			<h2>Nenhum resultado</h2>
    			<div class="entry">
    				<div class="notfound">
					</div>
    			</div>
    		</div>
  		<?php endif; ?>

      <div class="clear both"></div>

<?php if(function_exists('wp_pagenavi')) : ?>
<?php { wp_pagenavi('', '', '', '', 3, false);} ?>
<?php else : ?>
  <div class="navigation fix">
  	<div class="alignleft"><?php next_posts_link('&laquo; Mais antigos') ?></div>
  	<div class="alignright"><?php previous_posts_link('Mais novos &raquo;') ?></div>
  </div>
<?php endif; ?>

        
        <div class="clear both"></div>
  			
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