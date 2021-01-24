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
 * @package storefront
 */

get_header(); ?>
	
	<main class="site-main" role="main">

		<?php get_template_part('blocks/frontpage/handshake/index'); ?>
		<section class="features flex-container">
		
		<?php 
			if (have_rows('feature_sliders')) :
				while (have_rows('feature_sliders')) : the_row(); 
				
				get_template_part('blocks/frontpage/slider/slider','left');
				get_template_part('blocks/frontpage/slider/slider','middle');
				get_template_part('blocks/frontpage/slider/slider','right');
				
			endwhile;
		endif;    
		?>
		
		</section>
	
		<section class="featured-books flex-container ">
			<h2 class="featured-title">Books</h2>
			<div class="full-width products">
    			<?php
        		$args = array(
						'post_type' => 'product',
						'posts_per_page' => 6,
						);
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post();
							wc_get_template_part( 'content', 'product' );
						endwhile;
					} else {
						echo __( 'No products found' );
					}
					wp_reset_postdata();
				?>
			</div><!--/.products-->
			<a class="btn btn-reg" href="<?php echo site_url( '/books/'); ?>">See All Books</a>
			
		</section><!-- #main -->
	
		<section class="latest-news container">
			<h2 class="featured-title"><?php _e('News')?></h2>
			<div class="grid">
    			<?php
        		$args = array(
						'post_type' => 'post',
						'posts_per_page' => 6,
						);
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php get_template_part('inc/templateparts/news', 'excerpt'); ?>	
					<?php 
							endwhile;
					} else {
						echo __( 'No products found' );
					}
					wp_reset_postdata();
				?>
			</div><!--/.grid-->
			<a class="btn black-on-white" href="<?php echo esc_url( '/news' ); ?>"><?php _e('See All News'); ?></a>
			
		</section><!-- #main -->

	</main><!-- #main -->
<?php get_footer(); ?>