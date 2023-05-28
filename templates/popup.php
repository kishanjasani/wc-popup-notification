<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$cart      = WC()->cart->get_cart();
$cart_item = $cart[ $cart_item_key ];

$product_obj   = $cart_item['data'];
$thumbnail     = $product_obj->get_image();
$product_id    = $product_obj->get_image_id();
$product_name  = $product_obj->get_title();
$product_price = WC()->cart->get_product_price( $product_obj );
$popup_options = get_option( 'wpn_basic_options', [] );
$popup_layout  = ! empty( $popup_options['layout_option'] ) ? $popup_options['layout_option'] : 'product_with_image';
$prod_img_url  = 'product_bg_image' === $popup_layout ? sprintf( 'data-prod-img=%s', wp_get_attachment_url( $product_id ) ) : '';
?>

<div class="wpn-modal__content" <?php echo esc_attr( $prod_img_url ); ?>>
	<?php
	if ( 'product_with_image' === $popup_layout ) {
		?>
		<div class="wpn-product-thumbnail">
			<?php echo $thumbnail; ?>
		</div>
		<?php
	}
	?>
	<div class="wpn-product-content">
		<p><?php echo esc_html( $product_name ); ?></p>
		<?php printf( __( '<strong>Price: %s </strong>', 'wc-popup-notification' ), $product_price ); ?>
	</div>
</div>
