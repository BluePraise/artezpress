<?php get_header(); ?>

<main class="site-main products product-display flex-container" role="main">
    <?php woocommerce_product_loop_start(); ?>
		<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php do_action( 'woocommerce_shop_loop' );?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>

	<?php woocommerce_product_loop_end(); ?>
</main><!-- #main -->
<?php get_footer(); ?>