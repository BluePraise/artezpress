<?php get_header(); ?>

  <div class="flex-container">
      <div>
	      <?php include get_theme_file_path( '/inc/sidebar-filters.php' ); ?>
      </div>

    <div class="js-loading-container">
      <div>
        <input type="search" name="" id="" placeholder="Search for ebooks">
	      <?php include get_theme_file_path( '/inc/filter-tags.php' ); ?>
      </div>
      <main class="site-main products product-display flex-container js-products-container" role="main">
	      <?php woocommerce_product_loop_start(); ?>
	      <?php if (wc_get_loop_prop('total')) : ?>
		      <?php while (have_posts()) : the_post(); ?>
			      <?php do_action('woocommerce_shop_loop'); ?>
			      <?php wc_get_template_part('content', 'product'); ?>
		      <?php endwhile; ?>
	      <?php endif; ?>
	      <?php woocommerce_product_loop_end(); ?>
      </main>
    </div>
    <!-- #main -->
  </div>
<?php get_footer(); ?>