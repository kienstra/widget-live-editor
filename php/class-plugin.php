<?php
/**
 * Main class for the Widget Live Editor plugin
 *
 * @package WidgetLiveEditor
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
	const VERSION = '1.0.4';

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
		$this->add_actions();
	}

	/**
	 * Load the plugin files.
	 *
	 * @return void
	 */
	public function load_files() {
		require_once dirname( __FILE__ ) . '/class-widget-live-editor.php';
		require_once dirname( __FILE__ ) . '/class-asset.php';
		require_once dirname( __FILE__ ) . '/class-field.php';
	}

	/**
	 * Instantiate the plugin classes, and call their init() methods.
	 *
	 * @return void
	 */
	public function init_classes() {
		$this->components        = new \stdClass();
		$this->components->asset = new Asset( $this );
		$this->components->asset->init();
		$this->components->field = new Field( $this );
	}

	/**
	 * Add the plugin actions.
	 *
	 * @return void
	 */
	public function add_actions() {
		add_action( 'init', array( $this, 'textdomain' ) );
		add_action( 'widgets_init', array( $this, 'register_widget' ) );
	}

	/**
	 * Load the plugin's textdomain.
	 *
	 * @return void
	 */
	public function textdomain() {
		load_plugin_textdomain( self::SLUG );
	}

	/**
	 * Register the Adapter Responsive Video widget.
	 *
	 * @return void
	 */
	public function register_widget() {
		register_widget( __NAMESPACE__ . '\Widget_Live_Editor' );
	}
}
