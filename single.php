<?php get_header(); ?>

<main id="site-content" class="container-xl single-news" role="main">
    <a class="back-to-news" href="<?php echo site_url("/news"); ?>" role="link">
        <img src="<?php echo get_stylesheet_directory_uri( ) ?>/assets/icons/btn_close.svg" alt="Close article and go back to news">
    </a>
    <article class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php if( has_post_thumbnail() ): ?>
                <figure class="news-thumbnail content-container">
                    <?php the_post_thumbnail(); ?>
                </figure>
            <?php endif; ?>
            <p class="news-date large-text"><?php echo the_date( "d F Y" )?></p>
            <h3><?php the_title(); ?></h3>
            <div class="news-content large-text">
                <?php the_content(); ?>
                <?php get_template_part('blocks/postbuilding/index'); ?>
            </div>
        <?php endwhile; endif; ?>
    </article>
</main>


<?php get_footer(); ?>