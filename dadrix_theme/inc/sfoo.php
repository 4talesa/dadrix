<!--/Post and tag counts-->

<p>&copy; <?php echo date("Y")." ";  ?>
<a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>">
<?php bloginfo('name'); ?></a>. <br />
Criado por <a href="http://dadrix.com.br/" title="dadrix">Dadrix</a>. 
<br />Com <?php echo get_num_queries(); ?> consultas <?php timer_stop(1); ?> em segundos. <br />
<a href="http://jigsaw.w3.org/css-validator/">CSS 2.1.</a> | <a href="http://validator.w3.org/">XHTML 1.0</a><br />
<?php
$num_posts = wp_count_posts( 'post' );
$num_pages = wp_count_posts( 'page' );
$num_cats  = wp_count_terms('category');
$num_tags = wp_count_terms('post_tag');
$post_type_texts = array();

if ( !empty($num_posts->publish) ) { 
	$post_text = sprintf( __ngettext( '%s postagem', '%s postagens', $num_posts->publish ), number_format_i18n( $num_posts->publish ) );
	$post_type_texts[] = $can_edit_posts ? "$post_text" : $post_text;
}
if ( $can_edit_pages && !empty($num_pages->publish) ) { 
	$post_type_texts[] = ''.sprintf( __ngettext( '%s página', '%s páginas', $num_pages->publish ), number_format_i18n( $num_pages->publish ) ).'';
}
if ( $can_edit_posts && !empty($num_posts->draft) ) {
	$post_type_texts[] = '<a href="edit.php?post_status=draft">'.sprintf( __ngettext( '%s rascunho', '%s rascunhos', $num_posts->draft ), number_format_i18n( $num_posts->draft ) ).'</a>';
}
if ( $can_edit_posts && !empty($num_posts->future) ) {
	$post_type_texts[] = ''.sprintf( __ngettext( '%s agendamento', '%s agendamentos', $num_posts->future ), number_format_i18n( $num_posts->future ) ).'';
}

if ( current_user_can('publish_posts') && !empty($num_posts->pending) ) {
	$pending_text = sprintf( __ngettext( 'Existe %2$s postagens pendentes para sua revisão.', 'Existe %2$s postagens pendentes para sua revisão.', $num_posts->pending ), 'edit.php?post_status=pending', number_format_i18n( $num_posts->pending ) );
} else {
	$pending_text = '';
}

$cats_text = sprintf( __ngettext( '%s categoria', '%s categorias', $num_cats ), number_format_i18n( $num_cats ) );
$tags_text = sprintf( __ngettext( '%s etiqueta', '%s etiquetas', $num_tags ), number_format_i18n( $num_tags ) );
if ( current_user_can( 'manage_categories' ) ) {
	$cats_text = "$cats_text";
	$tags_text = "$tags_text";
}

$post_type_text = implode(', ', $post_type_texts);

$sentence = sprintf( __( '%1$s com %2$s, %3$s %4$s' ), $post_type_text, $cats_text, $tags_text, $pending_text );
$sentence = apply_filters( 'dashboard_count_sentence', $sentence, $post_type_text, $cats_text, $tags_text, $pending_text );

?>
<?php echo $sentence; ?>
<?php
$sidebars_widgets = wp_get_sidebars_widgets();
$num_widgets = array_reduce( $sidebars_widgets, create_function( '$prev, $curr', 'return $prev+count($curr);' ) );
$widgets_text = sprintf( __ngettext( '%d widget', '%d widgets', $num_widgets ), $num_widgets );
if ( $can_switch_themes = current_user_can( 'switch_themes' ) )
	$widgets_text = "$widgets_text";
?>	