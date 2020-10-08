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
	<div class="handshake">
		<p>This is where the handshake goes</p>
		<a href="<?php echo site_url("/"); ?>books">Go to shop (this is temporary - meant as easy access)</a>
	</div>
		<?php get_template_part( 'content','temp' ); ?>
		
	</main><!-- #main -->
<?php get_footer(); ?>