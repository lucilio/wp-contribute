<?php
add_action( 'init','contribute_form_posted');
function contribute_form_posted(){
	if( isset( $_POST['contribute_form_submit'] ) ){
		?>
		<code>
			<?php echo var_export( $POST ); die("\nX__x\n"); ?>
		</code>
		<?php
	}
	else{
		wp_header('/');
	}
}
?>