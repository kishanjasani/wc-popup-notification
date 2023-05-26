<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$cart      = WC()->cart->get_cart();
$cart_item = $cart[ $cart_item_key ];

$product_obj       = $cart_item['data'];
$thumbnail         = $product_obj->get_image();
$product_name      = $product_obj->get_title();
$product_price     = WC()->cart->get_product_price( $product_obj );
?>

<div class="wpn-modal__content">
	<div class="wpn-product-thumbnail">
		<?php echo $thumbnail; ?>
	</div>
	<div class="wpn-product-content">
		<p><?php echo esc_html( $product_name ); ?></p>
		<?php printf( __( '<strong>Price: %s </strong>', 'wc-popup-notification' ), $product_price ); ?>
	</div>
</div>
