<?php
/**
Main Plugin Class
**/

class Widget_Live_Editor {

	protected static $plugin_slug = WLE_PLUGIN_SLUG;
	protected static $version = WLE_PLUGIN_VERSION;
	protected static $instance = null;

	private function __construct() {
		$this->get_included_files();
		$this->add_customizer_actions();
		add_action( 'widgets_init' , array( $this , 'wle_register_widget' ) );
	}

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	function add_customizer_actions() {
		add_action( 'customize_register' , array( $this, 'wle_enqueue_styles' ) );
		add_action( 'customize_preview_init' , array( $this, 'enqueue_scripts' ) );
	}

	function wle_register_widget() {
		register_widget( 'WP_Widget_WLE' );
	}

	public function wle_enqueue_styles() {
		wp_enqueue_style( self::$plugin_slug . '-style' , plugins_url( '/css/wle-style.css' , __FILE__ ) , '' , self::$version );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( self::$plugin_slug . '-customize-prev' , plugins_url( '/js/wle-script.js' , __FILE__ ) , array( 'jquery' , 'customize-preview' ) , self::$version, true );
	}

	private function get_included_files() {
		$included_files = array( 'class-wle-make-panel' , 'wle-customize-register' , 'class-wp-widget-wle' ,
										'uri-and-localization' , 'wle-options' , 'class-wle-customizer-section' );
		foreach( $included_files as $file ) {
			include_once( plugin_dir_path( __FILE__ ) . "includes/{$file}.php" );
		}
	}

}