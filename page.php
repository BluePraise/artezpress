<?php get_header(); ?>

<main class="site-main container-s page" role="main">
	<?php if (!is_cart() && !is_checkout()) : ?>
		<h2 class="page-title"><?php echo the_title(); ?></h2>
		<article class="content-container">
			<?php
			the_content();
			get_template_part('blocks/index'); ?>
		</article>
	<?php endif; ?>
	<?php if (is_cart() || is_checkout()) : ?>
		<div class="content-container">
			<h2 class="page-title"><?php echo the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
	<?php endif; ?>
</main><!-- #main -->




<?php get_footer();
