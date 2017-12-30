<?php
/**
 * Tests for main plugin file.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Test for widget-live-editor.php.
 *
 * @package WidgetLiveEditor
 */
class Test_Widget_Live_Editor extends \WP_UnitTestCase {
	/**
	 * Setup.
	 *
	 * @inheritdoc
	 */
	public function setUp() {
		parent::setUp();
		require dirname( __DIR__ ) . '/widget-live-editor.php';
	}

	/**
	 * Test main plugin file
	 *
	 * @see widget-live-editor.php
	 */
	public function test_class_exists() {
		$this->assertTrue( class_exists( __NAMESPACE__ . '\Plugin' ) );
	}
}
