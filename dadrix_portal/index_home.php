<?php	
	$args_cat_home=array(
	  'orderby' => 'name',
	  'order' => 'ASC'
	  );
	$categories_home=get_categories($args_cat_home);
	foreach($categories_home as $category_home) :
		
		?>
		<div class="post-category">		
		<div class="post-category-balloon"><h2><?php echo $category_home->name; ?></h2>
		</div>
		<?php
		global $post;
		$args_home = array( 'numberposts' => 1, 'offset'=> 0, 'orderby' => 'post_date', 'order' => 'DESC', 'category' => $category_home->cat_ID);
		$myposts_home = get_posts( $args_home );

		foreach( $myposts_home as $post ) :	setup_postdata($post); ?>
				
				<div class="post" id="post-<?php the_ID(); ?>">				
				  <div class="thumb main">
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
							<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>							
							</h2>
						</div>				  
					</div>
				</div>
			
		<?php
		endforeach;
		?>
		</div><!--End post-category-->
		<?php
	endforeach;?>