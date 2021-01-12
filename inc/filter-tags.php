<?php $terms = get_terms(array('taxonomy' => 'product_tag')); ?>
<div class="filter-tags">
	<?php foreach ($terms as $term) : ?>
		<a href="<?= get_term_link($term->term_id, 'product_tag'); ?>" class="js-filter-item filter-tags__item" data-filter="product_tag-<?= $term->slug ?>" data-id="<?= $term->term_id ?>"><?= $term->name; ?></a>
	<?php endforeach; ?>
</div>