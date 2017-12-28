<?php
/**
 * Class Widget_Live_Editor
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/**
 * Class WidgetLiveEditor
 *
 * @package WidgetLiveEditor
 */
class Widget_Live_Editor extends \WP_Widget {
	/**
	 * Widget Live Editor ID base.
	 *
	 * @const string.
	 */
	const ID_BASE = 'widget_live_editor';

	/**
	 * Widget image field name.
	 *
	 * @const string.
	 */
	const IMAGE = 'wle_image';

	/**
	 * ID of the widget image preview.
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
	 * Widget fields.
	 *
	 * @var array.
	 */
	public $widget_fields = array(
		'IMAGE',
		'HEADING',
		'COPY',
		'URL',
	);

	/**
	 * Instantiate the widget class.
	 */
	public function __construct() {
		parent::__construct(
			self::ID_BASE,
			__( 'Widget Live Editor', 'widget-live-editor' ),
			array(
				'description'                 => __( 'Live-edit a widget.', 'widget-live-editor' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	/**
	 * Output the widget form.
	 *
	 * @param array $instance Widget data.
	 * @return void.
	 */
	public function form( $instance ) {
		$image_src   = isset( $instance[ self::IMAGE ] ) ? $instance[ self::IMAGE ] : '';
		$image_name  = $this->get_field_name( self::IMAGE );
		$image_id    = $this->get_field_id( self::IMAGE );
		$image_label = __( 'Image:', 'widget-live-editor' );

		$heading             = isset( $instance[ self::HEADING ] ) ? $instance[ self::HEADING ] : '';
		$heading_name        = $this->get_field_name( self::HEADING );
		$heading_id          = $this->get_field_id( self::HEADING );
		$heading_placeholder = __( 'Heading', 'widget-live-editor' );

		$copy      = isset( $instance[ self::COPY ] ) ? $instance[ self::COPY ] : '';
		$copy_name = $this->get_field_name( self::COPY );
		$copy_id   = $this->get_field_id( self::COPY );

		$link      = isset( $instance[ self::URL ] ) ? $instance[ self::URL ] : '';
		$link_name = $this->get_field_name( self::URL );
		$link_id   = $this->get_field_id( self::URL );

		include 'templates/form.php';
	}

	/**
	 * Update the widget instance, based on the form submission.
	 *
	 * @param array $new_instance New widget data, updated from form.
	 * @param array $previous_instance Widget data, before being updated from form.
	 * @return array $instance Widget data, updated based on form submission.
	 */
	public function update( $new_instance, $previous_instance ) {
		$instance        = array();
		$field_whitelist = $this->get_fields();
		foreach ( $field_whitelist as $field ) {
			$instance[ $field ] = isset( $new_instance[ $field ] ) ? sanitize_text_field( $new_instance[ $field ] ) : '';
		}
		return $instance;
	}

	/**
	 * Echo the markup of the widget.
	 *
	 * @param array $args Widget display data.
	 * @param array $instance Data for widget.
	 * @return void.
	 */
	public function widget( $args, $instance ) {
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

		foreach ( $this->widget_fields as $field ) {
			$whitelist[] = constant( $class . '::' . $field );
		}
		return $whitelist;
	}
}
