<?php
/**
 * Tests for class Widget_Live_Editor.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Tests for class Widget_Live_Editor.
 *
 * @package WidgetLiveEditor
 */
class Test_Widget extends \WP_UnitTestCase {
	/**
	 * Instance of widget.
	 *
	 * @var object
	 */
	public $instance;

	/**
	 * Setup.
	 *
	 * @inheritdoc
	 */
	public function setUp() {
		parent::setUp();
		require_once dirname( dirname( __DIR__ ) ) . '/php/class-widget-live-editor.php';
		$this->instance = new Widget_Live_Editor();
	}

	/**
	 * Test construct().
	 *
	 * @see Plugin::__construct().
	 */
	public function test_construct() {
		$this->assertEquals( __NAMESPACE__ . '\Widget_Live_Editor', get_class( $this->instance ) );
	}
}
