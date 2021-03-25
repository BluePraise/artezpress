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
$book_item_subtitle 	= get_field('book_item_subtitle');
$description 	 		= get_field('book_item_description');
$author 	 	 		= get_field('author');
$language 	 	 		= get_field('language');
$additional_editions	= get_field('additional_editions');
$available 				= get_field('display_availability_block');

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
<a class="go-back" href="<?php if($current_lang === 'en'): echo site_url("/books"); else:?> <?php echo site_url(); ?>/nl/boeken" <?php endif; ?>" role="link">
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32">
		<defs>
			<style>
				.cls-1 {
					fill: none;
				}

				.cls-2 {
					clip-path: url(#clip-path);
				}
			</style>
			<clipPath id="clip-path">
				<rect class="cls-1" width="32" height="32" />
			</clipPath>
		</defs>

		<g class="cls-2">
			<path d="M23.45,21.88l-1.57,1.57L16,17.57l-5.88,5.88L8.55,21.88,14.43,16,8.55,10.12l1.57-1.57L16,14.43l5.88-5.88,1.57,1.57L17.57,16ZM16,0A16,16,0,1,0,32,16,16,16,0,0,0,16,0" />
		</g>
	</svg>
</a>
<main id="product-<?php the_ID(); ?>" <?php wc_product_class('book-item-page', $product); ?>>

	<?php woocommerce_show_product_images(); ?>
	<div class="book-item__single post-container container-s">
		<?php if ($available) : ?>
			<div class="book-item-available"><?php echo $available; ?></div>
		<?php endif ?>
		<h3 class="book-item-title"><?php the_title(); ?>
			<?php if ($book_item_subtitle) : ?>
				<span class="book-item-subtitle"><?php echo $book_item_subtitle; ?></span>
			<?php endif ?>
		</h3>
		<div class="summary entry-summary">
			<?php
			/**ƒ
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
			<p class="book-item-author"><?php _e('By ', 'artezpress') ?><?php echo $author ?></p>
			<div class="book-item-description">
				<?php echo $description; ?>
			</div>

			<?php woocommerce_template_single_meta(); ?>


		</div><!-- .end of summary -->
	</div><!-- .end of .post-container -->
	<?php
	/**
	 * Related News
	 */
	$related_news = get_field('related_news');
	if ($related_news) : ?>
		<section class="related-news book-item-related-news">
			<h5 class="section-title"><?php _e('Related News', 'artezpress'); ?></h5>

			<div class="news-grid">
				<?php foreach ($related_news as $post) :

					// Setup this post for WP functions (variable must be named $post).
					setup_postdata($post);
					// get the "news snippet" as amir calls it.
					get_template_part('inc/templateparts/news', 'excerpt'); ?>
				<?php endforeach; ?>
			</div>
			<?php
			// Reset the global post object so that the rest of the page works correctly.
			wp_reset_postdata(); ?>
		</section>
	<?php endif; ?>

	<?php woocommerce_output_related_products(); ?>
</main>
