<?php get_header(); ?>

<main id="site-content" class="container news" role="main">
    <h2 class="page-title"><?php _e('News', 'storefront'); ?></h2>
    <div id="news-json-grid"  data-masonry='{ "itemSelector": ".news-item" }'>
        
        <?php
        //     if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        //          get_template_part('inc/templateparts/news', 'excerpt');	
        //      endwhile; 
            
        // endif; ?>
    </div>
    <div class="load-more">
    <img class="news-preloader"  src="<?php echo get_stylesheet_directory_uri()?>/assets/images/news/loading.gif" />
                        <button  class="btn white-on-black btn-load-more">Load More</button>
                        <h6 class="posts-loaded">All Loaded! </h6>
                    </div>
    <?php /* the_posts_pagination();*/ ?>
</main>


<?php get_footer(); ?>
