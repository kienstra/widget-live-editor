( function( $ ) {
	$( function() {
		var widget_regex , $save_prompt_with_buttons , showSavePromptAfterElement ,
		    scrollAccordionContainerDownBy , getNewWleWidgetAccordionSection ,
		    redirectToCustomizerWithTarget , isEntirePageDoneSaving;

		widget_regex = /(wle-[\d]{1,4})/;

		$save_prompt_with_buttons = $( '<div class="new-widget save-prompt">' +
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

		/* Begin private utility functions */
		
		scrollAccordionContainerDownBy = function( height ) {
			var current_scroll_top = $( '.accordion-container' ).scrollTop() ,n
			    new_scroll_top = current_scroll_top + height;
			$( '.accordion-container' ).animate( {
				scrollTop : new_scroll_top
				} , 500
			);
		}

		showSavePromptAfterElement = function( $element ) {
			$element.append( $save_prompt_with_buttons );
			scrollAccordionContainerDownBy( $save_prompt_with_buttons.height() );
		}

		getNewWleWidgetAccordionSection = function() {
			return $( '[id^=customize-control-widget_wle-].expanded' );
		}

		redirectToCustomizerWithTarget = function( target_id ) {
			customizer_href = document.location.href.match( /.*url=[^&]*/ );
			if ( customizer_href ) {
				var full_href = customizer_href + '&' + $.param( { wle_target : target_id } );
				document.location.href = full_href;
			}
		}

		isEntirePageDoneSaving = function() {
			return $( '#save' ).attr( 'disabled' ) === 'disabled';
		}

		/* End private utility functions */

		/* Begin DOM Event Handlers */		
		
		// When user adds new wle widget, a click on "edit content" triggers "Save and Publish" before redirecting to new href
		$( '#available-widgets [id^=widget-tpl-wle]' ).on( 'click' , function() {
			var interval;
			var id = $( this ).attr( 'id' ) ,
			    wleTarget = id.match( widget_regex )[ 1 ];

			if ( wleTarget ) {
				interval = setInterval( manage_save_prompt , 1000 );
			}

			function manage_save_prompt() {
				var $widget_accordion = getNewWleWidgetAccordionSection() ,
				    $widget_form = $widget_accordion.find( '.widget-inside .form' );
				showSavePromptAfterElement( $widget_form );
				clearInterval( interval ) ;
			}
		} );

		$( '.wle-new-save' ).live( 'click' , function( event ) {
			var interval , widget_id;
			var checkIfSaved = function() {
				if ( isEntirePageDoneSaving() ) {
					redirectToCustomizerWithTarget( widget_id );
					clearInterval( interval );
				}
			}
			event.preventDefault();
			$( this ).addClass( 'disabled' );
			$( '#save' ).click();
			widget_id = $( this ).parents( '.customize-control' ).attr( 'id' ).match( widget_regex )[ 1 ];
			interval = setInterval( checkIfSaved , 2000 );

		} );

		$( '.save-prompt .wle-new-cancel' ).live( 'click' , function() {
			$save_prompt = $( this ).parents( '.save-prompt' );
			$save_prompt.detach() ;
		} );

	 } );
} ) ( jQuery );
