<div class="filter-list fade-in">
	<?php foreach ($terms as $term) : ?>
		<div class="filter-list-item tags flickity fade-in">
			<a href="<?= get_term_link($term->term_id, 'product_tag'); ?>" class="tag-pill black-on-white js-filter-item" data-id="<?= $term->term_id ?>" data-filter="product_tag-<?= $term->slug ?>"><?=  _e($term->name); ?></a>
		</div>
	<?php endforeach; ?>

  <?php foreach ($categories as $cat) : ?>
		<div class="filter-list-item filter-list__categories-item categories" style="display:none;">
      <a href="" class="tag-pill black-on-white js-filter-item" role="button" data-id="<?= $cat->term_id ?>" data-filter="product_cat-<?= $cat->slug ?>"><?= _e($cat->name); ?></a>
		</div>
  <?php endforeach; ?>

  <?php foreach ($years as $year) : ?>
		<div class="filter-list-item filter-list__years-item year" style="display:none;">
      <a href="" class="tag-pill black-on-white js-filter-item" role="button" data-id="<?= $year ?>" data-filter="year-<?= $year ?>"><?= $year ?></a>
		</div>
  <?php endforeach; ?>

  <?php foreach ($languages as $lang) : ?>
		<div class="filter-list-item filter-list__language-item languages" style="display:none;">
        <a href="" class="tag-pill black-on-white js-filter-item" role="button" data-id="<?= $lang ?>" data-filter="booklang-<?= $lang ?>"><?= _e($lang); ?></a>
		</div>
  <?php endforeach; ?>
</div>
