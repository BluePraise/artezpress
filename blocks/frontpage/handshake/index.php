<?php 
    $rows = get_field('hero_bg_imgs'); // get all the rows 
    $rand_row = $rows[ array_rand( $rows ) ];
    $rand_row_image = $rand_row['bg_images_uploaded']; // get the sub field value 
?>

<div class="hero handshake" style="background-image: url(<?php echo $rand_row_image; ?>);">

    <h1>ArtEZ Press</h1>
</div>