
<div class="carousel-container new-releases">
  <div class="highlights-carousel new-releases-carousel">

    <div class="slider-overlay">
      <div class="slider-title"><?php _e('New Releases', 'artezpress'); ?></div>

      <div class="slider-nav grid">
        <div class="slider-nav__pager"></div>
        <a class="slider-nav__link" href=""><?php _e('Read More', 'artezpress'); ?></a>
      </div>
    </div>

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
                        $text_color = get_field('text_color', $b);
                    endforeach;
                endif;
                $img        = get_sub_field('add_custom_image');
                // print_r($img);     
                // $img        = get_post_thumbnail_id($b);
                $imgmeta    = wp_get_attachment_metadata($img);
        ?>

        <div class="carousel-cell carousel-cell-highlights" style="background-image: url(<?php echo $img; ?>)" data-color="<?= $text_color; ?>"  data-url="<?= $permalink; ?>">
          <div class="carousel-cell__title"><?= $title; ?></div>
       </div>

    <?php
        endwhile;
        endif;
    ?>
  </div>
</div>
