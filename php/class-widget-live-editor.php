<?php
/**
 * Class Widget_Live_Editor
 *
 * @package AdapterResponsiveVideo
 */

namespace WidgetLiveEditor;

/**
 * Class Adapter_Responsive_Video
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
