<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<div class="container-s">
	<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
		<?php do_action('woocommerce_before_cart_table'); ?>

		<ul class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">

			<?php do_action('woocommerce_before_cart_contents'); ?>

			<?php
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                $edition 	= get_field('ap_language', $product_id);
                // FIXME
                // if current language is dutch
                // if current language is english.
                if ($edition == 'Nederlands' ):
                    $edition = 'Nederlandse';
                endif;


				if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
			    ?>
					<li class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

						<div class="cart-form__table grid">

							<div class="product-thumbnail cart-form__cell cart-form__cell-thumbnail book-item">
                                <?php $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('full'), $cart_item, $cart_item_key); ?>
								<figure class="book-item-card__cover">
								    <?php echo $thumbnail; ?>
                                </figure>

							</div>

							<div class="product-name cart-form__cell cart-form__cell-name flex" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">

								<div class="item-title">
									<?php
									if (!$product_permalink) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
									} else {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
									}
									//var_dump($cart_item);
									do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

									// Meta data.
									echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

									// Backorder notification.
									if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
									}
									?>
								</div>

								<div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
									<?php
									if ($_product->is_sold_individually()) {
										$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
									?>
								</div>
							</div>

							<div class="cart-form__cell cart-form__cell-price flex-col">

								<div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
									<?php
									echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
									?>
								</div>

								<div class="product-remove">
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="label-remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
											esc_url(wc_get_cart_remove_url($cart_item_key)),
											esc_html__('Remove this item', 'woocommerce'),
											esc_attr($product_id),
											esc_attr($_product->get_sku())
										),
										$cart_item_key
									);
									?>
								</div>

							</div>

						</div>
					</li>
			<?php
				}
			}
			?>
		</ul>
		<?php do_action('woocommerce_cart_contents'); ?>


		<?php do_action('woocommerce_before_cart_collaterals'); ?>

		<?php do_action('woocommerce_before_cart_totals'); ?>
		<div class="cart-subtotal">
			<div class="subtotal-label cart-form__cell"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
	    <div class="update-cart cart-form__cell">
				<button type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e('Update amount', 'woocommerce'); ?>"><?php _e("Update Cart", "artezpress"); ?></button>
			</div>
			<div class="subtotal-value cart-form__cell" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
		</div>

		<?php if (wc_coupons_enabled()) { ?>
			<div class="coupon grid">
				<div class="coupon_code_area">
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Have a discount code?', 'woocommerce'); ?>" /> <button type="submit" class="button coupon-apply" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Enter', 'woocommerce'); ?></button>
					<?php do_action('woocommerce_cart_coupon'); ?>
				</div>
				<div class="coupon-help"><?php _e('ArtEZ students and staff are eligible for a discount.', 'artezpress'); ?></div>
			</div>
		<?php } ?>


		<?php do_action('woocommerce_cart_actions'); ?>

		<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>


		<?php do_action('woocommerce_after_cart_contents'); ?>

		<?php do_action('woocommerce_after_cart_table'); ?>
	</form>

</div>
<?php do_action('woocommerce_after_cart'); ?>
