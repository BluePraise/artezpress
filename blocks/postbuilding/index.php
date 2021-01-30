<?php

// Check value exists.
if( have_rows('post_building_modules') ):
    while ( have_rows('post_building_modules') ) : the_row();

        if( get_row_layout() == 'book_reference_module' ):
            $book_reference = get_sub_field('book_reference');
            $book_id        = $book_reference->ID; 
            $book_title     = $book_reference->post_title; 
            $book_url       = get_permalink( $book_id );
            $image          = get_the_post_thumbnail( $book_id, 'full' );
            $the_post_ID 	= $wp_query->post->ID;
            $book_reference_description = get_sub_field('book_reference_description');
            ?>

            <?php // book reference module ?>
            <?php if(is_single()): ?>
                <div class="book-reference news-module-container">
                <figure><?php echo $image; ?></figure>
                    <h5><?php echo $book_title; ?></h5>
                    <div class="content-container">
                        
                            <p><?php echo $book_reference_description; ?></p>
                        
                        <a class="news-read-more" href="<?php echo $book_url; ?>" alt="go to <?php echo $book_title ?>"><?php _e('Read More', 'artezpress'); ?></a>
                    </div>
                </div>
            <?php endif; ?>


        <?php  elseif( get_row_layout() == 'video_module' ):
                $video_url      = get_sub_field('video_url');
                $video_caption  = get_sub_field('video_caption');
                
                if ($video_url): ?>
                    <div class="video-container news-module-container"><?php echo $video_url; ?>
                    <?php if ($video_caption): ?>
                        <figcaption class="news-video-caption"><?php echo $video_caption; ?></figcaption>
                    <?php endif; ?>
                    </div>
                <?php endif; 
             
            elseif( get_row_layout() == 'news_content_module' ):
                $news_content      = get_sub_field('news_content');
                
                if ($news_content): ?>
                    <div class="news-text news-module-container"><?php echo $news_content; ?></div>
                <?php endif;

            endif; 
    endwhile;
endif;