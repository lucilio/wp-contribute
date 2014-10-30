<?php
//Add options menu
function add_options_menu(){
	$page_title = __('Contribute', 'contribute_plugin');
	$menu_title = __('Contribute', 'contribute_plugin');
	$capability = 'manage_options';
	$menu_slug = 'contrib';
	$function = 'contribute_options_menu';
	$icon_url = 'dashicons-lightbulb';
	$position = '21.3';
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
add_action( 'admin_menu', 'add_options_menu' );
//Options menu output
function contribute_options_menu(){
	?>
	<h1><?php echo __('Contribute', 'contribute_plugin'); ?></h1>
	<code>
		<?php
		echo var_export( func_get_args() );
		?>
	</code>
	<?php
}
?>