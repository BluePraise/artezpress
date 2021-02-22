<?php if (is_product()) :

    // $single_product_text_color = get_field('text_color', $id);
endif;
?>


<div class="carousel-container new-releases">
<h2 class="slider-title"><?php _e('New Releases'); ?></h2>
<div class="owl-carousel">

<?php 

    if( have_rows('new_releases_row', 'option') ):
        // Loop through rows.
        while( have_rows('new_releases_row', 'option') ) : the_row(); 
            $book_obj    = get_sub_field('add_to_new');
            if ($book_obj):
                foreach ($book_obj as $b) :
                    $book_prod  = wc_get_product($b);
                    $permalink  = get_permalink($b);
                    $title      = get_the_title($b);
                    $author     = get_field('author', $b);
                endforeach;
            endif;
            $img        = get_sub_field('add_custom_image');
    ?>

     <div class="slider-item slider-item-middle">
            <img class="slider-img" src="<?php echo $img; ?>" alt="<?php echo $title; ?>">
        <div class="slider-item-meta">
            <h3 class="slider-item-title"><?php echo $title; ?></h3>
            <h3 class="slider-item-author"><?php echo $author; ?></h3>
        </div>    
        <a href="<?php echo $permalink; ?>">Read More</a>
    </div>
<?php
    
    
endwhile;
endif;  
        ?>
    </div>
</div>