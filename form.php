<?php
add_action( 'init','contribute_form_posted');
function contribute_form_posted(){
	if( isset( $_POST['contribute_form_submit'] ) ){
		?>
		<code>
			<?php echo var_export( $_POST ); die("\nX__x\n"); ?>
		</code>
		<?php
	}
}
function contribute_form( $args, $content, $tag ){
	$default_textarea_size = 5;
	$defaults = array(
		'id'	=>	'contribute',
		'title'	=>	FALSE,
		'caption'	=>	'',
		'category'	=>	FALSE,
		'image'	=>	FALSE,
		'description'	=> $default_textarea_size,	
		)
	;
	$id = $args['id'];
	$args = shortcode_atts( $defaults, $args, $tag );
	$title = empty( $args['title'] ) ? ucwords( $args['id'] ) : $args['title'];
	$description = $args['description'] and !is_numeric( $args['description'] ) ? $default_textarea_size : $args['description'];
	$args['category'] = is_string( $args['category'] ) ? preg_replace( array('/open_category,/','/open_category$/') , '', $args['category'] ) : FALSE;
	$categories = is_string( $args['category'] ) ? explode( ',' , $args['category'] ) : FALSE;
	$image = !empty( $args['image'] );
	?>
	<h1><?php echo $title; ?></h1>
	<form method="POST">
		<ol>
		<?php
		if( $image ){
			?>
			<li>
				<label for="contribute_image" >
					<?php echo __('Pick an image to ilustrate your idea'); ?>
					<?php
					if( function_exists( 'contribute_drop_image_field' ) ){
						contribute_drop_image_field( $id );
					}
					else{
						?>
					<input type="file" id="contribute_image" name="contribute_image">
				</label>
			</li>
		<?php
			}
		}
		if( $open_category ){
			?>
			<li>
				<input type="text" id="contribute_new_category" name="contribute_new_category" placeholder="<?php echo __('Sugest a category') ?>">
			</li>
			<?php
		}
		if( !empty( $categories ) ){
			?>
			<li>
				<?php echo __('Explain.') ?>
				<select id="contribute_select_category" name="contribute_select_category" >
					<?php
					foreach( $categories as $category ){
						?>
					<option id="<?php echo sanitize_key( $category ); ?>"><?php echo $category ?></option>	
						<?php
					}
					?>
				</select>
			</li>
		<?php			
		}
		if( $description ){
			?>
			<li>
				<?php echo __('Explain.') ?>
				<textarea id="contribute_description" size=<?php echo $args['description'] ?> placeholder="<?php echo __('Tell us about your idea') ?>"></textarea>
			</li>
			<?php
		}
		?>
		<li>
			<?php echo __('Send.') ?>
			<input type="submit" id="contribute_form_submit" name="contribute_form_submit">
		</li>
		</ol>
	</form>
	<?php
}
?>