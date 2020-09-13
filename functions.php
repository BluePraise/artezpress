<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */

 if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

// add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

/*
if (!function_exists("parent_function_name")) {
    parent_function_name() {
         ...
    } 
}
*/

/* 
* Mini cart with total counter not total price
*
*/

function add_to_cart_fragment( $fragments ) {

    global $woocommerce;
    $count = $woocommerce->cart->cart_contents_count;
    
    if ($count > 0) {
        $fragments['.cart-counter'] = '<span class="cart-counter">' . $count . '</span>';
    }
    else {
        $fragments['.cart-counter'] = '<span class="cart-counter hide">' . $count . '</span>';
    }
    
    return $fragments;
    

}
