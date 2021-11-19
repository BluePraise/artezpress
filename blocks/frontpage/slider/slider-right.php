<?php
// This is for 
// get current post id outside loop.

// show rando posts
$args = array(
    'post_type'      => 'product',
    'orderby'        => 'rand',
    'posts_per_page' => 3,
);
$loop = new WP_Query($args);

defined('ABSPATH') || exit;
?>
<div class="carousel-container backlist">
    <div class="highlights-carousel backlist-carousel">

        <div class="slider-overlay">
            <div class="slider-title"><?php _e('From the Backlist', 'artezpress'); ?></div>

            <div class="slider-nav grid">
                <div class="slider-nav__pager"></div>
                <a class="slider-nav__link" href=""><?php _e('Read More', 'artezpress'); ?></a>
            </div>
        </div>

        <?php
            if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();

                $single_product_bg = get_field('custom_color');
                $single_product_text_color = get_field('text_color');
                $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full", false );
                
                $image_width = $image_data[1];
                $image_height = $image_data[2];
                
            ?>

            <div class="carousel-cell carousel-cell-highlights carousel-cell__backlist" style="background-color: <?= $single_product_bg;?>" data-color="<?= $single_product_text_color; ?>"  data-url="<?php the_permalink(); ?>">

            <div class="carousel-cell__cover" style="--var-aspect-ratio: <?= $image_width / $image_height ?>">
                <figure class="carousel-cell__cover-card book-item-card__cover">
                    <img class="carousel-cell__cover-attachment" src="<?= get_the_post_thumbnail_url(); ?>" alt="<?= the_title(); ?>">
                </figure>
            </div>

            <div class="carousel-cell__title"><?= the_title(); ?></div>

            </div>

        <?php
            endwhile;
        endif;
        wp_reset_query(); ?>

    </div>
</div>
