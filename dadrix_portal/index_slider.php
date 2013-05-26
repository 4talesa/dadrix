	<script type="text/javascript">
	$(document).ready(function(){	
		$("#slider").easySlider({
			prevId: 		'prevBtn',
			prevText: 		'<<',
			nextId: 		'nextBtn',	
			nextText: 		'>>',
			auto: true,
			continuous: true,
			nextId: "slider1next",
			prevId: "slider1prev",
			numeric: true
		});
	});	
	</script>
	<div id="slider-container">	
		<div id="slider-content">	
			<div id="slider">
				<ul>

	<?php	
	global $post;
	$args = array( 'numberposts' => 5, 'offset'=> 0, 'orderby' => 'post_date', 'order' => 'DESC');
	$myposts = get_posts( $args );

	foreach( $myposts as $post ) :	setup_postdata($post); ?>

		<li>
			<a href="<?php the_permalink() ?>">
				<?php
					$image = get_post_meta($post->ID, 'thumbnail', true);					
					if($image != ''){ ?>
						<img width="235" height="150" src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="alignleft"/>
					<?php }
				?>
				<h2><?php the_excerpt(); ?></h2>
			</a>
		</li>		
		
	<?php
	endforeach;?>
	
				</ul>
			</div>			
		</div>
	</div>