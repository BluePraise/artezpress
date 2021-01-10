<aside class="sidebar-filters">
  <h3>All books</h3>
  <button>+Categories</button>
	<?php $categories = get_terms(['taxonomy' => 'product_cat']); ?>
  <ul>
	  <?php foreach ($categories as $cat) : ?>
        <li><button role="button" data-id="<?= $cat->term_id ?>" data-slug="<?= $cat->slug ?>"><?= $cat->name ?></button></li>
	  <?php endforeach; ?>
  </ul>
</aside>
