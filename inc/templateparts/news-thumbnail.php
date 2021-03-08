<?php if( has_post_thumbnail() ):
    $tn_id      = get_post_thumbnail_id( $post->ID );
    $imgmeta    = wp_get_attachment_metadata( $tn_id );


    if ($imgmeta['width'] < $imgmeta['height']): ?>
        <figure class="news-thumbnail is-portrait" style="--var-aspect-ratio: <?= $imgmeta['width'] ?> / <?= $imgmeta['height'] ?>">
            <?php the_post_thumbnail(); ?>
        </figure>
    <?php else: ?>
        <figure class="news-thumbnail is-landscape" style="--var-aspect-ratio: <?= $imgmeta['width'] ?> / <?= $imgmeta['height'] ?>">
            <?php the_post_thumbnail(); ?>
        </figure>
<?php endif; endif; ?>
