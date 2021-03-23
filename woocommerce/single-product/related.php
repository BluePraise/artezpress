<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * Colophon and Specs content. Fields: year, language, ISBN, (multiple fields for multiple editions), NUR, authors, series, design, photography, co-publishers, pages, dimensions (h×w cm), ills. (number + b/w / colour), binding, paper stocks.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( $related_products ) : ?>

	<section class="related-books">
		
			<h5 class="section-title"><?php echo _e('Related Publications', 'artezpress'); ?></h5>

		<?php
			$current_tags = get_the_terms(get_the_ID(), 'product_tag');
			$tag_array = array();
			if (!empty($current_tags) && !is_wp_error($current_tags)):
				echo '<ul class="current-tag-list">';
				foreach ($current_tags as $tag):
					$tag_title = $tag->name;
					$tag_link = get_term_link($tag); // tag archive link

				    echo '<li><span class="btn black-on-white tag-pill " href="' . $tag_link . '">' . $tag_title . '</span></li>';
				endforeach;
				echo '</ul>';
		    endif;
		    ?>
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );



					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;
wp_reset_postdata();
