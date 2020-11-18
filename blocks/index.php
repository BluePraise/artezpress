<?php
if (have_rows('building_blocks')) :
    while (have_rows('building_blocks')) : the_row();
        get_template_part('blocks/toggle');
        get_template_part('blocks/content');
        get_template_part('blocks/sectiontitle');
    endwhile;
endif;
?>
