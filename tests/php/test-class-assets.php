<?php
/**
 * Tests for class Assets.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Tests for class Assets.
 *
 * @package WidgetLiveEditor
 */
class Test_Assets extends \WP_UnitTestCase {
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
		$this->instance = $plugin->components->assets;
	}

	/**
	 * Test construct().
	 *
	 * @see Assets::__construct().
	 */
	public function test_construct() {
		$this->assertEquals( __NAMESPACE__ . '\Assets', get_class( $this->instance ) );
		$this->assertEquals( __NAMESPACE__ . '\Plugin', get_class( $this->instance->plugin ) );
		$this->assertEquals( Plugin::get_instance(), $this->instance->plugin );
	}

	/**
	 * Test init().
	 *
	 * @see Assets::init().
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_action( 'customize_controls_enqueue_scripts', array( $this->instance, 'enqueue_script' ) ) );
		$this->assertEquals( 10, has_action( 'customize_controls_enqueue_scripts', array( $this->instance, 'inline_script' ) ) );
	}

	/**
	 * Test register_script().
	 *
	 * @see Assets::register_script().
	 */
	public function test_register_script() {
		$this->instance->register_script();
		$script = wp_scripts()->registered[ Assets::SCRIPT ];
		$this->assertEquals( '_WP_Dependency', get_class( $script ) );
		$this->assertEquals( array( 'jquery' ), $script->deps );
		$this->assertEquals( Assets::SCRIPT, $script->handle );
		$this->assertEquals( $this->instance->plugin->location . '/js/wle-form.js', $script->src );
		$this->assertEquals( Plugin::VERSION, $script->ver );
	}

	/**
	 * Test enqueue_script().
	 *
	 * @see Assets::enqueue_script().
	 */
	public function test_enqueue_script() {
		$this->instance->enqueue_script();
		$this->assertTrue( in_array( Assets::SCRIPT, wp_scripts()->queue, true ) );
	}

	/**
	 * Test inline_script().
	 *
	 * @see Assets::inline_script().
	 */
	public function test_inline_script() {
		$this->instance->inline_script();
		$inline_script      = wp_scripts()->registered[ Assets::SCRIPT ]->extra['after'][1];
		$expected_in_script = array(
			'imagePreviewClass',
			Widget_Live_Editor::IMAGE_PREVIEW,
			Widget_Live_Editor::IMAGE_INPUT,
			Widget_Live_Editor::NO_IMAGE,
			Widget_Live_Editor::IMAGE_BUTTON,
			Widget_Live_Editor::URL_INPUT,
			Widget_Live_Editor::URL_BUTTON,
			'l10n',
			'title',
			'Please select an image.',
			'Change Image',
			'Use this image',
			'Add Link',
			'replaceLink',
			'Change Link',
		);

		foreach ( $expected_in_script as $expected ) {
			$this->assertContains( $expected, $inline_script );
		}
	}
}
