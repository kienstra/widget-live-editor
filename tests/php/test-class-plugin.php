<?php
/**
 * Tests for class Plugin.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Tests for class Plugin.
 *
 * @package WidgetLiveEditor
 */
class Test_Plugin extends \WP_UnitTestCase {
	/**
	 * Instance of plugin.
	 *
	 * @var object
	 */
	public $plugin;

	/**
	 * Setup.
	 *
	 * @inheritdoc
	 */
	public function setUp() {
		parent::setUp();
		$this->plugin = Plugin::get_instance();
	}

	/**
	 * Test get_instance().
	 *
	 * @see Plugin::get_instance().
	 */
	public function test_get_instance() {
		$this->assertEquals( Plugin::get_instance(), $this->plugin );
		$this->assertEquals( __NAMESPACE__ . '\Plugin', get_class( Plugin::get_instance() ) );
		$this->assertEquals( plugins_url( Plugin::SLUG ), $this->plugin->location );
	}

	/**
	 * Test init().
	 *
	 * @see Plugin::init().
	 */
	public function test_init() {
		$this->plugin->init();
		$this->assertTrue( class_exists( __NAMESPACE__ . '\Plugin' ) );
	}

	/**
	 * Test load_files().
	 *
	 * @see Plugin::load_files().
	 */
	public function test_load_files() {
		$this->assertTrue( class_exists( __NAMESPACE__ . '\Widget_Live_Editor' ) );
		$this->assertTrue( class_exists( __NAMESPACE__ . '\Asset' ) );
		$this->assertTrue( class_exists( __NAMESPACE__ . '\Field' ) );
	}

	/**
	 * Test init_classes().
	 *
	 * @see Plugin::init_classes().
	 */
	public function test_init_classes() {
		$this->plugin->init_classes();
		$this->assertEquals( 10, has_action( 'customize_controls_enqueue_scripts', array( $this->plugin->components->asset, 'enqueue_script' ) ) );
	}

	/**
	 * Test add_actions().
	 *
	 * @see Plugin::add_actions().
	 */
	public function test_add_actions() {
		$this->assertEquals( 10, has_action( 'init', array( $this->plugin, 'textdomain' ) ) );
		$this->assertEquals( 10, has_action( 'widgets_init', array( $this->plugin, 'register_widget' ) ) );
	}
}
