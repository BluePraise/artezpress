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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

	<h3><?php esc_html_e( 'Billing and Shipping', 'artezpress' ); ?></h3>

<?php else : ?>

	<h3><?php esc_html_e( 'Billing and Shipping', 'artezpress' ); ?></h3>

<?php endif; 
// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
	
	<form name="checkout" method="post" class="checkout woocommerce-checkout mt-4" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="flex-container woocommerce-checkout-container" id="customer_details">
			<div class="col_left">
				<div class="woocommerce-ap-custom form-title"><?php _e('Billing Address', 'artezpress'); ?></div>
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>

		

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

	<div class="col_right">
	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
	
			<div class="shipping-checkout">
			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
		</div>
		<?php endif; ?>
	<h3 id="artez-payment"> <?php _e("Payment", "woocommerce"); ?></h3>
		<?php do_action( 'woocommerce_checkout_order_payment' ); ?>
	</div>
	</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>