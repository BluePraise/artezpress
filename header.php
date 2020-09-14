<?php 
	 get_template_part( 'head' );
	global $woocommerce;
    $count = $woocommerce->cart->cart_contents_count;
?>

<nav class="main-menu fixed-bottom">
	<div class="flex-container">
		<div class="logo">
			<a href="<?php echo site_url( '/' ); ?>" title="Go back to frontpage" role="link" tabindex="0">ArtEz Press Logo</a>
		</div>
		<div class="menu-misc">
			<a class="language-toggle" href="#" role="link">English</a>
			 <a class="btn shopping-cart" href="<?php echo wc_get_cart_url(); ?>">
				 <span class="cart-label">Cart</span>
				 
					<span class="cart-counter"></span>
			</a>
		</div>
	</div>
</nav>

