jQuery(document).ready(function ($) {
		
	// Menu button
	const body = $("body");
	$(".js-toggle-menu").on("mouseenter", function () {
		if (!body.hasClass("menu-open")) {
			body.addClass("menu-open");
		}
	}).on("click", function (event) {
		event.preventDefault();
		if (body.hasClass("menu-open")) {
			// Hide menu
			body.removeClass("menu-open");
		} else {
			// Show menu
			body.addClass("menu-open");
		}
	})

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
		collapsible: true,
		header: "button",
		heightStyle: "content",
		animate: 200
	});

	var icons = $('.icons');

	$(".accordion-toggle")
		.on("click", function () {
			if ($(".accordion-toggle").hasClass("ui-state-active")) {
				icons.removeClass('minus');
				icons.addClass("plus");
			} else {
				icons.removeClass("plus");
				icons.addClass("minus");
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
		offset: "80%"
	});
	
	//https://stackoverflow.com/questions/11867545/change-text-color-based-on-brightness-of-the-covered-background-area


});
