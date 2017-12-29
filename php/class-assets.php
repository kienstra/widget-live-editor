<?php
/**
 * Assets class.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Assets class
 */
class Assets {
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
	 * Instantiate this class.
	 *
	 * @param object $plugin Instance of the plugin.
	 * @return void
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
}
