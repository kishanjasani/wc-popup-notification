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
			</div>
		</div>
		<?php
	}
}
