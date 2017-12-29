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
	 * Test image value.
	 *
	 * @var string
	 */
	public $width = '80';

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
	 * Test left alignment value.
	 *
	 * @var string
	 */
	public $align = Field::ALIGN_CENTER;

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
		$this->assertContains( $this->link, $form );

		$this->assertContains( $instance[ Field::IMAGE ], $form );
		$this->assertContains( $this->instance->get_field_name( Field::IMAGE ), $form );
		$this->assertContains( $this->instance->get_field_id( Field::IMAGE ), $form );
		$this->assertContains( 'Image', $form );

		$this->assertContains( $instance[ Field::WIDTH ], $form );
		$this->assertContains( $this->instance->get_field_name( Field::WIDTH ), $form );
		$this->assertContains( $this->instance->get_field_id( Field::WIDTH ), $form );

		$this->assertContains( $instance[ Field::HEADING ], $form );
		$this->assertContains( $this->instance->get_field_name( Field::HEADING ), $form );
		$this->assertContains( $this->instance->get_field_id( Field::HEADING ), $form );
		$this->assertContains( 'Heading', $form );

		$this->assertContains( $instance[ Field::COPY ], $form );
		$this->assertContains( $this->instance->get_field_name( Field::COPY ), $form );
		$this->assertContains( $this->instance->get_field_id( Field::COPY ), $form );

		$this->assertContains( $instance[ Field::URL ], $form );
		$this->assertContains( $this->instance->get_field_name( Field::URL ), $form );
		$this->assertContains( $this->instance->get_field_id( Field::URL ), $form );

		$this->assertContains( Field::ALIGN_LEFT, $form );
		$this->assertContains( $this->instance->get_field_name( Field::ALIGN ), $form );
		$this->assertContains( $this->instance->get_field_id( Field::ALIGN ), $form );
		$this->assertContains( 'checked', $form );
		$this->assertContains( Field::ALIGN_CENTER, $form );

		$this->assertContains( Field::IMAGE_PREVIEW, $form );
		$this->assertContains( Field::IMAGE_INPUT, $form );
		$this->assertContains( Field::IMAGE_BUTTON, $form );
		$this->assertContains( Field::URL_BUTTON, $form );
		$this->assertContains( Field::ALIGN_LEFT, $form );
		$this->assertContains( Field::ALIGN_CENTER, $form );
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
		$this->assertEquals( $this->image, $updated_instance[ Field::IMAGE ] );
		$this->assertEquals( $this->heading, $updated_instance[ Field::HEADING ] );
		$this->assertEquals( $this->copy, $updated_instance[ Field::COPY ] );
		$this->assertEquals( $this->link, $updated_instance[ Field::URL ] );
		$this->assertEquals( $this->align, $updated_instance[ Field::ALIGN ] );
		$this->assertFalse( isset( $updated_instance[ $disallowed_value ] ) );
	}

	/**
	 * Test widget().
	 *
	 * @see Widget_Live_Editor::widget().
	 */
	public function test_widget() {
		$instance = $this->widget_instance();
		$arguments = array(
			'before_widget' => '<div class="foo">',
			'after_widget'  => '<div class="bar">',
		);
		ob_start();
		$this->instance->widget( $arguments, $instance );
		$widget = ob_get_clean();

		$this->assertContains( $this->image, $widget );
		$this->assertContains( $this->width, $widget );
		$this->assertContains( $this->heading, $widget );
		$this->assertContains( $this->copy, $widget );
		$this->assertContains( $this->link, $widget );
		$this->assertContains( $this->align, $widget );
		$this->assertContains( $arguments['before_widget'], $widget );
		$this->assertContains( $arguments['after_widget'], $widget );
	}

	/**
	 * Get a widget instance in order to test update() and form().
	 *
	 * @return array $widget Instance of the widget.
	 */
	public function widget_instance() {
		return array(
			Field::IMAGE   => $this->image,
			Field::WIDTH   => $this->width,
			Field::HEADING => $this->heading,
			Field::COPY    => $this->copy,
			Field::URL     => $this->link,
			Field::ALIGN   => $this->align,
		);
	}
}
