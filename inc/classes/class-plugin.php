<?php
/**
 * Plugin manifest class.
 *
 * @package wc-popup-notification
 */

namespace WC_Popup_Notification\Inc;

use \WC_Popup_Notification\Inc\Traits\Singleton;

/**
 * Class Plugin
 */
class Plugin {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		// Load plugin classes.
		Assets::get_instance();
	}

}
