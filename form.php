<?php
add_action( 'init','contribute_form_posted');
function contribute_form_posted(){
	if( isset( $_POST['contribute_form_submit'] ) ){
		$contribute_data = get_option( 'contribute_data', array() );
		$description = isset( $_POST['contribute_description'] ) ? $_POST['contribute_description'] : FALSE;
		if( $description ){
			$new_category = isset( $_POST['contribute_new_category'] ) ? $_POST['contribute_new_category'] : FALSE;
			$category = isset( $_POST['contribute_select_category'] ) ? $_POST['contribute_select_category'] : $_POST['contribute_new_category'];
			$image = isset( $_POST['contribute_image'] ) ? $_POST['contribute_image'] : FALSE;
			$contribute_data[] = compact( 'category', 'image', 'description', 'contact' );
		}
		update_option( 'contribute_data', $contribute_data );
		?>
		<code>
			<?php echo '#' . var_export( $contribute_data ); #die("\nX__x\n"); ?>
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
		'captcha' => TRUE,
		)
	;
	$id = in_array( $args['id'] , array( 'FALSE', 'false', '0' ) ) ? FALSE : $args['id'];
	$args = shortcode_atts( $defaults, $args, $tag );
	$title = empty( $args['title'] ) ? ucwords( $args['id'] ) : $args['title'];
	$description = $args['description'] and !is_numeric( $args['description'] ) ? $default_textarea_size : $args['description'];
	$args['category'] = in_array( $args['category'] , array( 'FALSE', 'false', '0' ) ) ? FALSE : preg_replace( array('/open_category,/','/open_category$/') , '', $args['category'] );
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
				<label for="contribute_image<?php echo $id ? ( '_' . $id ) : '' ?>" >
					<?php echo __('Pick an image to ilustrate your idea'); ?>
					<?php
					if( function_exists( 'contribute_drop_image_field' ) ){
						contribute_drop_image_field( $id );
					}
					else{
						?>
					<input type="file" id="contribute_image<?php echo $id ? ( '_' . $id ) : '' ?>" name="contribute_image">
				</label>
			</li>
		<?php
			}
		}
		if( !empty( $categories ) ){
			?>
			<li>
				<?php echo __('Up an idea.') ?>
				<select id="contribute_select_category<?php echo $id ? ( '_' . $id ) : '' ?>" name="contribute_select_category" >
					<?php
					foreach( $categories as $category ){
						?>
					<option id="<?php echo sanitize_key( $category ); ?><?php echo $id ? ( '_' . $id ) : '' ?>"><?php echo $category ?></option>	
						<?php
					}
					?>
				</select>
			</li>
		<?php			
		}
		if( $open_category ){
			?>
			<li>
				<label>
					<?php
					if( empty( $categories ) ){
						echo __('...or add your own');
					}
					else{
						echo __('Your idea');
					}
					?>
					<input type="text" id="contribute_new_category<?php echo $id ? ( '_' . $id ) : '' ?>" name="contribute_new_category" placeholder="<?php echo __('Sugest a category') ?>">
				</label>
			</li>
			<?php
		}
		if( $description ){
			?>
			<li>
				<?php echo __('Explain.') ?>
				<textarea id="contribute_description<?php echo $id ? ( '_' . $id ) : '' ?>" name="contribute_description" size=<?php echo $args['description'] ?> placeholder="<?php echo __('Tell us about your idea') ?>"></textarea>
			</li>
			<?php
		}
		if( in_array( $args['captcha'] , array( 'FALSE', 'false', '0' ) ) ){
			?>
			<fieldset>
				<img src="<?php echo plugin_url("captcha/captcha.php") ?>" id="captcha" /><br/>


				<!-- CHANGE TEXT LINK -->
				<a href="#" onclick="
				    document.getElementById('captcha').src='<?php echo plugin_url("captcha/captcha.php") ?>?'+Math.random();
				    document.getElementById('captcha-form').focus();"
				    id="change-image">Not readable? Change text.</a><br/><br/>


				<input type="text" name="captcha" id="captcha-form" autocomplete="off" /><br/>
			</fieldset>
			<?php
		}
		else{
			die("XXXXX");
		}
		?>
		<li>
			<?php echo __('Send.') ?>
			<input type="submit" id="contribute_form_submit<?php echo $id ? ( '_' . $id ) : '' ?>" name="contribute_form_submit">
		</li>
		</ol>
	</form>
	<?php
}
?>