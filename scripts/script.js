jQuery(document).ready(function ($) {
    $('.logo').hover(function () {
        if ($(".main-menu-surface").hasClass('show')) {
			$(".main-menu-surface").removeClass('show');
		} else {
			$(".main-menu-surface").addClass("show");
		}
    });
});