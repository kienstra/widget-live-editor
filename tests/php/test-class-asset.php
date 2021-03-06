<?php
/**
 * Tests for class Asset.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Tests for class Asset.
 *
 * @package WidgetLiveEditor
 */
class Test_Asset extends \WP_UnitTestCase {
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
		$this->instance = $plugin->components->asset;
	}

	/**
	 * Test construct().
	 *
	 * @see Asset::__construct().
	 */
	public function test_construct() {
		$this->assertEquals( __NAMESPACE__ . '\Asset', get_class( $this->instance ) );
		$this->assertEquals( __NAMESPACE__ . '\Plugin', get_class( $this->instance->plugin ) );
		$this->assertEquals( Plugin::get_instance(), $this->instance->plugin );
	}

	/**
	 * Test init().
	 *
	 * @see Asset::init().
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_action( 'customize_controls_enqueue_scripts', array( $this->instance, 'enqueue_script' ) ) );
		$this->assertEquals( 10, has_action( 'customize_controls_enqueue_scripts', array( $this->instance, 'inline_script' ) ) );
		$this->assertEquals( 10, has_action( 'wp_enqueue_scripts', array( $this->instance, 'enqueue_style' ) ) );
	}

	/**
	 * Test register_script().
	 *
	 * @see Asset::register_script().
	 */
	public function test_register_script() {
		$this->instance->register_script();
		$script = wp_scripts()->registered[ Asset::SCRIPT ];
		$this->assertEquals( '_WP_Dependency', get_class( $script ) );
		$this->assertEquals( array( 'jquery' ), $script->deps );
		$this->assertEquals( Asset::SCRIPT, $script->handle );
		$this->assertEquals( $this->instance->plugin->location . '/js/wle-form.js', $script->src );
		$this->assertEquals( Plugin::VERSION, $script->ver );
	}

	/**
	 * Test enqueue_script().
	 *
	 * @see Asset::enqueue_script().
	 */
	public function test_enqueue_script() {
		$this->instance->enqueue_script();
		$this->assertTrue( in_array( Asset::SCRIPT, wp_scripts()->queue, true ) );
	}

	/**
	 * Test inline_script().
	 *
	 * @see Asset::inline_script().
	 */
	public function test_inline_script() {
		$this->instance->inline_script();
		$inline_script      = wp_scripts()->registered[ Asset::SCRIPT ]->extra['after'][1];
		$expected_in_script = array(
			'imagePreviewClass',
			Field::IMAGE_PREVIEW,
			Field::IMAGE_INPUT,
			Field::NO_IMAGE,
			Field::IMAGE_BUTTON,
			Field::URL_INPUT,
			Field::URL_BUTTON,
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

	/**
	 * Test enqueue_style().
	 *
	 * @see Asset::enqueue_style().
	 */
	public function test_enqueue_style() {
		global $wp_customize;
		require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
		$wp_customize = new \WP_Customize_Manager(); // WPCS: global override OK.
		$this->instance->enqueue_style();

		// The style should not be enqueued, because the widget isn't active, and is_customize_preview() is false.
		$this->assertFalse( in_array( Asset::STYLE, wp_styles()->queue, true ) );

		// Ensure that is_customize_preview() is true, so this enqueues the stylesheet.
		$wp_customize->start_previewing_theme();
		$this->instance->enqueue_style();
		$this->assertTrue( in_array( Asset::STYLE, wp_styles()->queue, true ) );
	}

	/**
	 * Test register_style().
	 *
	 * @see Asset::enqueue_style().
	 */
	public function test_register_style() {
		$this->instance->register_style();
		$style = wp_styles()->registered[ Asset::STYLE ];
		$this->assertEquals( '_WP_Dependency', get_class( $style ) );
		$this->assertEquals( array(), $style->deps );
		$this->assertEquals( Asset::STYLE, $style->handle );
		$this->assertEquals( $this->instance->plugin->location . '/css/wle-style.css', $style->src );
		$this->assertEquals( Plugin::VERSION, $style->ver );
	}
}
