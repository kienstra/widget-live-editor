<?php
/**
 * Tests for class Field.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Tests for class Field.
 *
 * @package WidgetLiveEditor
 */
class Test_Field extends \WP_UnitTestCase {
	/**
	 * Instance of class.
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
		$plugin = Plugin::get_instance();
		$plugin->init();
		$this->instance = $plugin->components->field;
	}

	/**
	 * Test construct().
	 *
	 * @see Field::__construct().
	 */
	public function test_construct() {
		$widget_fields = array(
			'IMAGE'   => 'sanitize_text_field',
			'WIDTH'   => 'sanitize_text_field',
			'HEADING' => 'sanitize_text_field',
			'COPY'    => 'sanitize_text_field',
			'URL'     => 'wp_kses_post',
			'ALIGN'   => 'sanitize_text_field',
		);
		$this->assertEquals( $widget_fields, $this->instance->widget_fields );
		$this->assertEquals( __NAMESPACE__ . '\Field', get_class( $this->instance ) );
		$this->assertEquals( __NAMESPACE__ . '\Plugin', get_class( $this->instance->plugin ) );
		$this->assertEquals( Plugin::get_instance(), $this->instance->plugin );
	}

	/**
	 * Test get_fields().
	 *
	 * @see Field::__construct().
	 */
	public function test_get_fields() {
		$fields = $this->instance->get_fields();
		$this->assertEquals( 'sanitize_text_field', $fields[ Field::IMAGE ] );
		$this->assertEquals( 'sanitize_text_field', $fields[ Field::HEADING ] );
		$this->assertEquals( 'sanitize_text_field', $fields[ Field::COPY ] );
		$this->assertEquals( 'wp_kses_post', $fields[ Field::URL ] );
	}
}
