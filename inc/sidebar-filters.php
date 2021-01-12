<?php
$authors = [];
$years = [];

while (have_posts()) {
  the_post();
  global $product;
  if (strlen(get_field('author'))) {
    $authors[] = explode(',', get_field('author'));
  }
  if (strlen(get_field('publishing_year'))) {
    $years[] = (int)get_field('publishing_year');
  }
}
sort($years, SORT_NUMERIC);
$authors = array_unique(array_flatten($authors), SORT_REGULAR);
$years = array_reverse(array_unique($years, SORT_NUMERIC));
?>
<aside class="sidebar-filters">
  <h3>All books</h3>
  <button>+ Categories</button>
  <?php $categories = get_terms(['taxonomy' => 'product_cat']); ?>
  <ul>
    <?php foreach ($categories as $cat) : ?>
      <li><a href="" class="js-filter-item" role="button" data-id="<?= $cat->term_id ?>" data-filter="<?= $cat->slug ?>"><?= $cat->name ?></a></li>
    <?php endforeach; ?>
  </ul>
  <button>+ Years</button>
  <ul class="js-filter-years">
    <?php foreach ($years as $year) : ?>
      <li><a class="js-filter-item" href="" role="button" data-filter="<?= $year ?>"><?= $year ?></a></li>
    <?php endforeach; ?>
  </ul>
  <button>+ Authors</button>
  <ul class="js-filter-authors">
    <?php foreach ($authors as $author) : ?>
      <li><a href="" class="js-filter-item" role="button" data-filter="<?= $author ?>"><?= $author ?></a></li>
    <?php endforeach; ?>
  </ul>
</aside>