<div class="carousel-container">
    <h2><?php _e('From the Backlist'); ?></h2>
    <div class="owl-carousel">
    <?php 
        if( have_rows('slider_item_right') ): 
            while (have_rows('slider_item_right')) : the_row();
                $slider_title = get_sub_field('slider_item_title');
                $slider_image = get_sub_field('slider_item_image'); ?>
                    <div class="slider-item-right">
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