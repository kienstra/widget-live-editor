<?php

// Find all the Live Editor widgets in active sidebars, and create customizer sections for them
add_action( 'customize_register' , 'wle_create_widget_customizer_section' );
function wle_create_widget_customizer_section( $wp_customize ) {
	$sidebars_mapped_to_their_widgets = get_option( 'sidebars_widgets' );

	foreach( $GLOBALS[ 'wp_registered_sidebars' ] as $active_sidebar ) {
		if ( isset( $sidebars_mapped_to_their_widgets[ $active_sidebar[ 'id' ] ] ) ) {
			wle_add_new_panel( $wp_customize );
			$widgets_of_any_kind = $sidebars_mapped_to_their_widgets[ $active_sidebar[ 'id' ] ];
			wle_register_customizer_sections( $widgets_of_any_kind , $wp_customize );
		}
	}
}

function wle_add_new_panel( $wp_customize ) {
	$wp_customize->add_panel( 'wle_panel' , array(
		'priority' => 10,
		'capability' => 'manage_options',
		'theme_supports' => '' ,
		'title'	=> __( 'Live Editor Widgets' , 'widget-live-editor' ) ,
		'description' => __( 'Edit the content' , 'widget-live-editor' ) ,
	) );
}

function wle_register_customizer_sections( $widgets_of_any_kind , $wp_customize ) {
	$customizer = new WLE_Customizer_Section(
			   __( 'Widget Live Editor' , 'widget-live-editor' ) ,
		           $wp_customize
	);
	foreach( $widgets_of_any_kind as $widget ) {
		if ( is_a_wle_widget( $widget ) ) { 
			$customizer->make_full_section_for( $widget );
		}
	}
}

function is_a_wle_widget( $widget ) {
	return ( preg_match( '/(wle-)([0-9]{1,5})/' , $widget , $matches ) );
}


// Allow svgs
add_filter( 'upload_mimes', 'wle_add_svg_support' );
function wle_add_svg_support( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
