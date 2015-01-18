( function ($) {

	var bindPanel , bindImageAndSlider , headingAndCopyBind , bindLinkHref;

	bindPanel = function ( panel_name ) {
		bindImageAndSlider( panel_name );
		headingAndCopyBind( panel_name );
		bindLinkHref( panel_name );
	}

	bindImageAndSlider = function ( panelName ) {
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
	} /* end function bindImageAndSlider */

	headingAndCopyBind = function( panel_name ) {
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

	bindLinkHref = function( panel_name ) {
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
		bindPanel( id );
	} );
	
} )( jQuery );
