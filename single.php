<?php get_header(); ?>
<a class="go-back" href="<?php echo site_url("/news"); ?>" role="link">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32">
        <defs>
            <style>
                .cls-1 {
                    fill: none;
                }

                .cls-2 {
                    clip-path: url(#clip-path);
                }
            </style>
            <clipPath id="clip-path">
                <rect class="cls-1" width="32" height="32" />
            </clipPath>
        </defs>

        <g class="cls-2">
            <path d="M23.45,21.88l-1.57,1.57L16,17.57l-5.88,5.88L8.55,21.88,14.43,16,8.55,10.12l1.57-1.57L16,14.43l5.88-5.88,1.57,1.57L17.57,16ZM16,0A16,16,0,1,0,32,16,16,16,0,0,0,16,0" />
        </g>
    </svg>
</a>

<main id="site-content" class="container-xl single-news" role="main">

    <article class="container news-item__single">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('inc/templateparts/news', 'thumbnail'); ?>
                <div class="content-container">
                    <p class="news-date"><?php echo the_date("d F Y") ?></p>
                    <h3 class="news-title"><?php the_title(); ?></h3>
                </div>
                <div class="news-content__single">
                    <?php get_template_part('blocks/postbuilding/index'); ?>
                </div>
        <?php endwhile;
        endif; ?>
    </article>
</main>


<?php get_footer(); ?>