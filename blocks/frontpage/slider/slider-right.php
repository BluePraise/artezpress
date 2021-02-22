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
    <h3 class="slider-title"><?php _e('From the Backlist', 'artezpress'); ?></h3>
    <div class="owl-carousel">
        <?php

        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                $id = $post->ID;
                $author = get_field('author');
                $single_product_bg = get_field('custom_color', $id);
                $single_product_text_color = get_field('text_color', $id);
                if ($single_product_text_color == "#00000") : ?>
                        <div class="slider-item slider-item-right backlist-wrapper <?php echo 'set-to-black'; ?>" style="background-color:<?php echo $single_product_bg; ?>">
                        <?php elseif ($single_product_text_color == "#f2f2f2") : ?>
                            <div class="slider-item slider-item-right backlist-wrapper <?php echo 'set-to-white'; ?>" style="background-color:<?php echo $single_product_bg; ?>">
                            <?php endif; ?>

                            <img class="slider-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                            <div class="slider-item-meta">
                                <h2 class="slider-item-title"><?php echo $title; ?></h2>
                            </div>
                            <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'artezpress'); ?></a>
                            </div>
                        <?php
                    endwhile;
                endif;
            wp_reset_query(); ?>
        </div>
    </div>