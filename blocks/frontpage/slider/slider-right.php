<?php
// This is for 
// get current post id outside loop.

	global $wp_query;
	$id = $wp_query->ID;
    $test = get_field('text_color', $id);
	
// show random posts
// 

$args = array(
    'post_type'      => 'product',
    'orderby'        => 'rand',
    'posts_per_page' => 3,
);
$loop = new WP_Query($args);

defined('ABSPATH') || exit;
?>

<div class="carousel-container backlist">

    <h2 class="slider-title" style="color: <?php echo $test; ?>"><?php _e('From the Backlist', 'artezpress'); ?></h2>
    <div class="main-carousel" data-flickity=''>

        <?php
        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();

                $author = get_field('author');
                $single_product_bg = get_field('custom_color'); 
                $single_product_text_color = get_field('text_color');
                ?>

                <div class="slider-item" style="background-color: <?php echo $single_product_bg;?>">

                    <figure>
                        <img class="slider-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                    </figure>
                    <div class="slider-item-meta" style="color: <?php echo $single_product_text_color; ?>">
                        <h2 class="slider-item-title"><?php echo the_title(); ?></h2>
                        <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'artezpress'); ?></a>
                    </div>
                    
                </div>
        
        <?php
            endwhile;
        endif;
        wp_reset_query(); ?>
    </div>
</div>