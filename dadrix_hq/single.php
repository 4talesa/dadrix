<?php
/*
Template Name: single
*/
?>

<?php get_header(); ?>

<div class="home fix">

  <div class="mainsingle">

    <div class="fix">
      

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  			<div class="post single">
				<h2 class="title" id="post-<?php the_ID(); ?>"><?php the_title() ?></h2>
				<div class="entry">
					<?php the_content('<p>Leia mais&raquo;</p>'); ?>
<div class="clear"></div>

  				<div class="navigation">
      			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
      			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
      		</div>
<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>

  				</div>

  				<div class="clear"></div>
  				<div class="postMeta">
  				  <p>
  					  Postado por <?php the_author() ?> na categoria <?php the_category(', ') ?>.
  					<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
  						// Both Comments and Pings are open ?>
  						Pode <a href="#respond">deixar um comentario</a>, ou <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> para seu site.
  					<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
  						// Only Pings are Open ?>
  						Nao pode comentar, mas pode <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> para seu site.
  					<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
  						// Comments are open, Pings are not ?>
  						Nao pode comentar nem fazer trackback, mas pode fazer ping.
  					<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
  						// Neither Comments, nor Pings are open ?>
  						Nao pode comentar, nem fazer trackback nem fazer ping.
  					<?php } edit_post_link('Editar.','',''); ?>
              </p>
              <p>
                <?php the_tags('Tags: ', ', ', '<br />'); ?>
              </p>
              <p>Relacionados</p>
				<?php
				if( function_exists('cattag_related_posts') ) { echo '<ul>' . cattag_related_posts() . '</ul>'; }
				?>
</div><!-- postMeta -->

<div class="share"></div>
<div class="clear"></div>
    		  <?php comments_template(); ?>
  			</div><!-- post -->
<div class="clear"></div>
  		<?php endwhile; else : ?>
  		<p>Volte para <a href="<?php echo get_option('home'); ?>/"><?php the_title(); ?></a>.</p>
  		<?php endif; ?>
  	<?php include (TEMPLATEPATH . '/inc/spo.php'); ?>
  	</div>
  </div>           
</div>
</div>

<div class="footer">

<?php include (TEMPLATEPATH . '/inc/footer.php'); ?>
</div>