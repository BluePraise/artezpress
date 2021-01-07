

<div class="carousel-container">
    <h2><?php _e('Coming Soon'); ?></h2>
    <div class="owl-carousel">
<?php 

// if checkbox is checked then show this item in carroussel
$args = array(
    'post_type' => 'product',
    'meta_query' => array(
        array (
            'key'    => 'add_coming_soon',
            'value'  => '1',
        )
    )
);

$loop = new WP_Query($args);

    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="slider-item-left">
                <img class="slider-img" src="<?php echo my_get_the_product_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                <h3 class="slider-item-title colour-effect"><?php echo the_title(); ?></h3>
                <a href="<?php the_permalink(); ?>">Read More</a>
            </div>
    <?php 
        endwhile;
        endif;  
        wp_reset_query();     
        ?>
    </div>
</div>