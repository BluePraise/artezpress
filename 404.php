<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */

get_header(); ?>

	

		<main id="main" class="site-main" role="main">

			<div class="error-404 not-found">

				<div class="page-content content-container">

					
						<h1 class="h2 page-title"><?php esc_html_e( 'Page not found.', 'artezpress' ); ?></h1>
					

					<p><?php esc_html_e('The page you were looking for has either expired or moved somewhere else.
						We suggest you start again at our home page or use the search option.', 'artezpress' ); ?></p>


				</div><!-- .page-content -->
			</div><!-- .error-404 -->

		</main><!-- #main -->

<?php
get_footer();
