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
	 * Test construct().
	 *
	 * @see Plugin::__construct().
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
		$this->assertEquals( 10, has_action( 'init', array( $this->plugin, 'textdomain' ) ) );
	}

	/**
	 * Test load_files().
	 *
	 * @see Plugin::load_files().
	 */
	public function test_load_files() {
	}

	/**
	 * Test init_classes().
	 *
	 * @see Plugin::init_classes().
	 */
	public function test_init_classes() {
		$this->plugin->init_classes();
	}
}
