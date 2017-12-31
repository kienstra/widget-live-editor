/* global wpLink */

/**
 * In the widget form, enable the Media Library and link modals.
 *
 * On clicking a <button>, open the Media Library to select an image.
 * And on clicking the link <button>, open the 'Insert/edit link' modal.
 */
/* eslint-disable no-alert, no-unused-vars */
var wleWidget = ( function( $ ) { // jshint ignore:line
	'use strict';

	var module = {
		/**
		 * Localized data.
		 *
		 * @type {object}
		 */
		data: {},

		/**
		 * Media library frame.
		 *
		 * @type {object}
		 */
		frame: {},

		/**
		 * A jQuery-wrapped widget element.
		 *
		 * Markup for the Widget Live Editor widget controls.
		 * Ensures that the handlers apply to the right widget.
		 *
		 * @type {object}
		 */
		$widget: {},

		/**
		 * Initialize the module.
		 *
		 * @param {object} data The localized module data.
		 * @returns {void}
		 */
		init: function( data ) {
			module.data = data;

			$( function() {
				module.addImageHandler();
				module.addLinkHandler();
			} );
		},

		/**
		 * Add the handler for clicking on the image button.
		 *
		 * @returns {void}
		 */
		addImageHandler: function() {
			$( document ).on( 'click', '.' + module.data.imageButtonClass, function( event ) {
				module.setWidget( event.target );
				module.initFrame();
			} );
		},

		/**
		 * Set the widget that was clicked.
		 *
		 * @param {object} target The element inside the widget that was clicked.
		 * @returns {void}
		 */
		setWidget: function( target ) {
			module.$widget = $( target ).parents( '.widget-content' );
		},

		/**
		 * Initialize the media frame.
		 *
		 * @returns {void}
		 */
		initFrame: function() {
			module.frame = wp.media( {
				title: module.data.l10n.title,
				button: {
					text: module.data.l10n.useImage
				},
				multiple: false
			} ).open();
			module.addSelectHandler();
		},

		/**
		 * Add the handler for selecting an image.
		 *
		 * @returns {void}
		 */
		addSelectHandler: function() {
			module.frame.on( 'select', function() {
				var attachment = module.frame.state().get( 'selection' ).first().toJSON();

				module.updateImageText();
				if ( 'undefined' !== typeof attachment.url ) {
					module.$widget.find( '.' + module.data.imagePreviewClass ).attr( 'src', attachment.url ).removeClass( 'hidden' );
					module.$widget.find( '.' + module.data.noImageClass ).addClass( 'hidden' );
					module.$widget.find( '.' + module.data.imageInputClass ).val( attachment.url ).trigger( 'change' );
				}
			} );
		},

		/**
		 * Add the handler for selecting a link.
		 *
		 * @returns {void}
		 */
		addLinkHandler: function() {
			$( document ).on( 'click', '.' + module.data.linkButtonClass, function( event ) {
				var input;

				module.setWidget( event.target );
				input = module.$widget.find( '.' + module.data.linkInputClass );
				input.removeAttr( 'value' );
				wpLink.open( input.attr( 'id' ) );
				$( event.target ).text( module.data.l10n.replaceLink );
			} );
		},

		/**
		 * Change the image <button> text to 'Replace Image.'
		 *
		 * When one selects an image, there will be an image visible.
		 * Then, the text 'Replace Image' will be more appropriate than 'Replace Image.'
		 *
		 * @returns {void}
		 */
		updateImageText: function() {
			$( '.' + module.data.imageButtonClass ).text( module.data.l10n.changeImage );
		}

	};

	return module;
} )( jQuery );
