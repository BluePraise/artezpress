<?php

// show random posts
// 


$args = array(
    'post_type'      => 'product',
    'orderby'        => 'rand',
    'posts_per_page' => 3,
);
$loop = new WP_Query($args); 
?>

<div class="carousel-container backlist">

    <h2 class="slider-title"><?php _e('From the Backlist', 'artezpress'); ?></h2>
    <div class="owl-carousel">

        <?php
        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                
                $author = get_field('author');
                $single_product_bg = get_field('custom_color'); ?>
                
                        <div class="slider-item slider-item-right backlist-wrapper" style="background-color:<?php echo $single_product_bg; ?>">

                            <img class="slider-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                            <div class="slider-item-meta">
                                <h2 class="slider-item-title"><?php echo the_title(); ?></h2>
                            </div>
                            <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'artezpress'); ?></a>
                        </div>
                        <?php
                    endwhile;
                endif;
            wp_reset_query(); ?>
        </div>
    </div>