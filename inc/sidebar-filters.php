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
$categories = get_terms(['taxonomy' => 'product_cat']);
?>
<aside class="sidebar-filters">
  <h3 class="js-reset-filters sidebar-filters__title">All books</h3>
  <ul>
    <li class="sidebar-filters__name js-filter-collapse">Categories</li>
    <?php foreach ($categories as $cat) : ?>
      <li><a href="" class="js-filter-item sidebar-filters__item" role="button" data-id="<?= $cat->term_id ?>" data-filter="product_cat-<?= $cat->slug ?>"><?= $cat->name ?></a></li>
    <?php endforeach; ?>
  </ul>
  <ul>
    <li class="sidebar-filters__name js-filter-collapse">Years</li>
    <?php foreach ($years as $year) : ?>
      <li><a class="js-filter-item sidebar-filters__item" href="" role="button" data-filter="year-<?= $year ?>"><?= $year ?></a></li>
    <?php endforeach; ?>
  </ul>
  <ul>
    <li class="sidebar-filters__name js-filter-collapse">Authors</li>
    <?php foreach ($authors as $author) : $author = trim($author) ?>
      <li><a href="" class="js-filter-item sidebar-filters__item" role="button" data-filter="<?= $author ?>"><?= $author ?></a></li>
    <?php endforeach; ?>
  </ul>
</aside>