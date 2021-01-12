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
$author 	 = get_field('author');
$language 	 = get_field('language');
$description = get_field('description');


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
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/store.css">
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
			<?php //woocommerce_template_single_add_to_cart(); 
			?>
			<div class="block__price price">
				<?php
				$child = $product->get_children();
				if ($child > 1) :

					foreach ($child as $child_id) :

						$post_object    = get_post($child_id);
						$child_product  = wc_get_product($child_id);
						$child_price    = $child_product->get_price_html();
						$language 		= $child_product->get_attribute('language'); ?>

						<!-- <span class="btn white-on-black"><?php //echo $child_price 
																?></span> -->
						<button type="submit" class=" btn white-on-black single_add_to_cart_button alt"><?php echo $child_price; ?></button>
					<?php endforeach;
				else : ?>

					<span class="something btn white-on-black"><?php echo $price_html; ?></span>

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
					setup_postdata($post); ?>
					<li class="news-item">
						<p class="news-date small-text"><?php echo the_date("d F Y") ?></p>
						<a href="<?php the_permalink(); ?>">
							<?php if (has_post_thumbnail()) : ?>
								<figure class="news-thumbnail">
									<?php the_post_thumbnail(); ?>
								</figure>
							<?php endif; ?>
							<h5 class="post-title"><?php the_title(); ?></h5>
						</a>
						<p><?php the_excerpt(); ?></p>
						<a class="news-read-more" href="<?php echo the_permalink() ?>" title="<?php the_title(); ?>" role="link">Read More</a>

					</li>
				<?php endforeach; ?>
			</ul>
			<?php
			// Reset the global post object so that the rest of the page works correctly.
			wp_reset_postdata(); ?>
		<?php endif; ?>
	</section>
	<?php woocommerce_output_related_products(); ?>
</main>