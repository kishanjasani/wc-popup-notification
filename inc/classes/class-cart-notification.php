<?php
/**
 * Popup notification class.
 *
 * @package wc-popup-notification
 */

namespace WC_Popup_Notification\Inc;

use \WC_Popup_Notification\Inc\Traits\Singleton;

/**
 * Class Cart_Notification
 */
class Cart_Notification {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		/**
		 * Filters.
		 */
		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'wpn_add_to_cart_notice' ] );

		/**
		 * Actions.
		 */
		add_action( 'woocommerce_add_to_cart', [ $this, 'save_last_cart_product_key' ] );
	}

	/**
	 * Display the add to cart notification popup markup.
	 *
	 * @return void
	 */
	public function wpn_add_to_cart_notice( $fragments ) {

		// Get last cart item key.
		$cart_item_key = get_option( 'wpn_last_added_cart_key' );

		if ( ! $cart_item_key ) {
			return;
		}

		// Remove last added key from the database.
		delete_option( 'wpn_last_added_cart_key' );

		$args = array(
			'cart_item_key' => $cart_item_key,
		);

		ob_start();
		wc_get_template( 'popup.php', $args, '', WPN_PLUGIN_PATH . '/templates/' );
		// include_once WPN_PLUGIN_PATH . '/templates/popup.php';

		$notice = ob_get_clean();

		$fragments['div.wpn-modal'] = $notice;

		return $fragments;
	}

	/**
	 * Save last added cart product key
	 *
	 * @param string $cart_item_key
	 *
	 * @return void
	 */
	public function save_last_cart_product_key( $cart_item_key ) {
		update_option( 'wpn_last_added_cart_key', $cart_item_key );
	}
}
