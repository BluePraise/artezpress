<?php get_header(); ?>


<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/news.css">
<main id="site-content" class="container news" role="main">
    <h2 class="page-title">News</h2>
    <div class="flex-container">
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="news-item">
                <p class="news-date small-text"><?php echo the_date( "d F Y" )?></p>
                <?php if( has_post_thumbnail() ): ?>
                    <figure class="news-thumbnail">
                          <?php the_post_thumbnail(); ?>
                    </figure>
                <?php endif; ?>
                <h3 class="post-title"><?php echo the_title(); ?></h3>
                <p class="small-text"><?php the_excerpt(); ?></p>
                <a class="news-read-more" href="<?php echo the_permalink() ?>" title="<?php the_title(); ?>" role="link">Read More</a>
            </div>
            <?php endwhile; endif; ?>
    </div>
</main>


<?php get_footer(); ?>