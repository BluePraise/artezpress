<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product;
$author 	= get_field('author');
$year 		= get_field('publishing_year');

$cats = implode(',', wc_get_product_taxonomy_class($product->get_category_ids(), 'product_cat'));
$tags = implode(',', wc_get_product_taxonomy_class($product->get_tag_ids(), 'product_tag'));
$design 	= get_field('design');
$book_lang  = get_field('ap_language');
$current_lang_full = pll_current_language('name');
$additional_editions = get_field('additional_editions');

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<div <?php wc_product_class('book-item-card', $product); ?> data-filters="<?= $cats ?> <?= $author ?> year-<?= $year ?> <?= $tags ?>" data-search="<?= get_the_title() ?> <?= $cats ?> <?= $tags ?> <?= $author ?> <?= $design && is_array($design) ? $design['designer'] : '' ?>">

		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		// do_action( 'woocommerce_before_shop_loop_item' );
		woocommerce_template_loop_product_link_open();
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		// do_action( 'woocommerce_before_shop_loop_item_title' );
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		?>

	<figure class="book-item-card__cover">
		<?php
		woocommerce_template_loop_product_thumbnail();
		?>
	</figure>

	<h4 class="book-item-card__title"><?php echo get_the_title(); ?></h4>

	<?php if (!is_front_page()) : ?>
		<p class="book-item-card__author"><?php echo wp_trim_words($author, 20, '...'); ?></p>
	<?php endif; ?>

	<?php
		woocommerce_template_loop_product_link_close();
	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>
