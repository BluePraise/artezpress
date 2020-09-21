<?php 
    /* Template Name: News Page */
    get_header(); 
?>


<main id="site-content container" role="main">
    <h3 class="page-title"><?php echo the_title(); ?></h3>
    <?php
        if ( have_posts() ) :

            while ( have_posts() ) : the_post();


            endwhile;
        endif;
        ?>

</main>


<?php get_footer(); ?>