<?php get_header(); ?>




    
    <div class="search-bar grid">
        <?php include get_theme_file_path('/inc/sidebar-filters.php'); ?>
        <div class="js-hide-onscroll search-and-tags">
        <form class="flex-container main-search js-main-search">
        <button>
            <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
            <path d="M25 22.57l-6.11-6.11a10.43 10.43 0 10-2.43 2.43L22.57 25zM3.33 10.42a7.09 7.09 0 117.09 7.08 7.1 7.1 0 01-7.09-7.08z" />
            </svg>
        </button>
        <input type="search" class="js-main-search main-search__input" name="" id="" placeholder="">
        </form>
        <?php include get_theme_file_path('/inc/filter-tags.php'); ?>
    </div>
    </div>
  <main class="site-main book-grid flex-container js-products-container" role="main">
    
    <?php 

    // filter though repeater posts
    function my_posts_where($where)
    {
      $where = str_replace("meta_key = 'additional_editions_$", "meta_key LIKE 'additional_editions_%", $where);
      return $where;
    }
    add_filter('posts_where', 'my_posts_where');
    $current_lang_full = pll_current_language('name');
    $current_lang      = pll_current_language();
    $ap_language       = get_field('ap_language');

    $args = array(
      'orderby'         => 'date',
      'order'           => 'DESC',
      'posts_per_page'  => -1,  // -1 will get all the product. Specify positive integer value to get the number given number of product
      'post_type'       => 'product',
      'meta_query'  => array(
        'relation'    => 'OR',
        array(
          'key'    => 'additional_editions_0_type_of_edition',
          'compare'  => '!=',
          'value'    => $current_lang_full,
        ),
      array(
          'key'    => 'additional_editions_0_type_of_edition',
      'compare' => 'NOT EXISTS' 
        ),
     ),
    );  
      
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
      while ($the_query->have_posts()) : $the_query->the_post();
          wc_get_template_part('content', 'product');
      endwhile;
    endif;
    wp_reset_postdata();?>
  </main>
<!-- </div> -->
<!-- #main -->

<?php get_footer(); ?>