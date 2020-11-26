
<div class="carousel-container">
    <h2><?php _e('New Releases'); ?></h2>
    <div class="owl-carousel">
    <?php 
        if( have_rows('slider_item_middle') ): 
            while (have_rows('slider_item_middle')) : the_row();
                $slider_title = get_sub_field('slider_item_title');
                $slider_image = get_sub_field('slider_item_image'); ?>
                    <div class="slider-item-middle">
                        <img class="slider-img" src="<?php echo esc_url( $slider_image ); ?>" alt="<?php echo $slider_title; ?>">
                        <h3 class="slider-item-title colour-effect"><?php echo $slider_title; ?></h3>
                        <a href="<?php the_permalink(); ?>">Read More</a>
                    </div>
    <?php
            endwhile;
        endif;    
    ?>
    </div>
</div>