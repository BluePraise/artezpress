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

	// Accordion Toggle
	var icons = {
		header: "ui-icon-plus",
		activeHeader: "ui-icon-minus",
	};
	// var toggleButton = $('.accordion-toggle');

	$(".js-toggle-accordion").accordion({
		icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" },
		collapsible: true,
		header: "button",
		icons: icons,
		heightStyle: "content",
		animate: 200
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
	
	//https://stackoverflow.com/questions/11867545/change-text-color-based-on-brightness-of-the-covered-background-area


});
