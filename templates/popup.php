<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$cart      = WC()->cart->get_cart();
$cart_item = $cart[ $cart_item_key ];

$product_obj       = $cart_item['data'];
$product_id        = $cart_item['product_id'];
$product_permalink = $product_obj->is_visible() ? $product_obj->get_permalink( $cart_item ) : '';
$thumbnail         = $product_obj->get_image();
$product_name      = $product_obj->get_title();
$product_price     = WC()->cart->get_product_price( $product_obj );
?>

<div class="wpn-modal" data-wpn_cart_key="<?php echo esc_attr( $cart_item_key ); ?>">
	<div class="wpn-modal__header">
		<h3><?php esc_html_e( 'Add to cart', 'wc-popup-notification' ); ?></h3>
		<span>&#10006;</span>
	</div>
	<div class="wpn-modal__content">
		<div class="wpn-product-thumbnail">
			<?php echo $thumbnail; ?>
		</div>
		<div class="wpn-product-content">
			<p><?php echo esc_html( $product_name ); ?></p>
			<?php printf( __( '<strong>Price: %s </strong>', 'wc-popup-notification' ), $product_price ); ?>
		</div>
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
