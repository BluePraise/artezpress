
<div class="filter-tags">
	<div class="filter-tags__prev">
		<button class="js-tags-prev">
			<svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<polygon points="12 24 10.66 22.66 21.33 12 10.66 1.33 12 0 24 12 12 24" />
			</svg>
		</button>
	</div>

	<div class="filter-tags__inner js-tags-container">
		<div class="filter-list filter-tags__list js-filter-elements hide">
			<?php foreach ($terms as $term) : ?>
				<a href="<?= get_term_link($term->term_id, 'product_tag'); ?>" class="js-filter-item filter-tags__item tag-pill black-on-white" data-filter="product_tag-<?= $term->slug ?>" data-id="<?= $term->term_id ?>"><?= $term->name; ?></a>
			<?php endforeach; ?>
		</div>
        <div class="filter-list filter-cats__list js-filter-elements show">
            <?php foreach ($categories as $cat) : ?>
                <a href="" class="js-filter-item sidebar-filters__item tag-pill black-on-white" role="button" data-id="<?= $cat->term_id ?>" data-filter="product_cat-<?= $cat->slug ?>"><?= $cat->name ?></a>
            <?php endforeach; ?>
        </div>
        <div class="filter-list filter-year__list js-filter-elements hide" data>
            <?php foreach ($years as $year) : ?>
                <a class="js-filter-item sidebar-filters__item" href="" role="button" data-filter="year-<?= $year ?>"><?= $year ?></a>
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
