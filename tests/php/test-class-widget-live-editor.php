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
class Test_Class_Widget_Live_Editor extends \WP_UnitTestCase {
	/**
	 * Instance of widget.
	 *
	 * @var object
	 */
	public $instance;

	/**
	 * Test image value.
	 *
	 * @var string
	 */
	public $image = 'http://example.com/54321';

	/**
	 * Test heading value.
	 *
	 * @var string
	 */
	public $heading = 'Example Header';

	/**
	 * Test copy value.
	 *
	 * @var string
	 */
	public $copy = 'Baz Copy';

	/**
	 * Test link value.
	 *
	 * @var string
	 */
	public $link = 'http://example.com/baz';

	/**
	 * Test disallowed value.
	 *
	 * @var string
	 */
	public $disallowed_value = 'example-disallowed-value';

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
		$disallowed_value = 'example-disallowed-value';
		$new_instance     = $this->widget_instance();
		$updated_instance = $this->instance->update( $new_instance, array() );
		$this->assertEquals( $this->image, $updated_instance[ Widget_Live_Editor::IMAGE ] );
		$this->assertEquals( $this->heading, $updated_instance[ Widget_Live_Editor::HEADING ] );
		$this->assertEquals( $this->copy, $updated_instance[ Widget_Live_Editor::COPY ] );
		$this->assertEquals( $this->link, $updated_instance[ Widget_Live_Editor::URL ] );
		$this->assertFalse( isset( $updated_instance[ $disallowed_value ] ) );
	}

	/**
	 * Test form().
	 *
	 * @see Widget_Live_Editor::form().
	 */
	public function test_form() {
		ob_start();
		$instance = $this->widget_instance();
		$this->instance->form( $instance );
		$form = ob_get_clean();

		$this->assertContains( $this->image, $form );
		$this->assertContains( $this->heading, $form );
		$this->assertContains( $this->copy, $form );

		$this->assertContains( $instance[ Widget_Live_Editor::IMAGE ], $form );
		$this->assertContains( $this->instance->get_field_name( Widget_Live_Editor::IMAGE ), $form );
		$this->assertContains( $this->instance->get_field_id( Widget_Live_Editor::IMAGE ), $form );
		$this->assertContains( 'Image', $form );

		$this->assertContains( $instance[ Widget_Live_Editor::HEADING ], $form );
		$this->assertContains( $this->instance->get_field_name( Widget_Live_Editor::HEADING ), $form );
		$this->assertContains( $this->instance->get_field_id( Widget_Live_Editor::HEADING ), $form );
		$this->assertContains( 'Heading', $form );

		$this->assertContains( $instance[ Widget_Live_Editor::COPY ], $form );
		$this->assertContains( $this->instance->get_field_name( Widget_Live_Editor::COPY ), $form );
		$this->assertContains( $this->instance->get_field_id( Widget_Live_Editor::COPY ), $form );
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
		$this->assertTrue( in_array( Widget_Live_Editor::URL, $fields, true ) );
	}

	/**
	 * Get a widget instance in order to test update() and form().
	 *
	 * @return array $widget Instance of the widget.
	 */
	public function widget_instance() {
		return array(
			Widget_Live_Editor::IMAGE   => $this->image,
			Widget_Live_Editor::HEADING => $this->heading,
			Widget_Live_Editor::COPY    => $this->copy,
			Widget_Live_Editor::URL     => $this->link,
		);
	}
}
