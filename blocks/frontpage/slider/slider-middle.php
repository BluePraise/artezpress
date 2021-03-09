
<div class="carousel-container new-releases">
<h2 class="slider-title"><?php _e('New Releases', 'artezpress'); ?></h2>
<div class="main-carousel" data-flickity=''>

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
            $tn_id      = get_post_thumbnail_id($b);
            $imgmeta    = wp_get_attachment_metadata($tn_id);
    ?>

     <div class="slider-item" style="background-image: url( <?php echo $img; ?>)">
        <div class="slider-item-meta">
            <h2 class="slider-item-title"><?php echo $title; ?></h2>
        </div>    
        <a href="<?php echo $permalink; ?>"><?php _e('Read More', 'artezpress'); ?></a>
    </div>
<?php
    
    
endwhile;
endif;  
        ?>
    </div>
</div>