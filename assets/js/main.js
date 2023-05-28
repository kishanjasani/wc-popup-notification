( function ( $ ) {

	var timeoutId = null;

	// Open cart popup.
	function open_popup() {
		var popup        = $( '.wpn-modal' );
		var prod_img     = $( '.wpn-modal__content' ).data( 'prod-img' );
		var timeout_data = $( '.wpn-modals' ).data( 'timeout' );
		var timeout_val  = parseInt( timeout_data ) * 1000;

		// Clear the timeout for this popup.
		clearTimeout( timeoutId );
		timeoutId = null;

		popup.addClass( 'wpn-modal-active' );

		if ( prod_img ) {
			popup.addClass( 'wpn-modal-bgimg' );
			popup.css( 'background-image', 'url(' + prod_img + ')' )
		}

		// Close the popup after selected seconds.
		timeoutId = setTimeout( function() {
			popup.removeClass( 'wpn-modal-active' );
			$( '.wpn-modal__content' ).html( '' );
		}, timeout_val );
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
