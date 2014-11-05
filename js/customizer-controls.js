( function( $ ) {
	$( function() {
		var widget_regex = /(wle-[\d]{1,4})/;
		var href = document.location.href;
		var customizer_url = url_to_customizer.url; // passed with wp_localize_script
		var $save_prompt_with_buttons = $( '<div class="new-widget save-prompt">' +
							'<div id="message" class="error">' +
								'Page must reload to create widget.' +
							'</div>' +
							'<p>' +
								'<a class="wle-new-save button-primary" href="#">Save changes & reload</a>' +
							'</p>' +
							'<p>' +
								'<a class="wle-new-cancel button-secondary" href="#">Cancel</a>' +
							'</p>' +
						   '</div> <!-- .new-widget.save-prompt -->'
		);

		function show_save_prompt_after_element( $element ) {
			$element.append( $save_prompt_with_buttons );
			scroll_accordion_container_down_by( $save_prompt_with_buttons.height() );
		}

		function scroll_accordion_container_down_by( height ) {
			var current_scroll_top = $( '.accordion-container' ).scrollTop();
			var new_scroll_top	= current_scroll_top + height;
			$( '.accordion-container' ).animate( {
				scrollTop : new_scroll_top
				} , 500
			);
		}

		// When user adds new wle widget, a click on "edit content" triggers "Save and Publish" before redirecting to new href
		$( '#available-widgets [id^=widget-tpl-wle]' ).on( 'click' , function() {
			var id = $( this ).attr( 'id' );
			var wle_target = id.match( widget_regex )[ 1 ];
			var interval;
			if ( wle_target ) {
				interval = setInterval( manage_save_prompt , 1000 );
			}

			function manage_save_prompt() {
				$widget_accordion = get_new_wle_widget_accordion_section();
				$widget_form = $widget_accordion.find( '.widget-inside .form' );
				show_save_prompt_after_element( $widget_form );
				clearInterval( interval ) ;
			}
		} );

		function get_new_wle_widget_accordion_section() {
			return $( '[id^=customize-control-widget_wle-].expanded' );
		}


		$( '.wle-new-save' ).live( 'click' , function( event ) {
			event.preventDefault();
			$( this ).addClass( 'disabled' );
			$( '#save' ).click();
			var widget_id = $( this ).parents( '.customize-control' ).attr( 'id' ).match( widget_regex )[ 1 ];
			interval = setInterval( wle_check_if_saved , 2000 );
			function wle_check_if_saved() {
				if ( is_entire_page_done_saving() ) {
					redirect_to_customizer_with_target( widget_id );
					clearInterval( interval );
				}
			}
		} );

		function redirect_to_customizer_with_target( target_id ) {
			customizer_href = document.location.href.match( /.*url=[^&]*/ );
			if ( customizer_href ) {
				var full_href = customizer_href + '&' + $.param( { wle_target : target_id } );
				document.location.href = full_href;
			}
		}

		function is_entire_page_done_saving() {
			return $( '#save' ).attr( 'disabled' ) === 'disabled';
		}

		$( '.save-prompt .wle-new-cancel' ).live( 'click' , function() {
			$save_prompt = $( this ).parents( '.save-prompt' );
			$save_prompt.detach() ;
		} );

	 } );
} ) ( jQuery );
