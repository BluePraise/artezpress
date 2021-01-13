<?php 
	get_template_part( 'head' );
	$rows = get_field('hero_imgs', 'option'); // get all the rows 
	$rand_row = $rows[ array_rand( $rows ) ];
	$rand_row_image = $rand_row['bg_images_uploaded']; // get the sub field value
?>
<header class="main-menu-container fixed-bottom">
		<div class="bg-overlay" style="background-image: url(<?php echo $rand_row_image; ?>);"></div>
	<nav class="main-menu-bar">
		
		<div class="flex-container">
			<div class="logo js-toggle-menu">
				<a href="#" title="Menu Toggle" role="link" tabindex="0">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 24"><path d="M5.92,19.42a5.79,5.79,0,0,1-1.49-.17c-.55-.19-.83-.49-.83-.9A5.86,5.86,0,0,1,4,16.73c.12-.35.4-1.1.82-2.25h6.52l.73,1.75q.24.59.39,1a3.64,3.64,0,0,1,.22,1c0,.5-.14.81-.44.93a6.85,6.85,0,0,1-1.86.24v.73h9.39v-.73a1.72,1.72,0,0,1-1.53-.71,20.07,20.07,0,0,1-1.63-3.29L10.11.25h-.8L2.86,16.05a13.2,13.2,0,0,1-1.17,2.42,2.19,2.19,0,0,1-1.69,1v.73H5.92ZM7.86,6.66H8.1l2.79,6.68H5.24Z"/><path d="M29.14,19.46A3.1,3.1,0,0,1,27.47,19c-.28-.24-.42-.83-.42-1.78V11.74a3.14,3.14,0,0,1,.59-2A1.6,1.6,0,0,1,28.81,9c.18,0,.5.28,1,.86a2,2,0,0,0,1.59.86,1.74,1.74,0,0,0,1.32-.55,2,2,0,0,0,.5-1.4,2,2,0,0,0-.72-1.67,2.5,2.5,0,0,0-1.61-.57,3.35,3.35,0,0,0-2.1.71,10.8,10.8,0,0,0-1.83,1.9V6.86h-5.5v.69A2.12,2.12,0,0,1,22.65,8,1.87,1.87,0,0,1,23,9.23v7.85l0,.85a1.65,1.65,0,0,1-.35,1.14,2.18,2.18,0,0,1-1.17.39v.69h7.73Z"/><path d="M36.06,17.49a2.71,2.71,0,0,0,1.47,2.66,3.9,3.9,0,0,0,1.79.38,4,4,0,0,0,3-1.31,6.59,6.59,0,0,0,1.22-1.93l-.7-.34a5.32,5.32,0,0,1-.76,1.11,1.25,1.25,0,0,1-.95.4,1,1,0,0,1-.94-.63,2.55,2.55,0,0,1-.18-1V8.13h2.76V6.86H40.05V2h-.74a23.15,23.15,0,0,1-2.39,3.09c-.45.49-.92,1-1.42,1.42s-.69.6-1,.84v.8h1.51Z"/><path d="M62.64,14.15h-.81a8.9,8.9,0,0,1-3.12,4,8.53,8.53,0,0,1-4.53,1.08,3.71,3.71,0,0,1-2-.34,1.4,1.4,0,0,1-.47-1.24v-7a4.65,4.65,0,0,1,3.43,1,6.21,6.21,0,0,1,1.27,3.48h.74V5.39h-.74a6.84,6.84,0,0,1-1.35,3.38c-.58.62-1.7.91-3.35.9V3a1.32,1.32,0,0,1,.36-1.09,3.29,3.29,0,0,1,1.69-.27c2.33,0,3.94.34,4.82,1a6.15,6.15,0,0,1,1.88,3.82h.71V.64H44.5v.74a4.52,4.52,0,0,1,1.75.33,1.75,1.75,0,0,1,.83,1.7v14a1.77,1.77,0,0,1-.8,1.69,4.13,4.13,0,0,1-1.78.34v.73h17Z"/><path d="M81.94,13.2h-.76Q80.07,17.36,78,18.25t-8.11.9l11.22-18V.64H65.67l-.61,6h.81a13,13,0,0,1,1.44-3,4.79,4.79,0,0,1,3-1.75c.36-.07.75-.13,1.18-.17s1.76-.07,4-.07L64.15,19.69v.46h17Z"/><path d="M103,19.42a3.24,3.24,0,0,1-2-.55,2.9,2.9,0,0,1-.54-2.09V11.4c1.73,0,3,0,3.91-.11a9.3,9.3,0,0,0,2.63-.65,5.22,5.22,0,0,0,2.5-2A5,5,0,0,0,110.27,6a4.45,4.45,0,0,0-1.93-4.12,10.82,10.82,0,0,0-5.65-1.2H93.36v.74A3.63,3.63,0,0,1,95.27,2c.33.28.5,1,.5,2.05V16.78a3,3,0,0,1-.49,2,3.09,3.09,0,0,1-1.92.6v.73H103ZM100.47,2.64a.82.82,0,0,1,.37-.79,2.71,2.71,0,0,1,1.24-.21,2.64,2.64,0,0,1,2.55,1.22A6.5,6.5,0,0,1,105.3,6c0,1.93-.46,3.18-1.37,3.77a7.61,7.61,0,0,1-3.46.59Z"/><path d="M119.49,19.46a3.09,3.09,0,0,1-1.66-.47c-.28-.24-.42-.83-.42-1.78V11.74a3.14,3.14,0,0,1,.59-2A1.6,1.6,0,0,1,119.17,9c.18,0,.5.28,1,.86a2,2,0,0,0,1.59.86,1.74,1.74,0,0,0,1.32-.55,2,2,0,0,0,.5-1.4,2,2,0,0,0-.72-1.67,2.5,2.5,0,0,0-1.61-.57,3.35,3.35,0,0,0-2.1.71,10.13,10.13,0,0,0-1.83,1.9V6.86h-5.5v.69A2.12,2.12,0,0,1,113,8a1.87,1.87,0,0,1,.31,1.24v7.85l0,.85a1.65,1.65,0,0,1-.35,1.14,2.18,2.18,0,0,1-1.17.39v.69h7.72Z"/><path d="M130.59,20.56a6,6,0,0,0,2.64-.55A7.71,7.71,0,0,0,136.35,17l-.67-.41a9.33,9.33,0,0,1-1.37,1.29,3.34,3.34,0,0,1-1.93.63,3.07,3.07,0,0,1-3-2.38,10.67,10.67,0,0,1-.57-3h7.41a8.72,8.72,0,0,0-.1-1.15,7.86,7.86,0,0,0-.71-2.59,5,5,0,0,0-1.94-2.07,5.18,5.18,0,0,0-2.69-.75,5.72,5.72,0,0,0-4.29,1.84,7.12,7.12,0,0,0-1.78,5.17q0,3.68,1.87,5.35A5.91,5.91,0,0,0,130.59,20.56Zm-1.37-12a1.56,1.56,0,0,1,1.56-1.17,1.43,1.43,0,0,1,1.47,1,12,12,0,0,1,.4,3.56h-3.91A11.56,11.56,0,0,1,129.22,8.59Z"/><path d="M139.16,19.92a.52.52,0,0,1,.41-.19h.17l.33.12.5.16a11.54,11.54,0,0,0,1.45.42,5.81,5.81,0,0,0,1.17.12,4.3,4.3,0,0,0,3.5-1.39,4.54,4.54,0,0,0,1.17-3,3.79,3.79,0,0,0-1.13-2.78A8.16,8.16,0,0,0,144.57,12L143,11.27a4.41,4.41,0,0,1-1.56-1.07,1.62,1.62,0,0,1-.43-1A1.7,1.7,0,0,1,141.48,8a1.81,1.81,0,0,1,1.44-.54,3.09,3.09,0,0,1,2.18.89,5,5,0,0,1,1.34,2.36h.74V6.56h-.64a1.19,1.19,0,0,1-.24.42.71.71,0,0,1-.51.15,6.42,6.42,0,0,1-1.29-.31,7,7,0,0,0-1.95-.3,4.38,4.38,0,0,0-3.29,1.22,4,4,0,0,0-1.17,2.9,3.67,3.67,0,0,0,.75,2.3,6.72,6.72,0,0,0,2.43,1.8l2.16,1a4.22,4.22,0,0,1,1,.64,1.86,1.86,0,0,1,0,2.64,2.3,2.3,0,0,1-1.64.5,4,4,0,0,1-2.38-.85,4.63,4.63,0,0,1-1.58-2.93h-.81v4.78h.69A2.84,2.84,0,0,1,139.16,19.92Z"/><path d="M150.82,19.92a.55.55,0,0,1,.42-.19h.16l.34.12.49.16a12,12,0,0,0,1.45.42,6,6,0,0,0,1.17.12,4.32,4.32,0,0,0,3.51-1.39,4.54,4.54,0,0,0,1.17-3,3.76,3.76,0,0,0-1.14-2.78A8.24,8.24,0,0,0,156.24,12l-1.58-.76a4.41,4.41,0,0,1-1.56-1.07,1.57,1.57,0,0,1-.43-1A1.74,1.74,0,0,1,153.14,8a1.83,1.83,0,0,1,1.44-.54,3.07,3.07,0,0,1,2.18.89,5,5,0,0,1,1.35,2.36h.74V6.56h-.64A1.2,1.2,0,0,1,158,7a.68.68,0,0,1-.5.15,6.42,6.42,0,0,1-1.29-.31,7,7,0,0,0-1.95-.3,4.36,4.36,0,0,0-3.29,1.22,4,4,0,0,0-1.18,2.9,3.67,3.67,0,0,0,.75,2.3,6.77,6.77,0,0,0,2.44,1.8l2.15,1a4.12,4.12,0,0,1,1,.64,1.86,1.86,0,0,1,0,2.64,2.33,2.33,0,0,1-1.64.5,4,4,0,0,1-2.38-.85,4.64,4.64,0,0,1-1.59-2.93h-.8v4.78h.69A2.87,2.87,0,0,1,150.82,19.92Z"/><rect y="22.6" width="82.3" height="1.16"/><rect x="92.94" y="22.6" width="67.06" height="1.16"/></svg>
				</a>
			</div>
			
			
			<div class="menu-misc">
				<ul class="language-toggle js-language-toggle">
					<?php $langs_array = pll_the_languages( array( 'dropdown' => 0, 'raw' => 1 ) ); ?>

						<?php if ($langs_array) : ?>
						<li class="lang-item">
							<?php foreach ($langs_array as $lang) : ?>
								<a href="<?php echo $lang['url']; ?>" class="drop-block__link <?php if($lang['current_lang']): ?>active<?php else:?>inactive<?php endif; ?>">
									<?php echo $lang['name']; ?>
								</a>
							<?php endforeach; ?>
						</li>
					<?php endif; ?>
                </ul>
				</ul>	



				<a class="btn white-on-black cart-ban" href="<?php echo wc_get_cart_url(); ?>">
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
		
</header>
