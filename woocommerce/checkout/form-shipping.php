<?php

/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<?php //THIS IS FROM WOOCOMMERCE DANGER DANGER DO NOT CHANGE! ?>    
<div class="woocommerce-shipping-fields">
	<?php if (true === WC()->cart->needs_shipping_address()) : ?>
        <?php //You can change the title classes - not a problem ?>    
		<div class="woocommerce-ap-custom form-title"><?php _e("Shipping Address", "artezpress"); ?></div>
        <?php //THIS IS FROM WOOCOMMERCE DANGER DANGER DO NOT CHANGE! ?>
		<div class="radio-toggle">
			<label class="woocommerce-form__label woocommerce-form__label-for-radio radio d-block">
                <input id="ship-to-different-address-radio-no" class="woocommerce-form__input woocommerce-form__input-radio input-radio" type="radio" name="ship_to_different_address_radio_toggle" value="0" <?php checked(apply_filters('woocommerce_ship_to_different_address_checked', 'billing' === get_option('woocommerce_ship_to_destination') ? 1 : 0), 1); ?> />
                <label class="woocommerce-custom-form__label-for-radio" for="#"><?php _e('Shipping address is the same', 'artezpress'); ?></label>
			</label>
			<label class="woocommerce-form__label woocommerce-form__label-for-radio radio d-block">
                <input id="ship-to-different-address-radio-yes" selected class="woocommerce-form__input woocommerce-form__input-radio input-radio" type="radio" name="ship_to_different_address_radio_toggle" value="1" <?php checked(apply_filters('woocommerce_ship_to_different_address_checked', 'shipping' === get_option('woocommerce_ship_to_destination') ? 1 : 0), 1); ?> /> 
                <label class="woocommerce-custom-form__label-for-radio" for="#"><?php _e('Different shipping address', 'artezpress'); ?></label>
			</label>
			<span><input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked(apply_filters('woocommerce_ship_to_different_address_checked', 'shipping' === get_option('woocommerce_ship_to_destination') ? 1 : 0), 1); ?> type="checkbox" name="ship_to_different_address" value="1" style="opacity:0;" /></span>
		</div>

        <?php //THIS IS FROM WOOCOMMERCE DANGER DANGER DO NOT CHANGE! ?>
		<div class="shipping_address">
            <?php //You can change the title classes - not a problem ?>    
			<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>
            <?php //THIS IS FROM WOOCOMMERCE DANGER DANGER DO NOT CHANGE! ?>
			<div class="woocommerce-shipping-fields__field-wrapper">
				<?php
				    $fields = $checkout->get_checkout_fields('shipping');

                    foreach ($fields as $key => $field) {
                        $field["placeholder"] = $field["label"];
                        woocommerce_form_field($key, $field, $checkout->get_value($key));
                    }
				?>
			</div>

			<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

		</div>

	<?php endif; ?>
</div>