<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<?php $i = 0; ?>
<?php if ($comments) : ?>
<?php if (!('open' == $post-> comment_status)) : ?>
<span class="closecomment">
<?php _e('Comments are closed.')?>
</span>
<?php else : ?>
<?php endif; ?>

<h3 id="comments">
<?php comments_number('0', 'One', '%' );?> <span>responses <?php _e('so far')?>, <a href="#respond"> 
<?php _e('Say something?')?></a></span></h3>

<ol class="commentlist">
<?php foreach ($comments as $comment) : ?>
<?php $i++; ?>
<?php $comment_type = get_comment_type(); ?>
<?php if($comment_type == 'comment') { ?>
  
  
<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">

<div class="cleft">
  <?php 
if ( !empty( $comment->comment_author_email ) ) {
	$md5 = md5( $comment->comment_author_email );
	$default = urlencode( '' );
	echo "<img style=';margin:0 auto;' src='http://www.gravatar.com/avatar.php?gravatar_id=$md5&amp;size=30&amp;default=$default' alt='' />";
}
?>
<h5 class="comments"><?php comment_author_link() ?></h5>
<div class="commentmetadata">at <?php comment_time() ?></div>
</div>

<span class="count">
<?php echo $i; ?>
</span>
<?php comment_text() ?>
<?php if ($comment->comment_approved == '0') : ?>
<span class="moderate"><?php _e('Your comment is awaiting moderation')?>.</span>
<?php endif; ?>
</li>
<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>
<?php } /* End of is_comment statement */ ?>
<?php endforeach; /* end for each comment */ ?>
</ol>
<?php if (!('open' == $post-> comment_status)) : ?>
<p class="nocomments"><?php _e('Comments are closed')?>.</p>
<?php else : ?>
<?php endif; ?>
<div class="pingback">
<h3 id="trackback">Pingbacks/Trackbacks</h3>
<?php foreach ($comments as $comment) : ?>
<?php $comment_type = get_comment_type(); ?>
<?php if($comment_type != 'comment') { ?>
<li><?php comment_author_link() ?></li>
<?php } ?>
<?php endforeach; ?>
</div>
<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<?php else : // comments are closed ?>
<p class="nocomments"><?php _e('Comments are closed')?>.</p>
<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<h3 id="respond"><?php _e('Leave a comment')?></h3>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be')?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in')?></a> <?php _e('to post a comment')?>.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p><?php _e('Logged in as')?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Logout')?> &raquo;</a></p>
<?php else : ?>
<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e('Name')?><?php if ($req) echo "(required)"; ?></small></label></p>
<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e('Mail (not published/required)')?>    <?php if ($req) echo ""; ?> </small></label></p>
<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website')?></small></label></p>
<?php endif; ?>
<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>