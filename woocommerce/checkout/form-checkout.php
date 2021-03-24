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

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}?>
<?php //YOU CAN FIND THE LOGIN IN THE FILE FORM-LOGIN ?>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <?php //.flex and col_left and right are shit I made up woocommerce-checkout-container is from woocommerce. ?>    
    <div class="grid woocommerce-checkout-container">
    
        <div class="col_left">
            <?php if ( $checkout->get_checkout_fields() ) : ?>
                <?php // .woocommerce-ap-custom .form-title Are classes I made up. You can change these titles to H3 or spans and change the classnames.?>
                <div class="woocommerce-ap-custom form-title"><?php _e('Billing Address', 'artezpress'); ?></div>
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                <?php //THIS IS FROM WOOCOMMERCE DANGER DANGER DO NOT CHANGE! ?>    
                <div class="col2-set" id="customer_details">
                    <div class="col-1">
                        <?php // you can find this snippet in checkout/form-billing ?>
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>

                    <div class="col-2">
                        <?php // you can find this snippet in checkout-shipping ?>
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>
	    </div>
        <?php // .?>
        <div class="col_right">
            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
        
            <div class="woocommerce-ap-custom form-title"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></div>
        
                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <?php //THIS IS FROM WOOCOMMERCE DANGER DANGER DO NOT CHANGE! ?>    
            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php // you can find this form in review-order ?>
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>

            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>    
    </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
