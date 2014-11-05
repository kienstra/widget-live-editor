<?php

add_filter( 'query_vars' , 'wle_query_vars' );
function wle_query_vars( $query_vars ) {
	$query_vars[] = 'wle_target';
	return $query_vars;
}

add_action( 'customize_controls_enqueue_scripts' , 'wle_enqueue_customizer_controls' );	
function wle_enqueue_customizer_controls() {
	$url_to_customizer_of_this_page = get_url_to_customizer_of_this_page();
	wp_enqueue_script( 'wle-customizer-controls' , plugins_url( '/' . WLE_PLUGIN_SLUG . '/js/customizer-controls.js' ) , array( 'jquery' ) );
	wp_localize_script( 'wle-customizer-controls' , 'url_to_customizer' , array( 'url' => $url_to_customizer_of_this_page	) );
}

function get_url_to_customizer_of_this_page() {
	$admin_customize_url = admin_url( 'customize.php' );
	$http_host = urlencode( esc_url( $_SERVER[ 'HTTP_HOST' ] ) );
	$request_uri = urlencode( esc_url( $_SERVER[ 'REQUEST_URI' ] ) ); 
	$encoded_permalink = $http_host . $request_uri; 
	if ( $admin_customize_url ) {
		$url_to_customizer_of_this_page = $admin_customize_url . '?url=' . $encoded_permalink;
		return $url_to_customizer_of_this_page;		
	}
}