<?php
/**
 * Asset class.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Asset class
 */
class Asset {
	/**
	 * Instance of the plugin.
	 *
	 * @var object
	 */
	public $plugin;

	/**
	 * Slug of the script.
	 *
	 * @const string
	 */
	const SCRIPT = 'wle-script';

	/**
	 * Slug of the script.
	 *
	 * @const string
	 */
	const STYLE = 'wle-style';

	/**
	 * Instantiate this class.
	 *
	 * @param object $plugin Instance of the plugin.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Add the plugin actions.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_script' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'inline_script' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
	}

	/**
	 * Enqueue widget scripts that are needed only in the Customizer.
	 *
	 * @return void
	 */
	public function enqueue_script() {
		$this->register_script();
		wp_enqueue_script( self::SCRIPT );
	}

	/**
	 * Enqueue widget control script for the Customizer.
	 *
	 * @return void
	 */
	public function register_script() {
		wp_register_script( self::SCRIPT, $this->plugin->location . '/js/wle-form.js', array( 'jquery' ), Plugin::VERSION, true );
	}

	/**
	 * Enqueue widget script in the Customizer.
	 *
	 * @return void
	 */
	public function inline_script() {
		wp_add_inline_script( self::SCRIPT,
			sprintf(
				'wleWidget.init( %s );',
				wp_json_encode( array(
					'imagePreviewClass' => Field::IMAGE_PREVIEW,
					'imageInputClass'   => Field::IMAGE_INPUT,
					'noImageClass'      => Field::NO_IMAGE,
					'imageButtonClass'  => Field::IMAGE_BUTTON,
					'linkInputClass'    => Field::URL_INPUT,
					'linkButtonClass'   => Field::URL_BUTTON,
					'l10n'              => array(
						'title'       => __( 'Please select an image.', 'widget-live-editor' ),
						'changeImage' => __( 'Change Image', 'widget-live-editor' ),
						'useImage'    => __( 'Use this image', 'widget-live-editor' ),
						'addLink'     => __( 'Add Link', 'widget-live-editor' ),
						'replaceLink' => __( 'Change Link', 'widget-live-editor' ),
					),
				) )
			)
		);
	}

	/**
	 * Enqueue widget stylesheet if this widget is active, or if it's in the Customizer.
	 *
	 * It mainly sets the display for center-alignment.
	 * This is an option on the widget controls.
	 * The default is left-alignment.
	 *
	 * @return void
	 */
	public function enqueue_style() {
		$this->register_style();
		if ( is_active_widget( false, false, Widget_Live_Editor::ID_BASE ) || is_customize_preview() ) {
			wp_enqueue_style( self::STYLE );
		}
	}

	/**
	 * Enqueue widget stylesheet.
	 *
	 * @return void
	 */
	public function register_style() {
		wp_register_style( self::STYLE, $this->plugin->location . '/css/wle-style.css', array(), Plugin::VERSION );
	}
}
