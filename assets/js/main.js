( function ( $ ) {

	var timeoutId = null;

	// Open cart popup.
	function open_popup() {
		var popup = $( '.wpn-modal' );

		// Clear the timeout for this popup.
		clearTimeout( timeoutId );
		timeoutId = null;

		popup.addClass( 'wpn-modal-active' );

		// Close the popup after 5 seconds
		timeoutId = setTimeout( function() {
			popup.removeClass( 'wpn-modal-active' );
			$( '.wpn-modal__content' ).html( '' );
		}, 5000 );
	}

	// On add to cart.
	$( document.body ).on( 'added_to_cart', function() {
		open_popup();
	} );

	// Close popup.
	function close_popup( e ) {
		var popup = $( '.wpn-modal' );
		$.each( e.target.classList, function( key, value ) {
			if ( value == 'wpn-modal__close' ) {
				popup.removeClass( 'wpn-modal-active' );
				$( '.wpn-modal__content' ).html( '' );
			}
		} );

		// Clear the timeout for this popup.
		clearTimeout( timeoutId );
	}

	$( document ).on( 'click', '.wpn-modal__close', close_popup );

} )( jQuery );
