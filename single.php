<?php get_header(); ?>

<main id="site-content" class="container-xl single-news" role="main">
    <a class="go-back" href="<?php echo site_url("/news"); ?>" role="link">
		<img src="<?php echo get_stylesheet_directory_uri( ) ?>/assets/icons/btn_close.svg" alt="Close article and go back to books">
	</a>
    <article class="container news-item__single">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php get_template_part('inc/templateparts/news', 'thumbnail'); ?>
                <div class="content-container">
                    <p class="news-date"><?php echo the_date( "d F Y" )?></p>
                    <h3 class="news-title"><?php the_title(); ?></h3>
                </div>
                    <div class="news-content__single">
                        <?php get_template_part('blocks/postbuilding/index'); ?>
                    </div>
        <?php endwhile; endif; ?>
    </article>
</main>


<?php get_footer(); ?>