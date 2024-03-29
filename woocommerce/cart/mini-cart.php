<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */
defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>
<?php
global $woocommerce;
$count = $woocommerce->cart->cart_contents_count;

?>

<?php if (is_user_logged_in()) :

	$current_user = wp_get_current_user();
	$name = $current_user->user_firstname;
?>
<div class="login-container">
	<a class="login-link" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" alt="<?php esc_attr_e( 'Login', 'artezpress' ); ?>">
    	<?php _e( 'View Account', 'artezpress' ); ?>
	</a>
	<a class="login-link" href="<?php esc_url( wc_logout_url() ); ?>" alt="<?php esc_attr_e( 'Logout', 'artezpress' ); ?>">
    	<?php _e( 'Log Out', 'artezpress' ); ?>
	</a>
</div>
	<span class="mini-cart-greeting">Hi <?php echo $name; ?>,</span>
<?php else :  ?>
	<div class="login-container">
	<a class="login-link" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" alt="<?php esc_attr_e( 'Login', 'artezpress' ); ?>">
    	<?php _e( 'Login to your account', 'artezpress' ); ?>
	</a>
</div>
	<span class="mini-cart-greeting">Hi,</span>
<?php endif; ?>

<?php if (!WC()->cart->is_empty()) : ?>

	<div class="mini-cart-counter">You have <?php echo $count ?> items in your cart:</div>
	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
		<?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            // get current post id outside loop.
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
            $edition 	= get_field('ap_language', $product_id);
            // if current language is dutch
            // if current language is english.
            $current_lang      = pll_current_language();
            if ($edition == 'Nederlands' && $current_lang === 'en'):
                $edition = 'Dutch';
            else:
                $edition = 'Nederlandse';
            endif;
			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
		    ?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
					<?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"></a>',
							esc_url(wc_get_cart_remove_url($cart_item_key)),
							esc_attr__('Remove this item', 'woocommerce'),
							esc_attr($product_id),
							esc_attr($product_name),
							esc_attr($cart_item_key),
							esc_attr($_product->get_sku())
						),
						$cart_item_key
					);
					?>
					<?php echo wc_get_formatted_cart_item_data($cart_item, $product_price); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php  if ($cart_item['quantity'] > 1):
					    echo apply_filters('woocommerce_widget_cart_item_quantity', '<div class="quantity">' . sprintf('<span class="mc-product-name">%s (%s %s)<span class="mc-product-quantity">&times; %0s</span></span>  <span class="mc-product-total">%s</span>', $product_name, $edition, esc_attr__('edition', 'artezpress') , $cart_item['quantity'], wc_price($cart_item['line_subtotal'])) . '</div>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    else:
                        echo apply_filters('woocommerce_widget_cart_item_quantity', '<div class="quantity">' . sprintf('<span class="mc-product-name">%s (%s %s)</span> <span class="mc-product-total">%s</span>', $product_name, $edition, esc_attr__('edition', 'artezpress'), wc_price($cart_item['line_subtotal'])) . '</div>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    endif; ?>
				</li>
		<?php
			}
		}

		do_action('woocommerce_mini_cart_contents');
		?>
	</ul>
	<hr class="mini-divider" />
	<p class="woocommerce-mini-cart__total total">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action('woocommerce_widget_shopping_cart_total');
		?>
	</p>


	<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>



	<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>


<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('There are no items in the cart.', 'artezpress'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>
