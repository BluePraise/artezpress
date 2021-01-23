
<?php 

defined('ABSPATH') || exit;

global $product, $post;

// loop needed for header
$the_query = new WP_Query( $args );
?>
 
<div class="block__price price">
    <?php 
    // The Loop
    if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        $additional_editions	= get_field('additional_editions');
        $language	            = get_field('language');
        $type_of_edition 		= $additional_editions['type_of_edition'];
        if ( $additional_editions ): 
            $related		 = $additional_editions['related_edition'];
            if ( $related ) : ?>
                <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>		
                <?php 
                    foreach( $related as $r ):
                    // get the ID of the related product
                    $related_product_ID = $r->ID;
                    $related_product = wc_get_product( $related_product_ID );
                    $related_permalink = get_permalink($related_product_ID);
                    $related_price = wc_price($related_product->get_price());?>
                    <?php if ( $product->is_in_stock() ) : ?>
                        <button type="submit" name="add-to-cart" value="<?php echo $related_product_ID; ?>" class="btn white-on-black single_add_to_cart_button"><span class="edition-language"><?php echo $language; ?></span><?php echo $related_price; ?></button>
                    <?php else: ?>
                        <p>Out of Print</p>
                    <?php endif; ?>
                <?php endforeach; ?>
                </form>
        
                <?php endif;else: ?>
            

        <?php endif; ?>

        <?php if ( $product->is_in_stock() ) : ?>
            <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="btn white-on-black single_add_to_cart_button"><span class="edition-language"><?php echo$language; ?></span><?php woocommerce_template_single_price(); ?></button>
            </form>
        <?php else: ?>
            <p>Out of Print</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); endwhile; endif; ?>

</div>