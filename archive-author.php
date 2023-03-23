<?php
   /* Template Name: Author Overview */
    get_header();
$args = array(
    'post_type'         => 'author',
    'post_status'       => 'publish',
    'posts_per_page'    => -1,
    'meta_key'          => 'author_last_name',
    'orderby'           => 'meta_value',
    'order'             => 'ASC',
);
$posts = new WP_Query( $args );

?>

<main class="site-main page author-page" role="main">

   <?php if($posts -> have_posts()): ?>
      <h2 class="page-title"><?php _e('Authors of ArtEZ Press', 'artezpress'); ?></h2>
		<ul class="container-l grid">
         <?php
               while ( $posts -> have_posts() ):
                     $posts->the_post();
               $author_image = get_field('author_image');
               $author_twitter = get_field('author_twitter');
               $author_instagram = get_field('author_instagram');
               $author_facebook = get_field('author_facebook');
               $author_linkedin = get_field('author_linkedin');
               $author_website = get_field('author_website');
               $author_books = get_field('author_books');
         ?>

          <li>
               <div class="author-content__top">
                  <?php if($author_image):?>
                     <img src="<?php echo esc_url($author_image); ?>" alt="<?php the_title(); ?> at ArtEZPress">
                  <?php endif; ?>
                  <h2><?php the_title(); ?></h2>
               </div>

               <?php if(the_field('author_bio')):?>
                  <div class="author-content__bio">
                     <p><?php the_field('author_bio') ?></p>
                  </div>
               <?php endif; ?>
               <div class="author-content__socials">
                 <?php if ($author_twitter): ?>
                    <a href="<?php echo esc_url($author_twitter); ?>" class="link-list__item author-twitter"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_tw.svg" alt="Twitter Icon"/></a>
                 <?php endif; ?>
                 <?php if ($author_instagram): ?>
                    <a href="<?php echo esc_url($author_twitter); ?>" class="link-list__item author-instagram"  alt="link to instagram"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_ig.svg" alt="Instagram Icon"></a>
                 <?php endif; ?>
                 <?php if ($author_facebook): ?>
                    <a href="<?php echo esc_url($author_facebook); ?>" class="link-list__item author-facebook" alt="link to facebook"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_fb.svg" alt="Facebook Icon"></a>
                 <?php endif; ?>
                  <?php if ($author_linkedin): ?>
                    <a href="<?php echo esc_url($author_linkedin); ?>" class="link-list__item author-linkedin"  alt="link to linkedin"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_li.svg" alt="LinkedIn Icon"></a>
                 <?php endif; ?>
                 <?php if ($author_website): ?>
                    <a href="<?php echo esc_url($author_linkedin); ?>" class="link-list__item author-website"  alt="link to website"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/icons/menu_link.svg" alt="Link Icon"></a>
                 <?php endif; ?>
                 <?php if ($author_books): ?>
                    <a href="<?php echo esc_url($author_books); ?>" class="link-list__item author-books"><?php _e("Author's Books on ArtEZPress", "artezpress"); ?></a>
                 <?php endif; ?>
               </div>
            </li>
         <?php endwhile; wp_reset_query(); ?>
		</ul>
      <?php else: ?>
       <p>There are no authors.</p>
      <?php endif; ?>
</main><!-- #main -->


<?php get_footer(); ?>
