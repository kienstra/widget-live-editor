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
	 * Instantiate the widget class.
	 */
	public function __construct() {
		$options = array(
			'classname'   => 'widget-live-editor',
			'description' => __( 'Live-edit a widget.', 'widget-live-editor' ),
		);
		parent::__construct( 'widget_live_editor', __( 'Adapter Video', 'adapter-responsive-video' ), $options );
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
		$instance = $previous_instance;
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
}
