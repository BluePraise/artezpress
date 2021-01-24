<?php 
    /* Template Name: Cart Page */
    get_header(); 
?>


<main id="site-content" class="container-xl" role="main">
    <h2 class="page-title"><?php echo the_title(); ?></h2>
    <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
            the_content();
        endwhile; endif; 
    ?>

</main>


<?php get_footer(); ?>
