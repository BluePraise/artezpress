<?php $terms = get_terms(array('taxonomy' => 'product_tag')); ?>
<div class="filter-tags">
	<div class="filter-tags__prev">
		<button class="js-tags-prev">
			<svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<polygon points="12 24 10.66 22.66 21.33 12 10.66 1.33 12 0 24 12 12 24" />
			</svg>
		</button>
	</div>

	<div class="filter-tags__inner js-tags-container">
		<div class="filter-tags__list js-tags">
			<?php foreach ($terms as $term) : ?>
				<a href="<?= get_term_link($term->term_id, 'product_tag'); ?>" class="js-filter-item filter-tags__item" data-filter="product_tag-<?= $term->slug ?>" data-id="<?= $term->term_id ?>"><?= $term->name; ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="filter-tags__next">
		<button class="js-tags-next">
			<svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<polygon points="12 24 10.66 22.66 21.33 12 10.66 1.33 12 0 24 12 12 24" />
			</svg>
		</button>
	</div>
</div>