<?php if(!is_singular()): ?>
    <div class="grid-sizer"></div>
<?php endif; ?>
<div class="news-item">
    <div class="news-date-excerpt"><?php echo the_date( "d F Y" )?></div>
    <?php if( has_post_thumbnail() ): 
            $tn_id      = get_post_thumbnail_id( $post->ID );
            $imgmeta    = wp_get_attachment_metadata( $tn_id );
            
            
            if ($imgmeta['width'] < $imgmeta['height']): ?>
                <figure class="news-thumbnail attachment-is-portrait">
                    <?php the_post_thumbnail(); ?>
                </figure>
            <?php else: ?>
                <figure class="news-thumbnail attachment-is-landscape">
                    <?php the_post_thumbnail(); ?>
                </figure>
        <?php endif; ?>
    <?php endif; ?>
    <h4 class="news-title news-title-excerpt"><?php the_title(); ?></h4>
    <?php if( have_rows('post_building_modules') ):
        while ( have_rows('post_building_modules') ) : the_row();

        if( get_row_layout() == 'news_content_module' ):
            $news_content      = get_sub_field('news_content');
                
            if ($news_content): 
                //https://wordpress.stackexchange.com/questions/325271/generate-a-excerpt-from-an-acf-wysiwyg-field
                if( !empty( $news_content ) ):
                    $trimmed_content = wp_trim_words($news_content);
                    $clean_excerpt = apply_filters('the_excerpt', $trimmed_content);

                    // needs a custom class .news-item-excerpt
                    echo '<p class="news-item-excerpt">'. $trimmed_content .'</p>';
                
                endif;
            endif;
        endif;
        endwhile; endif 
    ?>


    <a class="news-read-more" href="<?php echo the_permalink() ?>" title="<?php the_title(); ?>" role="link"><?php _e('Read More', 'artezpress');?></a>
</div>


