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

<main class="site-main homepage" role="main">

	<?php get_template_part('blocks/frontpage/handshake/index'); ?>

	<?php
	if (have_rows('feature_sliders')) : ?>
		<section class="featured-section features" id="jump-to">
			<div class="featured-section__grid grid">

			<?php
			while (have_rows('feature_sliders')) : the_row();

				get_template_part('blocks/frontpage/slider/slider', 'left');
				get_template_part('blocks/frontpage/slider/slider', 'middle');
				get_template_part('blocks/frontpage/slider/slider', 'right');

			endwhile; ?>

			</div>
		</section>
	<?php endif; ?>


	<section class="excerpt-section featured-books">
		<h2 class="featured-title"><?php _e('Books', 'artezpress'); ?></h2>
		<div class="full-width products book-grid">
			<?php

			// filter thourh repeater posts
			function my_posts_where($where) {
				$where = str_replace("meta_key = 'additional_editions_$", "meta_key LIKE 'additional_editions_%", $where);
				return $where;
			}
			add_filter('posts_where', 'my_posts_where');
			$current_lang_full = pll_current_language('name');
			$current_lang      = pll_current_language();
			$ap_language       = get_field('ap_language');
            $book_obj           = get_sub_field('add_to_new');
            if ($book_obj):
            foreach ($book_obj as $b) :
                $post_ex[] = $b;
            endforeach;
            endif;

			$args = array(
 				'orderby'         => 'date',
 				'order'           => 'DESC',
 				'posts_per_page'  => 6,  // -1 will get all the product. Specify positive integer value to get the number given number of product
 				'post_type'       => 'product',
 				'meta_query'      => array (

              		'relation'    => 'AND', array(

                		'relation' => 'OR',
							array(
								'key'    	=> 'additional_editions_0_type_of_edition',
								'compare'  	=> '!=',
								'value'    	=> $current_lang_full,
							),
							array(
								'key'     	=> 'additional_editions_0_type_of_edition',
								'compare' 	=> 'NOT EXISTS'
						)
            		),

					array(
						'key'    	=> 'add_coming_soon',
						'compare' 	=> '!=',
						'value'    	=> 1
					),
           		),

 				'tax_query'		=> array(
					 array(
                 		'taxonomy' => 'product_cat',
                 		'field'    => 'slug', // Or 'name' or 'term_id'
                 		'terms'    => array('invisible'),
                 		'operator' => 'NOT IN', // Excluded
             		)
         		)
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
		<div class="excerpt-section__expand">

			<a class="btn excerpt-section__expand-btn black-on-white" href="<?php if($current_lang === 'en'): echo site_url("/books"); else:?> <?php echo site_url(); ?>/nl/boeken" <?php endif; ?>"><?php _e('See All Books', 'artezpress'); ?></a>
		</div>

	</section><!-- #main -->

<?php
		/**
		 * ArtezPress Essays
		 * If there is a product with the category 'essays' it will be displayed here
		 * If more than one product is found, only the latest will be displayed
		 * If there are no essays this whole section won't be displayed
		 */
		$args = array(
			'orderby'         => 'date',
			'order'           => 'DESC',
			'posts_per_page'  => -1,  // -1 will get all the product. Specify positive integer value to get the number given number of product
			'post_type'       => 'product',
			'tax_query'		=> array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug', // Or 'name' or 'term_id'
					'terms'    => array('essays'),
					'operator' => 'IN', // Excluded
				)
			)
		);
		$loop = new WP_Query($args);
		if ($loop->have_posts()) {
?>
	<section class="excerpt-section essays">
		<h2 class="featured-title">ArtezPress Essay Issues</h2>
	<?php


	?>

		<div class="full-width products book-grid">
			<?php

							while ($loop->have_posts()) : $loop->the_post();
								wc_get_template_part('content', 'product');
							endwhile;
			?>
		</div><!--/.products-->
	<?php $essays = get_term_by('slug', 'essays', 'product_cat');
		  $essays_count = $essays->count;
		// if more than 5 essays are found, display a button to see all essays
		if ($essays_count > 1):?>
			<div class="excerpt-section__expand">
				<a class="btn excerpt-section__expand-btn black-on-white js-essays-filter"
				   href="<?php if($current_lang === 'en'): echo site_url("/books"); else:?> <?php echo site_url(); ?>/nl/boeken" <?php endif; ?>">
					<?php _e('See All Essays', 'artezpress'); ?>
				</a>
			</div>

		<?php endif;?>

	</section><!--/.essays-->
		<?php } wp_reset_postdata(); ?>

	<section class="excerpt-section latest-news container">

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
		<div class="excerpt-section__expand">
			<a class="btn excerpt-section__expand-btn black-on-white" href="<?php if($current_lang === 'en'): echo site_url("/news"); else:?> <?php echo site_url(); ?>/nl/nieuws" <?php endif; ?>"><?php _e('See All News', 'artezpress'); ?></a>
		</div>
	<?php } else {
				echo __('<p>Currently there is no news.</p>', 'artezpress'); ?>
		</div>
		<!--/.news-grid-->
	<?php
			}
			wp_reset_postdata();
	?>


	</section><!-- #main -->

</main><!-- #main -->
<?php get_footer(); ?>
