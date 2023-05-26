<?php
/**
 * Show card popup in Frontend.
 *
 * @package wc-popup-notification
 */

namespace WC_Popup_Notification\Inc;

use WC_Popup_Notification\Inc\Traits\Singleton;

/**
 * Frontend.
 */
class Frontend {

	use Singleton;

	/**
	 * Class constructor.
	 */
	public function __construct() {

		/**
		 * Actions
		 */
		add_action( 'wp_footer', [ $this, 'cart_markup' ] );
	}

	public function cart_markup() {
		?>
		<div class="wpn-modals">
			<div class="wpn-modal">
				<div class="wpn-modal__header">
					<h3><?php esc_html_e( 'Add to cart', 'wc-popup-notification' ); ?></h3>
					<span>&#10006;</span>
				</div>
				<div class="wpn-modal__content">
				</div>
				<div class="wpn-modal__footer">
					<?php
					// Get the cart URL.
					$cart_url = wc_get_cart_url();

					// Output the cart link.
					printf( '<a href="%1$s" class="button wp-element-button add_to_cart_button">%2$s</a>', esc_url( $cart_url ), esc_html__( 'VIEW CART', 'wc-popup-notification' ) );
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
