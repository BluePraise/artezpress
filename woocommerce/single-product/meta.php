<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">
	<h5 class="section-title">Colophon and Specs</h5>


	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	<?php 
		$publishing_date = get_field('publishing_date');
		$isbn 			 = get_field('isbn');
		$authors 		 = get_field('author');
		$edition 		 = get_field('edition');
		$dimensions      = get_field('dimensions');
		$pages      		 = get_field('pages');
		$illustration    = get_field('illustrations');
		$design    		 = get_field('design');
		$language    	 = get_field('language');
	
	?>
	<div class="flex-container">
		<div class="col_left">
			<div class="block">
				<span><?php echo $publishing_date ?>, <?php echo $language ?></span>
				<span class="display-block"><?php echo $isbn ?></span>
				<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
					<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
				<?php endif; ?>
			</div>
			<div class="block">
				<span class="label-header">Author</span>
				<span><?php echo $authors; ?></span>
			</div>		
			<div class="block">
				<span class="label-header">Design</span>
				<span><?php echo $design; ?></span>
			</div>
		</div>

		<div class="col_right">
			<div class="block">
				<span class="label-header">Pages</span>
				<span><?php echo $pages; ?>p.</span>
			</div>
			<div class="block">
				<span class="label-header">Dimensions</span>
				<span><?php echo $dimensions['width']; ?>x<?php echo $dimensions['length']; ?>cm</span>
			</div>
			<div class="block">
				<span class="label-header">Illustrations</span>
				<span>ca. <?php echo $illustration['amount']; ?> <?php echo $illustration['type']; ?> ills.</span>
			</div>
			<div class="block">
				<span class="label-header">Binding</span>
				<span><?php echo $edition; ?></span>
			</div>
		</div>
	</div>

	

	
		<?php //echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

		<?php //echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
