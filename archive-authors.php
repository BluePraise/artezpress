<?php 
    /* Template name: Authors Archive */
    get_header(); 
?>

<main class="site-main page author-page" role="main">

    <h2 class="page-title"><?php echo the_title(); ?></h2>
		<ul class="content-container grid">

        <?php if( have_rows('add_author') ): while ( have_rows('add_author') ) : the_row(); ?>

            <li>
               <div class="author-content__top">
                 <img src="<?php echo the_sub_field('author_image'); ?>" alt="<?php echo the_sub_field('author_name') ?> at ArtEZPress">
                 <h2><?php echo the_sub_field('author_name') ?></h2>
               </div>
               <div class="author-content__bio">
                 <p><?php echo the_sub_field('author_bio') ?></p>
               </div>
               <div class="author-content__socials">
                 <?php if (get_sub_field('author_twitter')): ?>
                    <a href="<?php echo the_sub_field('author_twitter'); ?>" class="link-list__item author-twitter"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_tw.svg" alt="Twitter Icon"></a>      
                 <?php endif; ?>
                 <?php if (get_sub_field('author_instagram')): ?>
                    <a href="<?php echo the_sub_field('author_instagram'); ?>" class="link-list__item author-instagram"  alt="link to instagram"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_ig.svg" alt="Instagram Icon"></a>                   
                 <?php endif; ?>
                 <?php if (get_sub_field('author_facebook')): ?>
                    <a href="<?php echo the_sub_field('author_facebook'); ?>" class="link-list__item author-facebook" alt="link to facebook"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_fb.svg" alt="Facebook Icon"></a>
                 <?php endif; ?>
                  <?php if (get_sub_field('author_linkedin')): ?>
                    <a href="<?php echo the_sub_field('author_linkedin'); ?>" class="link-list__item author-linkedin"  alt="link to linkedin"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_li.svg" alt="LinkedIn Icon"></a>                   
                 <?php endif; ?>
                 <?php if (get_sub_field('author_website')): ?>
                    <a href="<?php echo the_sub_field('author_website'); ?>" class="link-list__item author-website"  alt="link to website"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_link.svg" alt="Link Icon"></a>                   
                 <?php endif; ?>
                 <?php if (get_sub_field('author_books')): ?>
                    <a href="<?php echo the_sub_field('author_books'); ?>" class="link-list__item author-books">Author's Books on ArtEZPress</a>                   
                 <?php endif; ?>
                    
               </div>                
            </li>

        <?php endwhile; endif; ?>
			
		</ul>
	
	
</main><!-- #main -->


<?php get_footer(); ?>
