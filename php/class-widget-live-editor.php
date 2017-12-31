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
	 * Instantiate the widget class.
	 */
	public function __construct() {
		parent::__construct(
			self::ID_BASE,
			__( 'Widget Live Editor', 'widget-live-editor' ),
			array(
				'description'                 => __( 'An image, text, and a link, with adjustable size and alignment.', 'widget-live-editor' ),
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
		$image_src   = isset( $instance[ Field::IMAGE ] ) ? $instance[ Field::IMAGE ] : '';
		$image_name  = $this->get_field_name( Field::IMAGE );
		$image_id    = $this->get_field_id( Field::IMAGE );
		$image_label = __( 'Image:', 'widget-live-editor' );

		$width      = isset( $instance[ Field::WIDTH ] ) ? $instance[ Field::WIDTH ] : Field::DEFAULT_WIDTH;
		$width_name = $this->get_field_name( Field::WIDTH );
		$width_id   = $this->get_field_id( Field::WIDTH );

		$heading             = isset( $instance[ Field::HEADING ] ) ? $instance[ Field::HEADING ] : '';
		$heading_name        = $this->get_field_name( Field::HEADING );
		$heading_id          = $this->get_field_id( Field::HEADING );
		$heading_placeholder = __( 'Heading', 'widget-live-editor' );

		$copy      = isset( $instance[ Field::COPY ] ) ? $instance[ Field::COPY ] : '';
		$copy_name = $this->get_field_name( Field::COPY );
		$copy_id   = $this->get_field_id( Field::COPY );

		$link      = isset( $instance[ Field::URL ] ) ? $instance[ Field::URL ] : '';
		$link_name = $this->get_field_name( Field::URL );
		$link_id   = $this->get_field_id( Field::URL );

		$align      = isset( $instance[ Field::ALIGN ] ) ? $instance[ Field::ALIGN ] : '';
		$align_name = $this->get_field_name( Field::ALIGN );
		$align_id   = $this->get_field_id( Field::ALIGN );

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
		$field_whitelist = Plugin::get_instance()->components->field->get_fields();
		foreach ( $field_whitelist as $field => $sanitization_callback ) {
			$instance[ $field ] = isset( $new_instance[ $field ] ) ? call_user_func( $sanitization_callback, $new_instance[ $field ] ) : '';
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
		$image_src = isset( $instance[ Field::IMAGE ] ) ? $instance[ Field::IMAGE ] : '';
		$width     = isset( $instance[ Field::WIDTH ] ) ? $instance[ Field::WIDTH ] : Field::DEFAULT_WIDTH;
		$heading   = isset( $instance[ Field::HEADING ] ) ? $instance[ Field::HEADING ] : '';
		$copy      = isset( $instance[ Field::COPY ] ) ? $instance[ Field::COPY ] : '';
		$link      = isset( $instance[ Field::URL ] ) ? $instance[ Field::URL ] : '';
		$align     = isset( $instance[ Field::ALIGN ] ) && ( Field::ALIGN_CENTER === $instance[ Field::ALIGN ] ) ? Field::ALIGN_CENTER : Field::ALIGN_LEFT;

		echo wp_kses_post( $args['before_widget'] );
		include 'templates/widget.php';
		echo wp_kses_post( $args['after_widget'] );
	}
}
