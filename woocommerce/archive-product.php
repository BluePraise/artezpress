<?php get_header(); ?>
    
  <main class="site-main book-grid js-products-container" role="main">
    <?php get_template_part('inc/filters'); ?>
    <div class="flex book-grid">
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
</div>
<!-- </div> -->
<!-- #main -->

<?php get_footer(); ?>