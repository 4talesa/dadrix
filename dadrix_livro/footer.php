<div class="footer"<?php if ( get_option('social_bgfooter') != "") : ?> style="background: url('<?php echo get_option('social_bgfooter'); ?>') no-repeat 0 0;"
	<?php endif; ?>
	
>

<div class="fooleft">

<?php if ( function_exists('dynamic_sidebar')) : dynamic_sidebar('fooleft'); endif; ?>

</div>

<div class="fooright">

<p>&copy; 2012 - <?php echo date("Y")." ";  ?>
<a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>">
<?php bloginfo('name'); ?></a>.

Criado por <a href="http://dadrix.com.br/" title="dadrix"><img src="<?php bloginfo('template_url'); ?>/images/dadrixlogo.png" alt="Dadrix"></a>. 

</div>

</div>

</div>

<?php wp_footer(); ?>
</body>
</html>