<?php if (get_row_layout() == 'content_in_two_columns'): ?>
    <div class="page-default grid-container">
        <div class="content__left">
            <?php the_sub_field('content_to_the_left'); ?>
        </div>
        <div class="content__right">
            <?php the_sub_field('content_to_the_right'); ?>
        </div>
    </div>
<?php endif; ?>