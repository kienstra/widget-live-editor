( function ($) {

	// Get all the Live Editor Widgets in the customizer iframe, and bind the changes in the customizer controls to them
	$('.customized-col').map( function() {
		id = $(this).attr('id');
		bind_panel( id );
	} );

	function bind_panel( panel_name ) {
		image_and_slider_bind( panel_name );
		heading_and_copy_bind( panel_name );
		link_href_bind( panel_name );
	}

	function image_and_slider_bind( panel_name ) {

		wp.customize( 'wle_options[image_slider_' + panel_name + ']' , function( value ) {
			value.bind( function( to ) {
				var max_height = 300; //should use wp_localize_script for this 
				var percentage = to;
				var img_height = Math.floor( max_height * percentage / 100 );
				var img_height_in_pixels = String( img_height ) + 'px'; 
				$( '.image_' + panel_name ).css( 'max-height' , img_height_in_pixels );
			} );
		} );

		wp.customize( 'wle_options[image_' + panel_name + ']' , function( value ) {
			value.bind( function( to ) {
				$image = $( '.image_' + panel_name );
				$image.attr( 'src', to );
				var display = ( to ) ? 'block' : 'none';
				$image.parent().css( 'display' , display );

				is_svg = to.match( /.+\.svg$/ );
				if ( is_svg ) {
					$image.css( 'height' , '300px' );
				}
			} );
		} );
	}

	function heading_and_copy_bind( panel_name ) {
		wp.customize( 'wle_options[heading_' + panel_name + ']' , function( value ) {
			value.bind( function( to ) {
				$( '.heading_' + panel_name ).html( to );
			} );
		} );

		wp.customize( 'wle_options[copy_' + panel_name + ']' , function( value ) {
			value.bind( function( to ) {
				to = to.replace( /\n/g , '</br>' );
				$( '.copy_' + panel_name ).html( to );
			} );
		} );
	}

	function link_href_bind( panel_name ) {
		wp.customize( 'wle_options[link_href_' + panel_name + ']' , function( value ) {
			value.bind( function( to ) {
				var display = to ? 'inline-block' : 'none';
				$( '#link_href_' + panel_name ).attr( 'href', to ).css( 'display' , display);
			} );
		} );
	}
} )( jQuery );
