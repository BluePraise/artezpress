<?php get_header(); ?>

<main id="site-content" class="container news" role="main">
    <h2 class="page-title">News</h2>
    <div class="news-grid grid">
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="news-item">
                <div class="news-date small-text"><?php echo the_date( "d F Y" )?></div>
                <?php if( has_post_thumbnail() ): ?>
                    <figure class="news-thumbnail">
                          <?php the_post_thumbnail(); ?>
                    </figure>
                <?php endif; ?>
                <h4 class="post-title"><?php the_title(); ?></h4>
                <p class="small-text news-item-excerpt)"><?php the_excerpt(); ?></p>
                <a class="small text news-read-more" href="<?php echo the_permalink() ?>" title="<?php the_title(); ?>" role="link">Read More</a>
            </div>
            <?php endwhile; endif; ?>
    </div>
</main>


<?php get_footer(); ?>