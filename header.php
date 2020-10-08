<?php 
	 get_template_part( 'head' );
?>
<div class="main-menu-container fixed-bottom">
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
						<p class="large-text">Subscribe to our newsletter</p>
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
						<li><a href="<?php echo site_url("/how-can-we-help"); ?>">How Can We Help?</a></li>
						<li><a href="<?php echo site_url("/privacy-policy"); ?>">Data Protection</a></li>
						<li><a href="<?php echo site_url("/news"); ?>">Imprint</a></li>
					</ul>
					<div class="part-of">ArtEZ Press is part of <br>ArtEZ University of the Arts</div>

				</div>
				<div class="mini-cart-total"><?php woocommerce_mini_cart(); ?></div>

			</div>
		</div>
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

</div>
