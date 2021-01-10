<?php $terms = get_terms(array('taxonomy' => 'product_tag')); ?>
<div class="filter-tags">
	<?php foreach ( $terms as $term ) : ?>
		<a href="<?= get_term_link( $term->term_id, 'product_tag' ); ?>" class="js-filter-tag" data-slug="<?= $term->slug ?>" data-id="<?= $term->term_id ?>">
			<?= $term->name; ?>
		</a>
	<?php endforeach; ?>
</div>
