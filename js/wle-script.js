( function ($) {

	var bind_panel , image_and_slider_bind , heading_and_copy_bind , link_href_bind;

	bind_panel = function ( panel_name ) {
		image_and_slider_bind( panel_name );
		heading_and_copy_bind( panel_name );
		link_href_bind( panel_name );
	}

	image_and_slider_bind = function ( panelName ) {
		wp.customize( 'wle_options[image_slider_' + panelName + ']' , function( value ) {
			value.bind( function( to ) {
				var maxHeight = 300,
				    percentage = to,
				    imgHeight = Math.floor( maxHeight * percentage / 100 ),
				    imgHeightInPixels = String( imgHeight ) + 'px'; 

				$( '.image_' + panelName ).css( 'max-height' , imgHeightInPixels );
			} );
		} );

		wp.customize( 'wle_options[image_' + panelName + ']' , function( value ) {
			value.bind( function( to ) {
				var display = ( to ) ? 'block' : 'none';
				var $image = $( '.image_' + panelName );
				var is_svg = to.match( /.+\.svg$/ );

				$image.attr( 'src', to );
				$image.parent().css( 'display' , display );

				if ( is_svg ) {
					$image.css( 'height' , '300px' );
				}
			} );
		} );
	} /* end function image_and_slider_bind */

	heading_and_copy_bind = function( panel_name ) {
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

	link_href_bind = function( panel_name ) {
		wp.customize( 'wle_options[link_href_' + panel_name + ']' , function( value ) {
			value.bind( function( to ) {
				var display = to ? 'inline-block' : 'none';
				$( '#link_href_' + panel_name ).attr( 'href', to ).css( 'display' , display);
			} );
		} );
	}

	// Get all the Live Editor Widgets in the customizer iframe, and bind the changes in the customizer controls to them		
	$('.customized-col').map( function() {
		id = $(this).attr('id');
		bind_panel( id );
	} );
	
} )( jQuery );
