<?php

/*
Plugin Name: Widget Live Editor
Plugin URI: www.ryankienstra.com/plugins/widget-live-editor
Description: See instant updates as you edit. Select and resize images and vectors. Enter text, and link to any page or post.
Version: 1.0.3
Author: Ryan Kienstra
Author URI: www.ryankienstra.com
License: GPLv2

*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WLE_PLUGIN_SLUG' , 'widget-live-editor' );
define( 'WLE_PLUGIN_VERSION' , '1.0.3' );

load_plugin_textdomain( 'widget-live-editor' , false , basename( dirname( __FILE__ ) ) . '/languages' );

add_action( 'wp_enqueue_scripts' , 'wle_enqueue_style' );
function wle_enqueue_style() {
	wp_enqueue_style( WLE_PLUGIN_SLUG . '-style' , plugins_url( '/css/wle-style.css' , __FILE__ ) , array() , WLE_PLUGIN_VERSION );
}

register_activation_hook( __FILE__ , 'wle_activate_with_default_options' );
function wle_activate_with_default_options() {
	$wle_plugin_options = array(
	'anchor_text' => "Read more" ,
		'anchor_class' => "" ,
		'alignment' => "" ,
		'allow_vectors' => 0 ,
		'allow_video' => 0 ,
	);

	add_option( 'wle_options' );
	add_option( 'wle_plugin_options' , $wle_plugin_options );
}

register_activation_hook( __FILE__ , 'wle_deactivate_if_early_wordpress_version' );
function wle_deactivate_if_early_wordpress_version() {
	if ( version_compare( get_bloginfo( 'version' ) , '4.0' , '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
	}
}

include_once( plugin_dir_path( __FILE__ ) . 'class-widget-live-editor.php' );
Widget_Live_Editor::get_instance();