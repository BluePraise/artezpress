jQuery(document).ready(function ($) {
  // Menu button
  const body = $("body");
  $(".js-toggle-menu")
    .on("mouseenter", function () {
      if (!body.hasClass("menu-open")) {
        body.addClass("menu-open");
      }
    })
    .on("click", function (event) {
      event.preventDefault();
      if (body.hasClass("menu-open")) {
        // Hide menu
        body.removeClass("menu-open");
      } else {
        // Show menu
        body.addClass("menu-open");
      }
    });

  $(".bg-overlay").on("click", function () {
    if (body.hasClass("menu-open")) {
      // Hide menu
      body.removeClass("menu-open");
    } else {
      // Show menu
      body.addClass("menu-open");
    }
  });

  $(".js-toggle-accordion").accordion({
    active: 0,
    collapsible: true,
    header: "button",
    heightStyle: "content",
    animate: 200,
  });

  var icons = $(".icons");
  console.log(icons);

  $(".accordion-toggle").on("click", function () {
    // find the current icons class.
    var thi$ = $(this).find(".icons");
    //if this span has a plus icon
    if (thi$.hasClass("plus")) {
      // add another class
      thi$.addClass("minus");
      // and remove the plus class
      thi$.removeClass("plus");
      // $(this).removeClass("plus");
    } else {
      thi$.removeClass("minus");
      thi$.addClass("plus");
    }
  });

  $(".owl-carousel").owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    dots: true,
    lazyLoad: true,
  });

  $(".grid").masonry({
    // options
    itemSelector: ".news-item",
    columnWidth: 520,
    gutter: 32,
  });

  $(".wp-end-of-page").waypoint({
    // element: document.getElementById("basic-waypoint"),
    handler: function (direction) {
      console.log("client height");
      if (direction === "down") {
        $(".main-menu-container").css({ opacity: 0 });
      } else {
        $(".main-menu-container").css({ opacity: 1 });
      }
    },
    offset: "80%",
  });

  //https://stackoverflow.com/questions/11867545/change-text-color-based-on-brightness-of-the-covered-background-area

  $(".js-filter-collapse").click(function (e) {
    $(this).toggleClass("active");
  });

  var productList = $(".product");
  var tags = [];
  var filters = [];

  $(".js-reset-filters").click(function (e) {
    filters = [];
    productList.show();
    $(".js-filter-item").removeClass("active");
  });

  $(".js-filter-item").click(function (e) {
    e.preventDefault();
    var $this = $(this),
      $productsContainer = $(".products"),
      $filter = $this.data("filter"),
      $filterTag = $this.data("tag");

    $this.toggleClass("active");
    if (filters.indexOf($filter) === -1) {
      filters.push($filter);
    } else {
      filters = filters.filter((f) => f !== $filter);
      productList.each(function () {
        if ($(this).data("filters").indexOf($filter) !== -1) {
          $(this).hide();
        }
      });
      if (!filters.length) {
        $(".js-reset-filters").click();
      }
      return;
    }

    if ($filter) {
      productList.each(function () {
        var $this = $(this);
        if ($this.data("filters").indexOf($filter) === -1) {
          if (filters.every((i) => !$this.data("filters").includes(i))) {
            $this.hide();
          }
        } else {
          $this.show();
        }
      });
    }
  });

  $(".js-main-search").on("submit", function (e) {
    e.preventDefault();
    var $this = $(this),
      search = $this.find("input[type=search]").val().toLowerCase();

    if (search) {
      productList.each(function () {
        var product = $(this);
        if (product.data("search").toLowerCase().indexOf(search) === -1) {
          product.hide();
        } else {
          product.show();
        }
      });
      if (!productList.is(":visible")) {
        $(".products__not-found").show();
      } else {
        $(".products__not-found").hide();
      }
    } else {
      if (!filters.length) {
        productList.show();
      }
    }
  });

  $(window).on("scroll", function () {
    var scroll = $(this).scrollTop();
    var hideOnScroll = $(".js-hide-onscroll");
    var showOnScroll = $(".js-show-onscroll");

    if (scroll >= 10) {
      hideOnScroll.removeClass("shown").addClass("hidden");
      showOnScroll.removeClass("hidden").addClass("shown");
    } else {
      hideOnScroll.removeClass("hidden").addClass("shown");
      showOnScroll.removeClass("shown").addClass("hidden");
    }
  });

  $(".js-search-toggle").click(function () {
    $(".js-hide-onscroll").removeClass("hidden").addClass("shown");
    $(".js-show-onscroll").removeClass("shown").addClass("hidden");
  });
});
