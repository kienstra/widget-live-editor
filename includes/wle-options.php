<?php

add_action( 'admin_menu' , 'wle_plugin_page' );
function wle_plugin_page() {
	add_options_page(
		__( 'Widget Live Editor Settings' , 'widget-live-editor' ) ,
		__( 'Widget Live Editor' , 'widget-live-editor' ) ,
		'manage_options' ,
		'wle_options_page' ,
		'wle_plugin_options_page'
	);
}

function wle_plugin_options_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'Widget Live Editor' , 'widget-live-editor' ); ?></h2>
		<form action="options.php" method="post">
			<?php settings_fields( 'wle_plugin_options' ); ?>
			<?php do_settings_sections( 'wle_options_page' ); ?>
			<input name="Submit" class="button-primary" type="submit" value="<?php _e( 'Save Changes' , 'widget-live-editor' ); ?>" />
		</form>
	</div>
	<?php
}

add_action( 'admin_init' , 'wle_settings_setup' );
function wle_settings_setup() {
	register_setting( 'wle_plugin_options' , 'wle_plugin_options' , 'wle_plugin_validate_options' );
	add_settings_section( 'wle_plugin_primary' , __( 'Settings' , 'widget-live-editor' ) ,
		 'wle_plugin_section_text', 'wle_options_page' );
	add_settings_field( 'wle_plugin_anchor_text' , __( 'Link text' , 'widget-live-editor' ) , 'wle_plugin_setting_anchor_text_output' ,
				'wle_options_page' , 'wle_plugin_primary' );
	add_settings_field( 'wle_plugin_anchor_class' , __( '(optional) Link class(es):' , 'widget-live-editor' ) , 'wle_plugin_setting_anchor_class_output' , 'wle_options_page' , 'wle_plugin_primary' );
}

function wle_plugin_validate_options( $input ) {
	$anchor_class_without_tags = strip_tags( $input[ 'anchor_class' ] );
	$result[ 'anchor_class' ] = str_replace( ',' , ' ' , $anchor_class_without_tags );
	$result[ 'anchor_text' ] = strip_tags( $input[ 'anchor_text' ] );
	return $result;
}

function wle_plugin_section_text() {
	return "";
}

function wle_plugin_setting_anchor_text_output() {
	$options = get_option( 'wle_plugin_options' );
	$anchor_text = isset( $options[ 'anchor_text' ] ) ? $options[ 'anchor_text' ] : "";
	?>
		<input type="text" id="anchor_text" value="<?php echo esc_attr( $anchor_text ); ?>" name="wle_plugin_options[anchor_text]" placeholder="<?php _e( 'Read more' , 'widget-live-editor' ); ?>"/>
	<?php
}

function wle_plugin_setting_anchor_class_output() {
	$options = get_option( 'wle_plugin_options' );
	$anchor_class = isset( $options[ 'anchor_class' ] ) ? $options[ 'anchor_class' ] : "";
	?>
		<input type="text" name="wle_plugin_options[anchor_class]" value="<?php echo esc_attr( $anchor_class ); ?>" placeholder="btn btn-primary btn-med" />
		<p><?php _e( 'If more than one, separate with space or commas' , 'widget-live-editor' ); ?></p>
	<?php
}

// Add settings link on the main plugin page
add_filter( 'plugin_action_links' , 'wle_add_settings_link' , 2 , 2 );
function wle_add_settings_link( $actions, $file ) {
	 if ( false !== strpos( $file, WLE_PLUGIN_SLUG ) ) {
		$options_url = admin_url( 'options-general.php?page=wle_options_page' );
		$customizer_url = admin_url( 'customize.php?wle_first_sidebar=true' );
		$actions[ 'settings' ] = "<a href='{$options_url}'>" . __( 'Settings' , 'widget-live-editor' ) . "</a>";
	}
	return $actions;
}