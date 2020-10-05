<?php get_header(); ?>



<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/store.css">
<main class="site-main container-xl" role="main">
<?php if(is_shop()): ?>
    <?php woocommerce_product_loop_start(); ?>
		<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php woocommerce_product_loop_end(); ?>
<?php endif; ?>	

<?php if(is_product()): ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	// do_action( 'storefront_single_post_top' );

	/**
	 * Functions hooked into storefront_single_post add_action
	 *
	 * @hooked storefront_post_header          - 10
	 * @hooked storefront_post_content         - 30
	 */
	do_action( 'storefront_single_post' );
	

	/**
	 * Functions hooked in to storefront_single_post_bottom action
	 *
	 * @hooked storefront_post_nav         - 10
	 * @hooked storefront_display_comments - 20
	 */
	do_action( 'storefront_single_post_bottom' );
	?>

</article><!-- #post-## -->
<?php endif; ?>	
</main><!-- #main -->

<?php get_footer(); ?>