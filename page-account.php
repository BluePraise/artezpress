<?php
/* Template Name: Account */
get_header();
?>


<main id="site-content" class="container-l page account-page<?php if(is_user_logged_in()): ?> logged-in<?php else: ?> not-logged-in<?php endif; ?>" role="main">
    
    <h2 class="page-title"><?php echo the_title(); ?></h2>
    
    <?php
    if (have_posts()) : while (have_posts()) : the_post();
            the_content();
        endwhile;
    endif;
    ?>

</main>


<?php get_footer(); ?>