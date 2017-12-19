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
 * @package BootstrapSwipeGallery
 */
class Test_Widget_Live_Editor extends \WP_UnitTestCase {
	/**
	 * Test main plugin file
	 *
	 * @see widget-live-editor.php
	 */
	public function test_class_exists() {
		$this->assertTrue( class_exists( __NAMESPACE__ . '\Plugin' ) );
	}
}
