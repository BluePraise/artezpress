<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
} ?>

<section class="review-cart-subtotal">
    
		<div class="cart-subtotal flex">
			<div class="subtotal-label"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
			<div class="subtotal-value" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
        </div>
        <?php do_action('woocommerce_review_order_after_cart_contents');  ?>
</section>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
    
	<?php if ($checkout->get_checkout_fields()) : ?>

		<div class="flex-container woocommerce-checkout-container">
            

			<div class="col_left">
				<div class="woocommerce-ap-custom form-title"><?php _e('Billing Address', 'artezpress'); ?></div>
				    <?php do_action('woocommerce_checkout_billing'); ?>
                    <?php do_action('woocommerce_checkout_after_customer_details'); ?>
			</div>

            <div class="col_right">
                <h3 class="woocommerce-ap-custom form-title"> <?php _e("Payment", "woocommerce"); ?></h3>
                        
                    <div class="shipping-checkout">
                        <?php 
                            // THIS CREATES THE SHIPPING CHOICES. THAT FORM IS BUILT UP IN CHECKOUT/FORM-SHIPPING.PHP
                            if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
                            <?php do_action('woocommerce_cart_totals_before_shipping'); ?>
                            <?php wc_cart_totals_shipping_html(); ?>
                            <?php do_action('woocommerce_cart_totals_after_shipping'); ?>               
                            <?php //do_action('woocommerce_checkout_shipping'); ?>
                        <?php endif; ?>
                    </div>

                <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
            </div>

        </div>
    <?php endif; ?>
    
</form>