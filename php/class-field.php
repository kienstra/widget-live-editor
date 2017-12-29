<?php
/**
 * Field class.
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Field class
 */
class Field {
	/**
	 * Widget image field name.
	 *
	 * @const string.
	 */
	const IMAGE = 'wle_image';

	/**
	 * Class of the widget image preview.
	 *
	 * @const string.
	 */
	const IMAGE_PREVIEW = 'wle-preview';

	/**
	 * Class of the image <input>.
	 *
	 * @const string.
	 */
	const IMAGE_INPUT = 'wle-input';

	/**
	 * Class of the backdrop that indicates there's no image.
	 *
	 * @const string.
	 */
	const NO_IMAGE = 'attachment-media-view';

	/**
	 * Class of the image <button>.
	 *
	 * @const string.
	 */
	const IMAGE_BUTTON = 'wle-select-image';

	/**
	 * Widget heading field name.
	 *
	 * @const string.
	 */
	const HEADING = 'wle_heading';

	/**
	 * Widget copy field name.
	 *
	 * @const string.
	 */
	const COPY = 'wle_copy';

	/**
	 * Widget link field name.
	 *
	 * @const string.
	 */
	const URL = 'wle_link';

	/**
	 * Class of the <input> for the link.
	 *
	 * @const string.
	 */
	const URL_INPUT = 'wle-select-link';

	/**
	 * Class of the <button> to select the link.
	 *
	 * @const string.
	 */
	const URL_BUTTON = 'wle-select-link';

	/**
	 * Widget fields.
	 *
	 * @var array.
	 */
	public $widget_fields = array(
		'IMAGE'   => 'sanitize_text_field',
		'HEADING' => 'sanitize_text_field',
		'COPY'    => 'sanitize_text_field',
		'URL'     => 'wp_kses_post',
	);

	/**
	 * Instance of the plugin.
	 *
	 * @var object
	 */
	public $plugin;

	/**
	 * Instantiate this class.
	 *
	 * @param object $plugin Instance of the plugin.
	 * @return void.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Gets a whitelist of fields, to validate user input in update().
	 *
	 * Iterates through the values in the class.
	 * And gets an array of them.
	 *
	 * @return array $whitelist An array of strings.
	 */
	public function get_fields() {
		$whitelist = array();
		$class     = get_class( $this );

		foreach ( $this->widget_fields as $field => $sanitization_callback ) {
			$whitelist[ constant( $class . '::' . $field ) ] = $sanitization_callback;
		}
		return $whitelist;
	}
}
