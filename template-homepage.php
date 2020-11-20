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

	
	<main class="site-main container" role="main">
	<div class="hero handshake">
		
	</div>
	<section class="features">
		<div class="owl-carousel">
			<?php get_template_part('blocks/slider'); ?>
		</div>
	</section>
	<?php 
		get_template_part( 'content', 'temp' );
		do_action( 'homepage' );
	?>


	</main><!-- #main -->
<?php
get_footer();
