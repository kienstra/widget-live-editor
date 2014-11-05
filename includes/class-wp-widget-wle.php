<?php

// Main widget class
class WP_Widget_WLE extends WP_Widget {

	function __construct() {
		$title = 'Live Editor';
		$widget_args = array( 'classname' => 'widget_wle_text', 'description' => __( 'Live-edit a panel' , 'widget-live-editor' ) );
		parent::__construct( 'wle' , __( $title , 'widget-live-editor' ) , $widget_args );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'filter' ] = isset( $new_instance[ 'filter' ] );
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags( $instance[ 'title' ] );
		?>
			<h3>
				<?php echo $title; ?>
	 		</h3>
		<?php
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo WLE_Make_Panel::init_and_get( $args[ 'widget_id' ] );
		echo $after_widget;
	}
}