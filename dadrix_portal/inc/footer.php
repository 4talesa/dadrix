<div class="fooleft">

<?php if ( function_exists('dynamic_sidebar')) : dynamic_sidebar('fooleft'); endif; ?>

</div>

<div class="fooright">

<p>&copy; <?php echo date("Y")." ";  ?>
<a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>">
<?php bloginfo('name'); ?></a>.

Criado por <a href="http://dadrix.com.br/" title="dadrix"><img src="<?php bloginfo('template_url'); ?>/images/dadrixlogo.png" alt="Dadrix"></a>. 

</div>

</div>

<?php wp_footer(); ?>
</body>
</html>