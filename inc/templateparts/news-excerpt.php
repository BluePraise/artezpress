  
  <div class="news-item">
    <a href="<?php echo the_permalink() ?>" title="<?php the_title(); ?>" role="link">

      <div class="news-date-excerpt"><?php echo the_date("d F Y") ?></div>
      <?php if (has_post_thumbnail()) :
          $tn_id      = get_post_thumbnail_id($post->ID);
          $imgmeta    = wp_get_attachment_metadata($tn_id);


          if ($imgmeta['width'] < $imgmeta['height']) : ?>
              <figure class="news-thumbnail is-portrait" style="--var-aspect-ratio: <?= $imgmeta['width'] ?> / <?= $imgmeta['height'] ?>">
                  <?php the_post_thumbnail(); ?>
              </figure>
          <?php else : ?>
              <figure class="news-thumbnail is-landscape" style="--var-aspect-ratio: <?= $imgmeta['width'] ?> / <?= $imgmeta['height'] ?>">
                  <?php the_post_thumbnail(); ?>
              </figure>
          <?php endif; ?>
      <?php endif; ?>
      <h4 class="news-title news-title-excerpt"><?php the_title(); ?></h4>
      <?php if (have_rows('post_building_modules')) :
          while (have_rows('post_building_modules')) : the_row();

              if (get_row_layout() == 'news_content_module') :
                  $news_content      = get_sub_field('news_content');

                  if ($news_content) :
                      $start = strpos($news_content, '<p>'); // Locate the first paragraph tag
                      $end = strpos($news_content, '</p>', $start); // Locate the first paragraph closing tag
                      $news_content = substr($news_content, $start, $end - $start + 4); // Trim off everything after the closing paragraph tag
                      $news_content = str_replace(']]>', ']]>', $news_content);
                      $news_content = wp_trim_words( apply_filters('the_content', $news_content), 50 );

                      echo '<div class="news-item-excerpt">' . $news_content . '</div>';
                  endif;
              endif;
          endwhile;
      endif
      ?>

      <a class="news-read-more" href="<?php echo the_permalink() ?>" title="<?php the_title(); ?>" role="link"><?php _e('Read More', 'artezpress'); ?></a>

    </a>
  </div>
