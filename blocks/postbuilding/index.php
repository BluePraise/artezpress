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
            
            ?>

            <div class="content-container">
                <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">            
                <h3><?php echo $book_title; ?></h3>
                <a href="<?php echo $book_url; ?>" alt="go to <?php echo $book_title ?>">Read More</a>
            </div>
        <?php  
            elseif( get_row_layout() == 'video_module' ):
                $video_url      = get_sub_field('video_url');
                $video_caption  = get_sub_field('video_caption');
                
                if ($video_url): ?>
                    <div class="video-container"><?php echo $video_url; ?></div>
                <?php endif; 

                if ($video_caption): ?>
                    <figcaption><?php echo $video_caption; ?></figcaption>
                <?php endif;
             
            elseif( get_row_layout() == 'news_content_module' ):
                $news_content      = get_sub_field('news_content');
                
                if ($news_content): ?>
                    <div class="post-container"><?php echo $news_content; ?></div>
                <?php endif;

            endif; 

        // // Case: Download layout.
        // elseif( get_row_layout() == 'download' ): 
        //     $file = get_sub_field('file');
        //     // Do something...

    // End loop.
    endwhile;
endif;