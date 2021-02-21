<?php

// show random posts
// 

$args = array(
    'post_type' => 'product',
    'orderby'   => 'rand',
    'posts_per_page' => 3,
);

$loop = new WP_Query($args); ?>

<div class="carousel-container backlist">
    <h2><?php _e('From the Backlist'); ?></h2>
    <div class="owl-carousel">
        <?php

        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                $id = $post->ID;
                $single_product_bg = get_field('custom_color', $id);
                $single_product_text_color = get_field('text_color', $id);
                if ($single_product_text_color == "#00000") : ?>
                        <div class="slider-item-right backlist-wrapper <?php echo 'set-to-black'; ?>" style="background-color:<?php echo $single_product_bg; ?>">
                        <?php elseif ($single_product_text_color == "#f2f2f2") : ?>
                            <div class="slider-item-right backlist-wrapper <?php echo 'set-to-white'; ?>" style="background-color:<?php echo $single_product_bg; ?>">
                            <?php endif; ?>

                            <img class="slider-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                            <h3 class="slider-item-title colour-effect"><?php echo the_title(); ?></h3>
                            <a href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        <?php
                    endwhile;
                endif;
            wp_reset_query(); ?>
        </div>
    </div>