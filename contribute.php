<?php
/*
Plugin Name: Contribute
Plugin URI: lucilio.net/projetos/wp-contribute
Description: Suggestion box
Version: 0.1
Author: Lucilio Correia
Author URI: http://www.lucilio.net
*/

//Setup

define( 'PLUGIN_PATH' , dirname(__FILE__)  . DIRECTORY_SEPARATOR  );
define( 'PLUGIN_URL', plugin_dir_url(__FILE__) );
function plugin_path( $filename, $test = FALSE ){
	return preg_replace( '/[\/\\\\]+/' , DIRECTORY_SEPARATOR, PLUGIN_PATH. $filename );
}
function plugin_url( $filename, $secure = FALSE ){
	return PLUGIN_URL . "$filename";
}


$modules = array(
	'options',
	'form',
	'shortcodes',
	)
;

//Load auxiliar elements
foreach( $modules as $mod_name ){
	load( $mod_name );
}

//Auxiliar functions
function load( $filename = NULL ){
	$filename =  plugin_path( $filename ) . '.php';
	if( file_exists( $filename ) ){
		include_once( $filename );
	}
	else{
		die("X_X $filename doesn't exists" );
	}
}

