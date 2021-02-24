<?php

/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package artezpress
 */

get_header(); ?>

<main class="site-main test" role="main">

	<?php get_template_part('blocks/frontpage/handshake/index'); ?>

	<?php
	if (have_rows('feature_sliders')) : ?>
		<section class="features flex-container">
			<?php
			while (have_rows('feature_sliders')) : the_row();

				get_template_part('blocks/frontpage/slider/slider', 'left');
				get_template_part('blocks/frontpage/slider/slider', 'middle');
				get_template_part('blocks/frontpage/slider/slider', 'right');

			endwhile; ?>
		</section>
	<?php endif; ?>


	<section class="featured-books flex-container">
		<h2 class="featured-title"><?php _e('Books', 'artezpress'); ?></h2>
		<div class="full-width products book-grid">
			<?php
			
			    // filter thourh repeater posts
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
			      'posts_per_page'  => 6,  // -1 will get all the product. Specify positive integer value to get the number given number of product
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
       		$loop = new WP_Query($args);
			if ($loop->have_posts()) {
				while ($loop->have_posts()) : $loop->the_post();
					wc_get_template_part('content', 'product');
				endwhile;
			} else {
				echo __('No products found', 'storefront');
			}
			wp_reset_postdata();
			?>
		</div>
		<!--/.products-->
		<a class="btn btn-rectangle" href="<?php echo site_url('/books/'); ?>"><?php _e('See All Books', 'artezpress'); ?></a>

	</section><!-- #main -->

	<section class="latest-news container">

		<h2 class="featured-title"><?php _e('News', 'artezpress'); ?></h2>
		<div class="flex-container news-grid news-grid-masonry">
			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 6,
			);
			$loop = new WP_Query($args);
			if ($loop->have_posts()) {
				while ($loop->have_posts()) : $loop->the_post(); ?>
					<?php get_template_part('inc/templateparts/news', 'excerpt'); ?>

				<?php endwhile; ?>
		</div>
		<!--/.news-grid-->
		<a class="btn btn-rectangle" href="<?php echo site_url('/news'); ?>"><?php _e('See All News', 'artezpress'); ?></a>
	<?php } else {
				echo __('<p>Currently there is no news.</p>', 'artezpress'); ?>
		</div>
		<!--/.new-grid-->
	<?php
			}
			wp_reset_postdata();
	?>


	</section><!-- #main -->

</main><!-- #main -->
<?php get_footer(); ?>