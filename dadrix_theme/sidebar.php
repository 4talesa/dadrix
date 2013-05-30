<div id="sidebar">

<!--/Widgetized area-->

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar') ) : else : ?>

<?php /* If this is the frontpage */ if ( is_home()  ) { ?>

<?php include (TEMPLATEPATH . '/inc/featured.php'); ?>

<?php } ?>

<div class="clear"></div>

<?php if ( is_single()  ) { ?>

<?php include (TEMPLATEPATH . '/inc/sub.php'); ?>

<?php } ?>

<?php /* If this is the frontpage */ if ( is_home()  ) { ?>

<div class="green"></div>
<?php } ?>

<div class="clear"></div>

<?php endif; ?>

<?php include (TEMPLATEPATH . '/inc/ads.php'); ?>

</div>