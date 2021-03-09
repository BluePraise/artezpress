<?php
$authors = [];
$years = [];

while (have_posts()) : the_post();
  global $product;
  if (strlen(get_field('author'))) {
    $authors[] = explode(',', get_field('author'));
  }
  if (get_field('ap_language')) {
    $languages[] = get_field('ap_language');
  }
  if (strlen(get_field('publishing_year'))) {
    $years[] = (int)get_field('publishing_year');
  }
endwhile;
sort($years, SORT_NUMERIC);
$terms = get_terms(array('taxonomy' => 'product_tag'));
//$authors = array_unique(array_flatten($authors), SORT_REGULAR);
$years = array_reverse(array_unique($years, SORT_NUMERIC));
$categories = get_terms(['taxonomy' => 'product_cat']);
$languages = array_unique($languages);
?>

<button class="search-bar__toggle js-search-toggle" type="button" style="display: none;">
  <div class="search-bar__toggle-icon">
    <svg width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
    <path d="M25 22.57l-6.11-6.11a10.43 10.43 0 10-2.43 2.43L22.57 25zM3.33 10.42a7.09 7.09 0 117.09 7.08 7.1 7.1 0 01-7.09-7.08z" />
    </svg>
  </div>
  <span>Search</span>
</button>

<div class="search-bar js-scroll-hide">
  <div class="search-bar__inner container-l ">

    <section class="search-section">
      <div class="search-section__inner">

        <form class="main-search js-main-search">
          <button class="main-search__submit">
            <svg class="main-search__submit-attachment" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
            <path d="M25 22.57l-6.11-6.11a10.43 10.43 0 10-2.43 2.43L22.57 25zM3.33 10.42a7.09 7.09 0 117.09 7.08 7.1 7.1 0 01-7.09-7.08z" />
            </svg>
          </button>
          <input type="search" class="main-search__input js-real-input" name="" placeholder="Search">
        </form>

        <form class="main-search fake-typewriter js-fake-typewriter">
          <button class="main-search__submit">
            <svg class="main-search__submit-attachment" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25">
            <path d="M25 22.57l-6.11-6.11a10.43 10.43 0 10-2.43 2.43L22.57 25zM3.33 10.42a7.09 7.09 0 117.09 7.08 7.1 7.1 0 01-7.09-7.08z" />
            </svg>
          </button>
          <div class="main-search__input">
            <span class="fake-typewriter__input">Search</span>
            <span class="fake-typewriter__input js-fake-typewriter__input"></span>
          </div>
        </form>

      </div>
    </section>

    <section class="filter-section">
      <div class="filter-headers-container">
        <div class="filter-header filter-header__tags active" data-header="tags"><?php _e('Theme', 'artezpress'); ?></div>
        <div class="filter-header filter-header__categories" data-header="categories"><?= _e('Category', 'artezpress'); ?></div>
        <div class="filter-header filter-header__year" data-header="year"><?= _e('Year', 'artezpress') ?></div>
        <div class="filter-header filter-header__language" data-header="languages"><?php _e('Language', 'artezpress') ?></div>
        <div class="filter-header filter-header__reset js-reset-filters" data-header="reset"><?= _e('Clear', 'artezpress'); ?></div>
      </div>

      <?php include get_theme_file_path('/inc/filter-tags.php'); ?>
    </section>

  </div>
</div>
