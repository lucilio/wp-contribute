<?php 
add_shortcode( 'contribute-form','contribute_form' ); #refered function is in form.php
add_shortcode( 'contribute-list','contribute_list' );
function contribute_list( $args, $content, $tag ){
	$contribute_data = get_option( 'contribute_data', array() );
	$defaults = array(
		'id'	=>	'contribute',
		'title'	=>	FALSE,
		)
	;
	$id = in_array( $args['id'] , array( 'FALSE', 'false', '0' ) ) ? FALSE : $args['id'];
	$args = shortcode_atts( $defaults, $args, $tag );
	$title = empty( $args['title'] ) ? ucwords( $args['id'] ) : $args['title'];
	$description = $args['description'] ? $default_textarea_size : $args['description'];
	$args['category'] = is_string( $args['category'] ) ? preg_replace( array('/open_category,/','/open_category$/') , '', $args['category'] ) : FALSE;
	$categories = is_string( $args['category'] ) ? explode( ',' , $args['category'] ) : FALSE;
	$image = !empty( $args['image'] );
	$name = 
	if( count( $contribute_data ) > 0 ){
		?>
	<ul id="contribute_list<?php $id ? ( '_' . $id ) : ''; ?>">
		<?php
		foreach( $contribute_data as $item => $contribute_data_item ){
			?>
		<li class="contribute_list_item item_<?php echo $item; ?>">
			<dl>
			<?php
			foreach( $contribute_data_item as $key => $value ){
				?>
				<dt><?php echo $item_title; ?></dt>
				<dd><?php echo $value; ?></dd>
				<?php
			}
			?>
			</dl>
		</li>	
			<?php
		}
		?>
	</ul>
		<?php
	}
}
?>