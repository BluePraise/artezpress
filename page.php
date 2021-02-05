<?php get_header(); ?>

<main class="site-main container-xl" role="main">
	<?php if (!is_page('cart') || !is_cart()) : ?>
		<h2 class="page-title"><?php echo the_title(); ?></h2>
	<?php endif; ?>
	<article class="content-container">

		<?php
		the_content();
		get_template_part('blocks/index'); ?>
	</article>

</main><!-- #main -->
<?php get_footer(); ?>