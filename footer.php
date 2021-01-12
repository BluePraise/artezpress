<footer class="mast-footer">
<?php if (is_front_page(  )): ?>
    <div class="flex-container wp-end-of-page">
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
                <li><a href="<?php echo site_url("/how-can-we-help"); ?>">How Can We Help?</a></li>
                <li><a href="<?php echo site_url("/privacy-policy"); ?>">Data Protection</a></li>
                <li><a href="<?php echo site_url("/news"); ?>">Imprint</a></li>
            </ul>
            <div class="part-of">ArtEZ Press is part of <br>ArtEZ University of the Arts</div>

        </div>
        <div class="mini-cart-total"><?php woocommerce_mini_cart(); ?></div>

    </div>
    
		
		<nav class="flex-container bottom-menu-bar">
			<div class="logo">
				<a href="#" title="Menu" role="link" tabindex="0"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/logo.svg" alt="logo Artez Press"></a>
			</div>
			
			
			<div class="menu-misc">
				<a class="language-toggle" href="#" role="link">English</a>
				<a class="btn white-on-black" href="<?php echo wc_get_cart_url(); ?>">
					<span class="cart-label">Cart</span>
					<span class="cart-counter"></span>
				</a>
			</div>
		
	</nav>

<?php endif; ?>
</footer>

        <?php wp_footer(); ?>
        <script src="//instant.page/5.1.0" type="module" integrity="sha384-by67kQnR+pyfy8yWP4kPO12fHKRLHZPfEsiSXR8u2IKcTdxD805MGUXBzVPnkLHw"></script>
    </body>
</html>
