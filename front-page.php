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
	</div>
		<div class="text-box">
		<div class="label-of-sample">H1</div>
			<h1>ArtEZ Press</h1>
		</div>
		<div class="text-box">
			<div class="label-of-sample">H2</div>
			<h2>About ArtEZ Press</h2>
		</div>
		<div class="text-box">
		<div class="label-of-sample">H2.highlight-item__title-author</div>
			<h2 class="highlight-item__title-author">The Desire of the Medium</h2>
		</div>
		<div class="text-box">
			<div class="label-of-sample">H3</div>
			<h3>Dissolving the Ego of Fashion</h3>
		</div>
		<div class="text-box">
			<div class="label-of-sample">H4</div>
			<h4>‘In and Out of Fashion’: The New Instalment in Our Handbooks Series</h4>
		</div>
		<div class="text-box">
			<div class="label-of-sample">H5</div>
			<h5>Colophon and Specs</h5>
		</div>
		<div class="text-box">
			<div class="label-of-sample">p.large-text</div>
			<p class="large-text">ArtEZ Press aims to stimulate research and theory development in various art education disciplines — expanding on existing knowledge in art, culture, education and fostering innovation in the field. Inherently ...</p>
		</div>

		<div class="text-box">
			<div class="label-of-sample">p.small-text</div>
			<p class="small-text">The Fashion Professorship aims to rethink the cracks in the fashion system and the role that fashion plays — and could potentially play — in relation to urgent social, cultural, environmental and political developments in contemporary society. We envision an alternative and more engaged future of fashion in which we do more ...</p>
		</div>
		<div class="text-box">
			<div class="label-of-sample">p with italic</div>
			<p class="large-text"><em>In and Out of Fashion</em> is also the first in this<em>Handbooks Series</em> to be published in an e-book edition.</p>
		</div>
		<div class="text-box">
			<div class="label-of-sample">figcaption</div>
			<figcaption>Jan-Richard Kikkert & Tycho Saariste on ‘Lautner A-Z’ at Architectura & Natura bookshop, Amsterdam</figcaption>
		</div>


	</main><!-- #main -->
<?php
get_footer();
