<?php get_header(); ?>


<?php include get_theme_file_path('/inc/sidebar-filters.php'); ?>

<div class="container-books">
  <div class="js-hide-onscroll search-and-tags">
    <form class="flex-container main-search js-main-search">
      <button>
        <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
          <path d="M25 22.57l-6.11-6.11a10.43 10.43 0 10-2.43 2.43L22.57 25zM3.33 10.42a7.09 7.09 0 117.09 7.08 7.1 7.1 0 01-7.09-7.08z" />
        </svg>
      </button>
      <input type="search" class="js-main-search main-search__input" name="" id="" placeholder="">
      <div class="rotate-placeholder"></div>
    </form>
    <?php include get_theme_file_path('/inc/filter-tags.php'); ?>
  </div>

  <main class="site-main products book-grid flex-container js-products-container" role="main">
    <?php //woocommerce_product_loop_start(); ?>
    <?php
    $current_lang_full = pll_current_language('name');
    $current_lang      = pll_current_language();
    $ap_language       = get_field('ap_language');
    $args = array(
      'post_type'       => 'product',
      'orderby'         => 'date',
      'lang'            => array('en', 'nl'),
      'order'           => 'DESC',
      'posts_per_page'  => -1,  // -1 will get all the product. Specify positive integer value to get the number given number of product
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
      while ($the_query->have_posts()) : $the_query->the_post();
        // if (wc_get_loop_prop('total')) : 
        wc_get_template_part('content', 'product');
      endwhile;
    endif;
    wp_reset_postdata();
    wp_reset_query();?>
    <?php// woocommerce_product_loop_end(); ?>
  </main>
</div>
<!-- #main -->

<?php get_footer(); ?>