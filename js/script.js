jQuery(document).ready(function ($) {
	// Menu button

	const body = $("body"),
				main = $("main"),
				menu = $('.js-menu');

	$(".js-toggle-menu")
		.on("mouseenter", function () {
			if (!body.hasClass("menu-open")) {
				body.addClass("menu-open");
				main.addClass("blur");
				menu.delay(0).fadeToggle(100, "swing");
			}
		})
		.on("click", function (event) {
			event.preventDefault();
			body.toggleClass("menu-open");
			main.toggleClass("blur");
			menu.delay(0).fadeToggle(100, "swing");
		});

	$(".bg-overlay").on("mouseenter", function () {
		if (body.hasClass("menu-open")) {
			body.removeClass("menu-open");
			main.toggleClass("blur");
			menu.delay(0).fadeToggle(100, "swing");
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
		offset: "95%",
	});

	//https://stackoverflow.com/questions/11867545/change-text-color-based-on-brightness-of-the-covered-background-area

	function closeAllSelect(elmnt) {
		/* A function that will close all select boxes in the document,
  except the current select box: */
		var x,
			y,
			i,
			xl,
			yl,
			arrNo = [];
		x = document.getElementsByClassName("select-items");
		y = document.getElementsByClassName("select-selected");
		xl = x.length;
		yl = y.length;
		for (i = 0; i < yl; i++) {
			if (elmnt == y[i]) {
				arrNo.push(i);
			} else {
				y[i].classList.remove("select-arrow-active");
			}
		}
		for (i = 0; i < xl; i++) {
			if (arrNo.indexOf(i)) {
				x[i].classList.add("select-hide");
			}
		}
	}

	/* If the user clicks anywhere outside the select box,
then close all select boxes: */
	document.addEventListener("click", closeAllSelect);

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
					if (
						filters.every((i) => !$this.data("filters").includes(i))
					) {
						$this.hide();
					}
				} else {
					$this.show();
				}
			});
		}
	});
});

// Define the PHP function to call from here
// Update Mini Cart

//  var data = {
//    'action': 'mode_theme_update_mini_cart'
//  };
//  $.post(
//    woocommerce_params.ajax_url, // The AJAX URL
//    data, // Send our PHP function
//    function(response){
//      $('#mode-mini-cart').html(response); // Repopulate the specific element with the new content
//    }
//  );
// Close anon function.