<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 */

defined('ABSPATH') || exit;

global $product, $post;
$author 	 	 		= get_field('author');
$language 	 	 		= get_field('language');
$description 	 		= get_field('description');
$additional_editions	= get_field('additional_editions');
$type_of_edition 		= $additional_editions['type_of_edition'];

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<main id="product-<?php the_ID(); ?>" <?php wc_product_class('container', $product); ?>>

	<?php woocommerce_show_product_images(); ?>
	<div class="post-container">
		<h3 class="single-product-title"><?php the_title(); ?></h3>
		<div class="summary entry-summary">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */

			?>
			<p class="single-product-author">By <?php echo $author ?></p>
			<div class="single-product-description">
				<?php echo $description; ?>
			</div>
			<div class="block__price price">
				<?php 
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
									<p>Related Product</p>
									<button type="submit" name="add-to-cart" value="<?php echo $related_product_ID; ?>" class="btn white-on-black single_add_to_cart_button"><span class="edition-language"><?php echo $type_of_edition; ?></span><?php echo $related_price; ?></button>
								<?php else: ?>
									<p>Out of Print</p>
								<?php endif; ?>
							<?php endforeach; ?>
							</form>
					<?php 		
						endif;
					else: ?>
						

					<?php endif; ?>

					<?php if ( $product->is_in_stock() ) : ?>
						<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
							<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="btn white-on-black single_add_to_cart_button"><span class="edition-language"><?php echo$language; ?></span><?php woocommerce_template_single_price(); ?></button>
						</form>
					<?php else: ?>
						<p>Out of Print</p>
					<?php endif; ?>


			</div>
			<?php woocommerce_template_single_meta(); ?>
		</div>
	</div>
	<section class="related-news">
		<h5 class="section-title">Related News</h5>
		<?php
		/**
		 * Related News
		 */
		$related_news = get_field('related_news');
		if ($related_news) : ?>
			<ul class="d-h flex-container">
				<?php foreach ($related_news as $post) :

					// Setup this post for WP functions (variable must be named $post).
					setup_postdata($post);
					get_template_part('inc/templateparts/news', 'excerpt'); 
				
				endforeach; ?>
			</ul>
			<?php
			// Reset the global post object so that the rest of the page works correctly.
			wp_reset_postdata(); ?>
		<?php endif; ?>
	</section>
	<?php woocommerce_output_related_products(); ?>
</main>