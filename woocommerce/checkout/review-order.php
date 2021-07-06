<?php

/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
global $woocommerce;
?>
<?php //.shop_table woocommerce-ap-custom-checkout-review-order-table was added by maggie ?>
<div class="shop_table woocommerce-ap-custom-checkout-review-order-table woocommerce-checkout-review-order-table">


	<?php
	do_action('woocommerce_review_order_before_cart_contents');

	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
		$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

		if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
	?>
			<div class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item review-order-row table-row', $cart_item, $cart_item_key)); ?>">
				<div class="cart-item-row woocommerce-ap-custom">
					<?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <span class="product-quantity">' . sprintf('%s <span class="ap-icon-times">✕</span> &nbsp;',  $cart_item['quantity']) . ' </span>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
					<?php echo apply_filters('woocommerce_cart_item_name', '<span class="product-name">' . $_product->get_name(), $cart_item, $cart_item_key) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
					<?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
				</div>
				<div class="product-total">
					<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
				</div>
			</div>
	<?php
		}
	}
   do_action('woocommerce_review_order_after_cart_contents'); 
	?>

	<div class="review-order">
        <?php //You can add classes. I put in review-order-row, so you can reuse it or change it. The rest is from wooc0mmerce ?>
		<div class="cart-subtotal review-order-row">
			<span><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
			<span><?php wc_cart_totals_subtotal_html(); ?></span>

		</div>

		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> review-order-row">
				<th><?php wc_cart_totals_coupon_label($coupon); ?></th>
				<td><?php wc_cart_totals_coupon_html($coupon); ?></td>
			</div>
		<?php endforeach; ?>


		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<div class="fee">
				<th><?php echo esc_html($fee->name); ?></th>
				<td><?php wc_cart_totals_fee_html($fee); ?></td>
			</div>
		<?php endforeach; ?>
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <div class="shipping-total review-order-row">

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

            </div>
		<?php endif; ?>
        
		<?php do_action('woocommerce_review_order_before_order_total'); ?>
        
		<div class="order-total review-order-row">
			<div><?php esc_html_e('Total', 'woocommerce'); ?></div>
			<?php wc_cart_totals_order_total_html(); ?>
		</div>
       
		
		<?php do_action('woocommerce_review_order_after_order_total'); ?>

	</div>
</div>