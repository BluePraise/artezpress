
<?php 

// if checkbox is checked then show this item in carroussel
$checkbox = get_field('add_new_releases');
  
$args = array(
    'post_type' => 'product',
    'meta_query' => array(
        array (
            'key'    => 'add_new_releases',
            'value'  => '1',
        )
    )
);

$loop = new WP_Query($args); ?>
 
    <div class="carousel-container new-releases">
    <h2><?php _e('New Releases'); ?></h2>
    <div class="owl-carousel">

<?php 

    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $author = get_field('author'); ?>
             <div class="slider-item-middle">
                <img class="slider-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                <h3 class="slider-item-title colour-effect"><?php echo the_title(); ?></h3>
                <h3 class="slider-item-title colour-effect"><?php echo $author; ?></h3>
                
                <a href="<?php the_permalink(); ?>">Read More</a>
            </div>
    <?php
        endwhile;
        endif;  
        wp_reset_query();     
        ?>
    </div>
</div>