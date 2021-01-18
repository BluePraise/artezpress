<?php get_header(); ?>

<main id="site-content" class="container news" role="main">
    <h2 class="page-title">News</h2>
    <div class="news-grid grid">
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
                <?php get_template_part('inc/templateparts/news', 'excerpt'); ?>	
            <?php endwhile; endif; ?>
    </div>
</main>


<?php get_footer(); ?>
