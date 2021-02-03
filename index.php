<?php get_header(); ?>

<main id="site-content" class="container news" role="main">
    <h2 class="page-title"><?php _e('News', 'storefront'); ?></h2>
    <div id="news-json-grid" class="news-grid-masonry grid">
        <?php
        //     if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        //          get_template_part('inc/templateparts/news', 'excerpt');	
        //      endwhile; 
            
        // endif; ?>
    </div>
    <div class="load-more">
            <button  class="btn white-on-black btn-load-more">Load More</button>
                    </div>
    <?php /* the_posts_pagination();*/ ?>
</main>


<?php get_footer(); ?>
