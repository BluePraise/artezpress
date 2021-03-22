<?php

/**
 * The template for displaying 404 pages (not found).
 *
 * Template Name: 404
 */

get_header(); 
// TODO: DYNAMICALLY EDIT 404???
$page_en = get_page_by_title( 'page-not-found' );
$page_nl = get_page_by_title( 'page-niet-gevonden' );

?>



<main id="main" class="site-main page" role="main">

	<div class="error-404 not-found">

		<div class="page-content content-container">
            
			<h2 class="page-title"><?php _e("Page not found.", "artezpress"); ?></h2>
			<article class="content-container">
                <p class="p1"><?php esc_html('this should be english De pagina die u zoekt, bestaat niet of is ergens anders verplaatst. U kunt opnieuw beginnen vanaf onze <a href="https://testzone.mayconnect.org/artezpress/nl/">startpagina</a> of de zoekoptie gebruiken.');?></p>
			</article>

		</div><!-- .page-content -->
	</div><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
