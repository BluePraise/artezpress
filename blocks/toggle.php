<?php 
if (get_row_layout() == 'layout_block_toggle'): ?>
    <div class="accordion-container">
        <?php if( have_rows('block_toggle') ): 
                while( have_rows('block_toggle') ): the_row(); 
                $title = get_sub_field('toggle_title');
                $toggle_content = get_sub_field('toggle_content'); ?>
                <div class="accordion-content-container">
                    <button class="accordion-toggle">
                    <p><span class="icons"></span><?php echo $title; ?></p>
                    </button>
                    <div class="panel">
                        <?php echo $toggle_content; ?>
                    </div>
                </div>
        <?php endwhile; endif;?>
    </div>
<?php endif; ?>
