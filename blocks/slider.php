<?php 
	if (have_rows('feature_sliders')) :
		while (have_rows('feature_sliders')) : the_row();
			if( have_rows('slider_item') ): 
				while (have_rows('slider_item')) : the_row();
					$slider_title = get_sub_field('slider_item_title');
					$slider_image = get_sub_field('slider_item_image'); ?>
                    <div class="slider-item">
					    <h3><?php echo $slider_title; ?></h3>
                        <img src="<?php echo esc_url( $slider_image ); ?>" alt="<?php echo $slider_title; ?>">
                    </div>

	<?php
				endwhile;
			endif;    
		endwhile;
	endif;

?>