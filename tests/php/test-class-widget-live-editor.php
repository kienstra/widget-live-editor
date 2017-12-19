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
	 * @see Widget_Live_Editor::__construct().
	 */
	public function test_construct() {
		$this->assertEquals( __NAMESPACE__ . '\Widget_Live_Editor', get_class( $this->instance ) );
		$this->assertEquals( Widget_Live_Editor::ID_BASE, $this->instance->id_base );
		$this->assertEquals( 'Widget Live Editor', $this->instance->name );
		$this->assertTrue( $this->instance->widget_options['customize_selective_refresh'] );
		$this->assertEquals( 'Live-edit a widget.', $this->instance->widget_options['description'] );
	}

	/**
	 * Test update().
	 *
	 * @see Widget_Live_Editor::update().
	 */
	public function test_update() {
		$image            = '54321';
		$heading          = 'Example Header';
		$copy             = 'Baz Copy';
		$link             = 'http://example.com/baz';
		$disallowed_value = 'example-disallowed-value';
		$new_instance     = array(
			Widget_Live_Editor::IMAGE   => $image,
			Widget_Live_Editor::HEADING => $heading,
			Widget_Live_Editor::COPY    => $copy,
			Widget_Live_Editor::LINK    => $link,
		);
		$updated_instance = $this->instance->update( $new_instance, array() );
		$this->assertEquals( $image, $updated_instance[ Widget_Live_Editor::IMAGE ] );
		$this->assertEquals( $heading, $updated_instance[ Widget_Live_Editor::HEADING ] );
		$this->assertEquals( $copy, $updated_instance[ Widget_Live_Editor::COPY ] );
		$this->assertEquals( $link, $updated_instance[ Widget_Live_Editor::LINK ] );
		$this->assertFalse( isset( $updated_instance[ $disallowed_value ] ) );
	}

	/**
	 * Test get_fields().
	 *
	 * @see Widget_Live_Editor::__construct().
	 */
	public function test_get_fields() {
		$fields = $this->instance->get_fields();
		$this->assertTrue( in_array( Widget_Live_Editor::IMAGE, $fields, true ) );
		$this->assertTrue( in_array( Widget_Live_Editor::HEADING, $fields, true ) );
		$this->assertTrue( in_array( Widget_Live_Editor::COPY, $fields, true ) );
		$this->assertTrue( in_array( Widget_Live_Editor::LINK, $fields, true ) );
	}
}
