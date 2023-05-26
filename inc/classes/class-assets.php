<?php
/**
 * Assets for Popup Notification.
 *
 * @package wc-popup-notification
 */

namespace WC_Popup_Notification\Inc;

use WC_Popup_Notification\Inc\Traits\Singleton;

/**
 * Assets.
 */
class Assets {

	use Singleton;

	/**
	 * Class constructor.
	 */
	public function __construct() {

		/**
		 * Actions
		 */
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'wc-popup-notifications-script',
			WPN_PLUGIN_URL . '/assets/js/main.js',
			[ 'jquery' ],
			filemtime( WPN_PLUGIN_PATH . '/assets/js/main.js' ),
			true
		);
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			'wc-popup-notifications-style',
			WPN_PLUGIN_URL . '/assets/css/main.css',
			[],
			filemtime( WPN_PLUGIN_PATH . '/assets/css/main.css' ),
			'all'
		);
	}
}
