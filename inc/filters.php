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
<div class="search-bar">
      
        <form class="flex-container main-search js-main-search">
        <button>
            <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
            <path d="M25 22.57l-6.11-6.11a10.43 10.43 0 10-2.43 2.43L22.57 25zM3.33 10.42a7.09 7.09 0 117.09 7.08 7.1 7.1 0 01-7.09-7.08z" />
            </svg>
        </button>
        <input type="search" class="js-main-search main-search__input" name="" id="" placeholder="">
        </form>
        <div class="filter-section">
          <div class="filter-item active">Tags</div>
          <div class="filter-item">Category</div>
          <div class="filter-item">Year</div>
          <div class="filter-item">Language</div>
        <div class="filter-item">All Books</div>
      <?php include get_theme_file_path('/inc/filter-tags.php'); ?>
    </div>
</div>