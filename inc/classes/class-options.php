<?php
/**
 * Popup setting page.
 *
 * @package wc-popup-notification
 */

namespace WC_Popup_Notification\Inc;

use WC_Popup_Notification\Inc\Traits\Singleton;

/**
 * Frontend.
 */
class Options {

	use Singleton;

	/**
	 * Class constructor.
	 */
	public function __construct() {

		/**
		 * Actions
		 */
		add_action( 'admin_menu', [ $this, 'wpn_admin_page_menu' ] );
		// Hook into the admin initialization to register settings
		add_action('admin_init', [ $this, 'register_setting_init' ] );
	}

	/**
	 * Create a menu item and register the admin page
	 *
	 * @return void
	 */
	public function wpn_admin_page_menu() {
		add_menu_page(
			__( 'Add to cart popup', 'wc-popup-notification' ),
			__( 'Add to cart settings', 'wc-popup-notification' ),
			'manage_options',
			'wpn_setting',
			[ $this, 'wpn_admin_page_settings' ],
			'dashicons-cart'
		);
	}

	/**
	 * Define the options page callback function
	 *
	 * @return void
	 */
	public function wpn_admin_page_settings() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Popup Cart Settings', 'wc-popup-notification' ); ?></h1>
			<form method="post" action="options.php">
				<?php
					// Display the settings fields.
					settings_fields( 'wpn_basic_options_group' );
					do_settings_sections( 'wpn_basic_options_page' );
					submit_button( __( 'Save Options', 'wc-popup-notification' ) );
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Define the settings initialization callback function.
	 *
	 * @return void
	 */
	public function register_setting_init() {
		// Register the settings section
		add_settings_section(
			'wpn_basic_options_section',
			__( 'Basic Options', 'wc-popup-notification' ),
			[ $this, 'basic_options_section_callback' ],
			'wpn_basic_options_page'
		);

		// Register the settings fields.
		add_settings_field(
			'layout_option',
			__( 'Layout Option', 'wc-popup-notification' ),
			[ $this, 'layout_option_callback' ],
			'wpn_basic_options_page',
			'wpn_basic_options_section'
		);

		add_settings_field(
			'display_position',
			__( 'Display Position', 'wc-popup-notification' ),
			[ $this, 'display_position_callback' ],
			'wpn_basic_options_page',
			'wpn_basic_options_section'
		);
		add_settings_field(
			'close_after_seconds',
			__( 'Close After Seconds', 'wc-popup-notification' ),
			[ $this, 'close_after_seconds_callback' ],
			'wpn_basic_options_page',
			'wpn_basic_options_section'
		);

		// Register the settings and callbacks.
		register_setting(
			'wpn_basic_options_group',
			'wpn_basic_options',
			[ $this, 'wpn_basic_options_validate' ]
		);
	}

	/**
	 * Settings section display callback.
	 *
	 * @param array $args Display arguments.
	 */
	public function basic_options_section_callback( $args ) {
		// echo section intro text here.
	}

	public function layout_option_callback() {
		$options = get_option( 'wpn_basic_options', [] );
		$layout  = isset( $options['layout_option'] ) ? $options['layout_option'] : 'product_with_image';

		?>
		<input type="radio" name="wpn_basic_options[layout_option]" value="product_with_image" <?php checked('product_with_image', $layout); ?>><?php esc_html_e( 'Product cart with image', 'wc-popup-notification' ); ?>
		<br>
		<input type="radio" name="wpn_basic_options[layout_option]" value="product_bg_image" <?php checked('product_bg_image', $layout); ?>><?php esc_html_e( 'Product cart with bg image', 'wc-popup-notification' ); ?>
		<?php
	}

	/**
	 * Define the display position field callback function
	 *
	 * @return void
	 */
	public function display_position_callback() {
		$options = get_option( 'wpn_basic_options', [] );
		$position = isset( $options['display_position'] ) ? $options['display_position'] : 'top';

		?>
		<select name="wpn_basic_options[display_position]">
			<option value="top" <?php selected( 'top', $position ); ?>><?php esc_html_e( 'Top', 'wc-popup-notification' ); ?></option>
			<option value="bottom" <?php selected( 'bottom', $position ); ?>><?php esc_html_e( 'Bottom', 'wc-popup-notification' ); ?></option>
		</select>
		<?php
	}

	/**
	 * Define the close after seconds field callback function
	 *
	 * @return void
	 */
	public function close_after_seconds_callback() {
		$options = get_option( 'wpn_basic_options', [] );
		$seconds = isset( $options['close_after_seconds'] ) ? $options['close_after_seconds'] : 5;
		$seconds = apply_filters( 'wpn_close_after_seconds', $seconds );
		?>

		<input type="number" name="wpn_basic_options[close_after_seconds]" value="<?php echo esc_attr( $seconds ); ?>">

		<?php
	}

	/**
	 * Define the options validation callback function
	 *
	 * @param string|int $input
	 * @return void
	 */
	public function wpn_basic_options_validate( $input ) {
		$validated_input = array();

		// Sanitize and validate the input.
		if ( ! empty( $input['layout_option'] ) ) {
			$validated_input['layout_option'] = sanitize_text_field( $input['layout_option'] );
		}

		if ( ! empty( $input['display_position'] ) ) {
			$validated_input['display_position'] = sanitize_text_field( $input['display_position'] );
		}

		if ( ! empty( $input['close_after_seconds'] ) ) {
			$validated_input['close_after_seconds'] = absint( $input['close_after_seconds'] );
		}

		return $validated_input;
	}
}
