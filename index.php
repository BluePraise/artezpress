<?php get_header(); ?>

<main id="site-content" class="container news" role="main">
    <h2 class="page-title">News</h2>
    <div class="news-grid grid">
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="news-item">
                <div class="news-date small-text"><?php echo the_date( "d F Y" )?></div>
                <?php if( has_post_thumbnail() ): 
                        $tn_id      = get_post_thumbnail_id( $post->ID );
                        $imgmeta    = wp_get_attachment_metadata( $tn_id );
                        // $width  = $img[1];
                        // $height = $img[2];
                        if ($imgmeta['width'] < $imgmeta['height']): ?>
                            <figure class="news-thumbnail attachment-is-portrait">
                                <?php the_post_thumbnail(); ?>
                            </figure>
                        <?php else: ?>
                            <figure class="news-thumbnail attachment-is-landscape">
                                <?php the_post_thumbnail(); ?>
                            </figure>
                    <?php endif; ?>
                <?php endif; ?>
                <h4 class="post-title"><?php the_title(); ?></h4>
                <p class="small-text news-item-excerpt"><?php the_excerpt(); ?></p>
                <a class="small text news-read-more" href="<?php echo the_permalink() ?>" title="<?php the_title(); ?>" role="link">Read More</a>
            </div>
            <?php endwhile; endif; ?>
    </div>
</main>


<?php get_footer(); ?>
