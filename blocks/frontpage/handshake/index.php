<?php 
    $frontpage_id = get_option( 'page_on_front' );
    $rows = get_field('hero_bg_imgs', 'option'); // get all the rows
	$hero_images = array();
	if( have_rows('hero_bg_imgs', 'option') ):
		while ( have_rows('hero_bg_imgs', 'option') ) : the_row();
		
			if (in_array( 1, get_sub_field('hero_area'))) {  	
				$hero_images[]	=  get_sub_field('bg_images_uploaded');
			}
		endwhile;
	endif;
	 $rand_row_image = $hero_images[array_rand($hero_images)]; 
	
?>

<div class="hero fade-in" style="background-image: url(<?php echo $rand_row_image; ?>);">

    <h1>ArtEZ Press</h1>
</div>