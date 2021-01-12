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
    if ($(".icons").hasClass("plus")) {
      $(this).addClass("test");
    } else {
      this.removeClass("minus");
      this.addClass("plus");
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

  var productList = $(".product");
  var tags = [];
  var filters = [];

  $(".js-filter-item").click(function (e) {
    e.preventDefault();
    var $this = $(this),
      $productsContainer = $(".products"),
      $filter = $this.data("filter"),
      $filterTag = $this.data("tag");

    if ($filterTag) {
      tags.push($filterTag);
      productList.each(function () {
        var $this = $(this);
        var prodTags = $this.data("tags") || "";
        if (prodTags.indexOf($filterTag) === -1) {
          if (tags.every((i) => !prodTags.includes(i))) {
            $this.hide();
          }
        } else {
          $this.show();
        }
      });
      $productsContainer.find(".product:visible").each(function () {
        var prod = $(this);
        // filters.push();
        // if (tags.every((i) => !prodTags.includes(i))) {
        // }
        $(".js-filter-item").each(function () {
          var filter = $(this),
            dataFilter = filter.data("filter"),
            prodCat = prod.data("category"),
            prodYear = prod.data("year"),
            prodAuthor = prod.data("author");

          console.log(filter, dataFilter);

          if (
            (dataFilter && prodCat && prodCat.indexOf(dataFilter) === -1) ||
            (dataFilter &&
              prodYear &&
              String(prodYear).indexOf(dataFilter) === -1) ||
            (dataFilter && prodAuthor && prodAuthor.indexOf(dataFilter) === -1)
          ) {
            filter.closest("li").hide();
          } else {
            filter.closest("li").show();
          }
        });
      });
    } else if ($filter) {
      productList.each(function () {
        var $this = $(this);
        if ($this.data("year").indexOf($filter) === -1) {
          $this.hide();
        }
      });
    } else if ($filter) {
      productList.each(function () {
        var $this = $(this);
        if ($this.data("category").indexOf($filter) === -1) {
          $this.hide();
        }
      });
    } else if ($filter) {
      productList.each(function () {
        var $this = $(this);
        if ($this.data("author").indexOf($filter) === -1) {
          $this.hide();
        }
      });
    }
  });
});
