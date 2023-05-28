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
		$popup_options    = get_option( 'wpn_basic_options', [] );
		$display_position = ! empty( $popup_options['display_position'] ) ? $popup_options['display_position'] : 'top';
		$popup_timeout    = ! empty( $popup_options['close_after_seconds'] ) ? $popup_options['close_after_seconds'] : '5';
		$popup_timeout    = apply_filters( 'wpn_close_after_seconds', $popup_timeout );
		$modal_class      = sprintf( 'wpn-modals wpn-modals--%s', $display_position );
		?>
		<div class="<?php echo esc_attr( $modal_class ); ?>" data-timeout="<?php echo esc_attr( $popup_timeout ); ?>">
			<div class="wpn-modal">
				<div class="wpn-modal__header">
					<h3><?php esc_html_e( 'Add to cart', 'wc-popup-notification' ); ?></h3>
					<span class="wpn-modal__close">&#10006;</span>
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
