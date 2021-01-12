<?php

// Check value exists.
if( have_rows('post_building_modules') ):
    while ( have_rows('post_building_modules') ) : the_row();

        if( get_row_layout() == 'book_reference_module' ):
            $book_reference = get_sub_field('book_reference');
            $book_id        = $book_reference->ID; 
            $book_title     = $book_reference->post_title; 
            $book_url       = get_permalink( $book_id );
            $image          = wp_get_attachment_image_src( get_post_thumbnail_id( $book_id ));
            
            // var_dump($book_reference);
            ?>
            <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">            
            <h3><?php echo $book_title; ?></h3>
            <a href="<?php echo $book_url; ?>">Read More</a>
        <?php endif; 

        if( get_row_layout() == 'video_module' ):
            $video_url      = get_sub_field('video_url');
            $video_caption  = get_sub_field('video_caption');
            ?>
            
            <?php if ($video_url): ?>
                <div class="video-container"><?php echo $video_url; ?></div>
            <?php endif; ?>

            <?php if ($video_caption): ?>
                <p><?php echo $video_caption; ?></p>
            <?php endif; ?>
        <?php endif; 

        // // Case: Download layout.
        // elseif( get_row_layout() == 'download' ): 
        //     $file = get_sub_field('file');
        //     // Do something...

    // End loop.
    endwhile;
endif;