<?php get_header(); ?>


<?php include get_theme_file_path('/inc/sidebar-filters.php'); ?>
<div class="flex-container">
  <div class="products-container">
    <div class="js-hide-onscroll search-and-tags">
      <form class="flex-container main-search js-main-search">
        <button>
          <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
            <path d="M25 22.57l-6.11-6.11a10.43 10.43 0 10-2.43 2.43L22.57 25zM3.33 10.42a7.09 7.09 0 117.09 7.08 7.1 7.1 0 01-7.09-7.08z" />
          </svg>
        </button>
        <input type="search" class="js-main-search main-search__input" name="" id="" placeholder="Search for ebooks">
      </form>
      <?php include get_theme_file_path('/inc/filter-tags.php'); ?>
    </div>
    <main class="site-main products product-display flex-container js-products-container" role="main">
      <h2 class="products__not-found" style="display: none">Not found</h2>
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