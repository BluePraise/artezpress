<?php get_header(); ?>

<main class="container-l news page" role="main">
    <h2 class="page-title"><?php _e('News', 'storefront'); ?></h2>
    <div class="news-grid-masonry">
        <div class="grid-sizer"></div>
        <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php get_template_part('inc/templateparts/news', 'excerpt'); ?>
            <?php endwhile;

        endif; ?>
    </div>
    <?php //the_posts_pagination();?>
</main>


<?php get_footer(); ?>
