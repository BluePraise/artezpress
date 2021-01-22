<?php 
	get_template_part( 'head' );
	$rows = get_field('hero_imgs', 'option'); // get all the rows 
	$rand_row = $rows[ array_rand( $rows ) ];
	$rand_row_image = $rand_row['bg_images_uploaded']; // get the sub field value
	if(is_product()) {
		global $post;
		$id = $post->ID;
		 $single_product_bg = get_field('custom_color', $id);
		 $single_product_text_color = get_field('text_color', $id);
		?>
		<style>
			
			body.single-product {background-color: <?php echo $single_product_bg; ?>;}
			body.single-product .entry-summary {color: <?php echo $single_product_text_color; ?>;}
		</style>
		
		<?php
		
	}
?>
<div class="main-menu-container fixed-bottom">
		<div class="bg-overlay" style="background-image: url(<?php echo $rand_row_image; ?>);"></div>
	<nav class="main-menu-bar">
		
		<div class="flex-container">
			<div class="logo js-toggle-menu">
				<a href="#" title="Menu Toggle" role="link" tabindex="0"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/logo.svg" alt="logo Artez Press"></a>
			</div>
			
			
			<div class="menu-misc">
				<a class="language-toggle" href="#" role="link">English</a>
				<a class="btn white-on-black" href="<?php echo wc_get_cart_url(); ?>">
					<span class="cart-label">Cart</span>
					<span class="cart-counter"></span>
				</a>
			</div>
		</div>
	</nav>
	<div class="main-menu-surface">
		<div class="flex-container">
			<div class="nav-column">
				<div class="search">Search</div>
				<ul class="page-list">
					<li><a href="<?php echo site_url("/"); ?>">Home</a></li>
					<li><a href="<?php echo site_url("/books"); ?>">Books</a></li>
					<li><a href="<?php echo site_url("/news"); ?>">News</a></li>
					<li><a href="<?php echo site_url("/news"); ?>">About ArtEZ Press</a></li>
				</ul>
				<div class="newsletter">
					<span>Subscribe to our newsletter</span>
					<input type="text" />
					<button type="submit" class="btn btn-reg">OK</button>

				</div>
			</div>
			<div class="nav-column">
				<div class="social-menu">
					<ul class="horizontal-list">
						<li>
						<a href="#" alt="link to facebook"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_fb.svg" alt="Facebook Icon"></a>
						<a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_ig.svg" alt="Instagram Icon"></a>
						<a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_tw.svg" alt="Twitter Icon"></a>
					</li></ul>
				</div>
				<ul class="page-list">
					<li><a href="<?php echo site_url("/contact"); ?>">Contact</a></li>
					<li><a href="<?php echo site_url("/frequently-asked-questions"); ?>"></a></li>
					<li><a href="<?php echo site_url("/privacy-policy"); ?>">Data Protection</a></li>
					<li><a href="<?php echo site_url("/news"); ?>">Imprint</a></li>
				</ul>
				<div class="part-of">ArtEZ Press is part of <br>ArtEZ University of the Arts</div>

			</div>
			<div class="mini-cart-total"><?php woocommerce_mini_cart(); ?></div>

		</div>

	</div>		
		
</div>
