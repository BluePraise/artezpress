<?php get_header(); ?>

<main class="site-main container-xl" role="main">
<h2><?php the_title(); ?></h2>
	<article class="content-container">

		<?php 
		the_content();
		get_template_part('blocks/index'); ?>
	</article>

</main><!-- #main -->
<?php get_footer(); ?>