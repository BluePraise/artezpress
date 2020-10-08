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

	$(".grid").masonry({
		// options
		itemSelector: ".news-item",
		columnWidth: 520,
		gutter: 32,
	});

});
