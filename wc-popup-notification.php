<?php
/**
 * Plugin Name:       WooCommerce Popup Notification
 * Plugin URI:        https://github.com/kishanjasani/wc-popup-notification
 * Description:       Displays add to cart notifications in a popup when a product is added to the cart.
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Version:           0.1.0
 * Author:            Kishan Jasani
 * Author URI:        https://profiles.wordpress.org/kishanjasani
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path:       /languages
 * Text Domain:       wc-popup-notification
 *
 * @package           wc-popup-notification
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WPN_PLUGIN_PATH' ) ) {
	/**
	 * Path to the plugin folder.
	 *
	 * @since 0.1.0
	 */
	define( 'WPN_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( ! defined( 'WPN_PLUGIN_URL' ) ) {
	/**
	 * URL to the plugin folder.
	 *
	 * @since 0.1.0
	 */
	define( 'WPN_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
}

// phpcs:disable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
require_once WPN_PLUGIN_PATH . '/inc/helpers/autoloader.php';
// phpcs:enable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

/**
 * To load plugin manifest class.
 *
 * @return void
 */
function wc_popup_notification_plugin_loader() {
	\WC_Popup_Notification\Inc\Plugin::get_instance();
}

wc_popup_notification_plugin_loader();
