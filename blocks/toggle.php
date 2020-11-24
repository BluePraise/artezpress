<?php 
if (get_row_layout() == 'layout_block_toggle'): ?>
    <div class="js-toggle-accordion">
        <?php if( have_rows('block_toggle') ): 
                while( have_rows('block_toggle') ): the_row(); 
                $title = get_sub_field('toggle_title');
                $toggle_content = get_sub_field('toggle_content'); ?>
                <button class="accordion-toggle">
                    <p><?php echo $title; ?></p>
                </button>
                <div class="panel">
                    <?php echo $toggle_content; ?>
                </div>
            
        <?php endwhile; endif;?>
    </div>
<?php endif; ?>
