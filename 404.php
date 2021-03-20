<?php

/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 * Template Name: 404
 */

get_header(); ?>



<main id="main" class="site-main" role="main">

	<div class="error-404 not-found">

		<div class="page-content content-container">
			<h2 class="page-title"><?php echo the_title(); ?></h2>
			<article class="content-container">
				<?php the_content(); ?>

			</article>

		</div><!-- .page-content -->
	</div><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
