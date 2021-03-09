<div class="carousel-container coming-soon">
    <h2 class="slider-title"><?php _e('Coming Soon', 'artezpress'); ?></h2>
    <div class="highlight-carousel coming-soon-carousel">

        <?php 

        // if checkbox is checked then show this item in carroussel
        $args = array(
            'post_type' => 'product',
            'meta_query' => array(
                array (
                    'key'    => 'add_coming_soon',
                    'value'  => '1',
                )
            )
        );
        $loop = new WP_Query($args);

        if ( $loop->have_posts() ) : ?>
    
        <?php while ( $loop->have_posts() ) : $loop->the_post();
            $author = get_field('author'); ?>
            <div class="slider-item">
                <img class="slider-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                <div class="slider-item-meta">
                    <h2 class="slider-item-title"><?php echo the_title(); ?></h2>
                    <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'artezpress');?></a>
                </div>
            </div>
        <?php 
            endwhile;
            endif;  
            wp_reset_query();     
        ?>


    </div>
</div>