<?php
/**
 * Main class for the Widget Live Editor plugin
 *
 * @package BootstrapSwipeGallery
 */

namespace WidgetLiveEditor;

/**
 * Main plugin class
 */
class Plugin {
	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.3';

	/**
	 * Plugin slug.
	 *
	 * @const string
	 */
	const SLUG = 'widget-live-editor';

	/**
	 * Plugin instance.
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * URL of the plugin.
	 *
	 * @var object
	 */
	public $location;

	/**
	 * Instantiated plugin classes.
	 *
	 * @var object
	 */
	public $components;

	/**
	 * Get the instance of this plugin
	 *
	 * @return object $instance Plugin instance.
	 */
	public static function get_instance() {
		if ( ! self::$instance instanceof Plugin ) {
			self::$instance = new Plugin();
		}

		return self::$instance;
	}

	/**
	 * Init the plugin.
	 *
	 * Load the files, instantiate the classes, and call their init() methods.
	 * And register the main plugin actions.
	 *
	 * @return void
	 */
	public function init() {
		$this->load_files();
		$this->init_classes();
		$this->location = plugins_url( self::SLUG );
		add_action( 'init', array( $this, 'textdomain' ) );
	}

	/**
	 * Load the plugin files.
	 *
	 * @return void
	 */
	public function load_files() {
	}

	/**
	 * Instantiate the plugin classes, and call their init() methods.
	 *
	 * @return void
	 */
	public function init_classes() {
	}

	/**
	 * Load the plugin's textdomain.
	 *
	 * @return void
	 */
	public function textdomain() {
		load_plugin_textdomain( self::SLUG );
	}
}
