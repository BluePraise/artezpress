<?php 
    /* Template Name: News Page */
    get_header(); 
?>


<main id="site-content container" role="main">
    <h2 class="page-title"><?php echo the_title(); ?></h2>
    <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="news-item">
            <h3 class="post-title"><?php echo the_title(); ?></h3>
            <p class="small-text"><?php the_excerpt(); ?>Test</p>
        </div>
        <?php endwhile; endif; ?>

</main>


<?php get_footer(); ?>