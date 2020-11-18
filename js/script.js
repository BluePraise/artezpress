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
	})
	// toggleButton.on("click", function () {
	// 	$(".js-toggle-accordion").accordion("option", {
	// 		icons: icons,
	// 		header: "button",
	// 		icons: icons,
	// 		heightStyle: "content",
	// 		animate: 200,
	// 	});
    // });
    

	$(".grid").masonry({
		// options
		itemSelector: ".news-item",
		columnWidth: 520,
		gutter: 32,
	});


});
