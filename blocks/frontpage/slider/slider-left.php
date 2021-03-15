<div class="carousel-container coming-soon">
  <div class="highlights-carousel coming-soon-carousel">

    <div class="slider-overlay">
      <div class="slider-title"><?php _e('Coming Soon', 'artezpress'); ?></div>

      <div class="slider-nav grid">
        <div class="slider-nav__pager"></div>
        <a class="slider-nav__link" href=""><?php _e('Read More', 'artezpress'); ?></a>
      </div>
    </div>


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

        <div class="carousel-cell carousel-cell-highlights" data-url="<?php the_permalink(); ?>">
          <div class="carousel-cell__title"><?php echo the_title(); ?></div>
       </div>

    <?php
        endwhile;
        endif;
        wp_reset_query();
        ?>


  </div>
</div>
