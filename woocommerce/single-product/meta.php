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

if (!defined('ABSPATH')) {
	exit;
}

global $product;
?>
<div class="book-item-meta product_meta">
	<h5 class="section-title"><?php _e('Colophon and Specifications'); ?></h5>

	<?php do_action('woocommerce_product_meta_start'); ?>
	<?php
	// VALUES FOR LEFT COL
	$publishing_year = get_field('publishing_year');
	$language    	 = get_field('language');
	$authors 		 = get_field('author');
	$copublisher	 = get_field('co_publishers');
	$isbn	 		 = get_field('isbn');
	// $editions 		 = get_field('additional_editions');

	$design    		 = get_field('design');
	$nur    	 	 = get_field('nur');
	$photography     = get_field('photography');
	// VALUES FOR RIGHT COL
	$series     	 = get_field('series');
	$pages      	 = get_field('pages');
	$dimensions      = get_field('dimensions');
	$illustration    = get_field('illustrations');
	$binding    	 = get_field('binding');
	$paper_type    	 = get_field('paper_type');

	?>
	<div class="flex-container">
		<div class="col_left">

			<div class="block">
				<span class="colophon-value"><?php echo $publishing_year ?>, <?php echo $language ?></span>
				<?php if ($isbn) : ?>
					<a href="<?php echo $product->get_permalink() ?>" alt="<?php echo $product->get_name() ?>"><span class="sku_wrapper"><?php esc_html_e('ISBN', 'woocommerce'); ?></span> <span class="sku"><?php echo $isbn; ?></span></a>
					<?php elseif (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
						<a href="<?php echo $product->get_permalink() ?>" alt="<?php echo $product->get_name() ?>"><span class="sku_wrapper"><?php esc_html_e('ISBN', 'woocommerce'); ?></span> <span class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span></a>
					<?php endif; ?>
				<?php //endif; ?>

				<?php if (have_rows('additional_editions')) :

					while (have_rows('additional_editions')) : the_row();

						$type_of_edition = get_sub_field('type_of_edition');
						$related 		 = get_sub_field('related_edition');

						if ($related) :
					?>

							<span class="colophon-value">
								<span class="d-block"><?php echo $type_of_edition; _e(' Edition', 'artezpress'); ?></span>
								<?php foreach ($related as $r) :
									// get the ID of the related product
									$related_product_ID 	= $r->ID;
									$related_product 		= wc_get_product($related_product_ID);
									$related_product_sku 	= $related_product->get_sku();
									$permalink 				= get_permalink($related_product_ID);
									$related_isbn 			= get_post_meta($related_product_ID, 'isbn', true);

								?>
									<a href="<?php echo $related_product->get_permalink() ?>" alt="<?php echo $related_product->get_name() ?>">
										<span class="sku_wrapper"><?php esc_html_e('ISBN', 'woocommerce'); ?></span> 
										<span class="sku">
											<?php if ($related_isbn) : 
												echo $related_isbn; 
											else :
												echo ($sku = $related_product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce');
											endif; ?> 
										</span>
											
									</a>
								<?php
								endforeach; ?>
							</span>
				<?php endif;
					endwhile;
				endif; ?>

				<span class="colophon-value">NUR <?php echo $nur; ?></span>
			</div>

			<div class="block">
				<span class="label-header"><?php esc_html_e('Author'); ?></span>
				<span><?php echo $authors; ?></span>
			</div>


			<?php if ($design) : ?>

				<div class="block">
					<span class="label-header"><?php esc_html_e('Design'); ?></span>
					<span><?php echo $design; ?></span>
				</div>

			<?php endif; ?>

			<?php if ($photography) : ?>

				<div class="block">
					<span class="label-header"><?php esc_html_e('Photography'); ?></span>
					<span><?php echo $photography; ?></span>
				</div>

			<?php endif; ?>
			<?php if ($copublisher) : ?>

				<div class="block">
					<span class="label-header"><?php esc_html_e('Co-Publishers'); ?></span>
					<span><?php echo $copublisher; ?></span>
				</div>
			<?php endif; ?>

		</div><?php // END OF .COL_LEFT 
				?>

		<div class="col_right">
			<?php if ($series) : ?>

				<div class="block">
					<span class="label-header"><?php esc_html_e('Series'); ?></span>
					<span><?php echo $series; ?></span>
				</div>

			<?php endif; ?>

			<?php if ($pages) : ?>

				<div class="block">
					<span class="label-header"><?php esc_html_e('Pages'); ?></span>
					<span><?php echo $pages; ?> p.</span>
				</div>

			<?php endif; ?>

			<?php if ($dimensions) : ?>
				<div class="block">
					<span class="label-header"><?php esc_html_e('Dimensions'); ?></span>
					<span><?php echo $dimensions['width']; ?> × <?php echo $dimensions['length']; ?> cm</span>
				</div>
			<?php endif; ?>

			<?php
			if ($illustration['amount']) :
				$field 		= get_field('illustrations');
				$choices  	= $field['illustration_type'];
			?>
				<div class="block">

					<span class="label-header"><?php esc_html_e('Illustrations'); ?></span>
					<span>Ca. <?php echo $illustration['amount']; ?>
						<span>
							<?php
							if (count($choices) > 2) :
								foreach ($choices as $choice) :
							?>
									<span><?php echo $choice; ?></span>
								<?php endforeach;
							else : ?>
								<span><?php esc_html_e('b/w and colour'); ?> </span>
							<?php endif; ?>

							ills.</span>
				</div>

			<?php endif; ?>

			<?php if ($binding) : ?>
				<div class="block">
					<span class="label-header"><?php esc_html_e('Binding'); ?></span>
					<span><?php echo $binding; ?></span>
				</div>
			<?php endif; ?>

			<?php if (have_rows('paper_type')) : ?>
				<div class="block">
					<span class="label-header"><?php esc_html_e('Paper Stocks'); ?></span>
					<?php while (have_rows('paper_type')) : the_row(); ?>
						<?php $paper_stock = get_sub_field('paper_stock'); ?>
						<span class="colophon-value"><?php echo $paper_stock; ?></span>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>

	</div>




	<?php //echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); 
	?>

	<?php //echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); 
	?>

	<?php do_action('woocommerce_product_meta_end'); ?>

</div>