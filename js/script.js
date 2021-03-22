// --VH variable

// First we get the viewport height and multiple it by 1% to get a value for a vh unit
let vh = window.visualViewport.height * 0.01;
// Set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);


jQuery(window).on("load", function () {
	var $ = jQuery;
	var $container = $(".news-grid-masonry");
	// initialize Masonry after all images have loaded
	$container.imagesLoaded(function () {
		$container.masonry({
			itemSelector: ".news-item",
		});
	});
});

jQuery(document).ready(function ($) {
    // ANIMATIONS
    $(".book-item-card").each(function (i) {
		$(this)
			.delay(150 * i)
			.fadeIn(250);
	});


    //checkout page shipping address toggle

    $(".radio-toggle .input-radio").change(function () {

        var curval = $(this).val() === "0" ? true : false;

        $("#ship-to-different-address-checkbox").prop("checked", curval);
        $("#ship-to-different-address-checkbox").trigger("click");
        $(".shipping_address").toggle("fast");

    });


    // cart Quantity JS

    if (!String.prototype.getDecimals) {
        String.prototype.getDecimals = function () {
            var num = this,
                match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            if (!match) {
                return 0;
            }
            return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        }
    }

    // Quantity "plus" and "minus" buttons
    $(document.body).on('click', '.plus, .minus', function () {
        console.log('1');
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {
            if (max && (currentVal >= max)) {
                $qty.val(max);
            } else {
                $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
            }
        } else {
            if (min && (currentVal <= min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
            }
        }

        // Trigger change event
        $qty.trigger('change');
    });

    // Menu button
    const body = $("body"),
        	main = $("main"),
        	menu = $(".js-menu");
    			menubar = $(".js-menubar");

    $(".js-toggle-menu")
        .on("mouseenter", function () {
            if (!body.hasClass("menu-open")) {
                body.addClass("menu-open");
                main.addClass("blur");
                menubar.toggleClass("surface-open");
                menu.delay(0).fadeToggle(100, "swing");
            }
        })
        .on("click", function (event) {
            event.preventDefault();
            body.toggleClass("menu-open");
            main.toggleClass("blur");
            menubar.toggleClass("surface-open");
            menu.delay(0).fadeToggle(100, "swing");
        });

    $(".bg-overlay").on("mouseenter", function () {
        if (body.hasClass("menu-open")) {
            artez_ajax_menu();
            body.removeClass("menu-open");
            main.toggleClass("blur");
            menubar.toggleClass("surface-open");
            menu.delay(0).fadeToggle(100, "swing");
        }
    });

		// mobile menu X button
		$(".js-close-menu").on("click", function () {
          body.removeClass("menu-open");
          main.removeClass("blur");
          menubar.toggleClass("surface-open");
          menu.delay(0).fadeToggle(100, "swing");
    });

    // Mobile menu
    $(window).bind("resize", function () {
        if ($(this).width() < 1025) {
            menubar.addClass('mobile-menu-bar')
        } else {
            menubar.removeClass('mobile-menu-bar')
        }
    }).trigger('resize');


    function artez_ajax_menu() {
        jQuery.ajax({
            type: "POST",
            url: artez_object.ajax_url,
            data: {
                action: "artez_random_bg",
                nonce: artez_object.nonce,
            },
            success: function (response) {
                // console.log(response);
                jQuery(".bg-overlay").css(
                    "background-image",
                    "url(" + response + ")"
                );
            },
        });
    }


    // END OF Language Menu Toggle

    // ACCORDION TOGGLE
    var acc = document.getElementsByClassName("accordion-toggle");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            var panelP = panel.firstElementChild;
            if (panel.style.height) {
                panelP.style.height = null;
                panel.style.height = null;
                panel.classList.toggle("open");
            } else {
                panel.style.height = panelP.scrollHeight + 64 + "px";
                panelP.style.height = panelP.clientHeight + "px";
                setTimeout(() => {
                    panel.classList.toggle("open");
                }, 0);
            }
        });
    }


    // FOR FRONTPAGE CAROUSEL

		// I set up each of the sliders as a var, then I can control each one of them individually
		var target = $('.coming-soon-carousel').flickity({
			cellSelector: '.carousel-cell',
			imagesLoaded: true,
			autoPlay: 11000,
			fade: true,
			selectedAttraction: 1,
      friction: 1,
			prevNextButtons: false,
			pageDots: false,
			setGallerySize: false,
    });

		var target = $('.new-releases-carousel').flickity({
			cellSelector: '.carousel-cell',
 			imagesLoaded: true,
 			autoPlay: 9000,
 			fade: true,
 			selectedAttraction: 0.2,
 			friction: 0.8,
 			prevNextButtons: false,
 			pageDots: false,
			setGallerySize: false,
     });

    var target = $('.backlist-carousel').flickity({
      cellSelector: '.carousel-cell',
			imagesLoaded: true,
			lazyLoad: true,
			autoPlay: 7000,
			fade: true,
			selectedAttraction: 0.2,
			friction: 0.8,
			prevNextButtons: false,
			pageDots: false,
			adaptiveHeight: true,
			on: {
        ready: function() {
					startData();
        },
        change: function() {
					changeData();
        }
      }
    });

		// For slider load
		// Get data-color and data-url from the active slide and copy them to the slider parent
		// in this case with "each"... don't knwo why :/
		function startData() {
			$('.carousel-container').each(function(i, container) {
				var target = $(container).find('.highlights-carousel'),
						nav = target.find('.slider-nav__link'),
						s = target.find('.is-selected'),
						sColor = s.data("color"),
						sUrl = s.data("url");

				target.attr( "data-color", sColor );
				nav.attr("href", (sUrl));

			});
		};

		// For slide change
		// Get data-color and data-url from the active slide and copy them to the slider parent
		// in this case counting on the fact all the sliders are defined as "var target"... Again, don't knwo why :/
		function changeData() {
			var nav = target.find('.slider-nav__link'),
					s = target.find('.is-selected'),
					sColor = s.data("color"),
					sUrl = s.data("url");

			target.attr( "data-color", sColor );
			nav.attr("href", (sUrl));
		};


		// Custom Highlights Nav Pager
		// I can't get all the sliders to add active class t othe first bullet on load (works on chnage, but on load aonly in Backlist)
		$('.carousel-container').each(function(i, container) {
		  var $container = $(container);
		  var $slider = $container.find('.highlights-carousel');
		  var flkty = $slider.data('flickity');
		  var selectedIndex = flkty.selectedIndex;

		  var slideCount = flkty.slides.length;

		  var $pagers = $container.find('.slider-nav__pager');

		  for (i = 0; i < slideCount; i++) {
		    $pagers.append('<span></span>');
		  }

		  var $pager = $pagers.find('span');

		  $slider.on('select.flickity', function() {

		    $pager.filter('.is-active').removeClass('is-active');
		    $pager.eq(flkty.selectedIndex).addClass('is-active');

		  });

		  $pagers.on('click', 'span', function() {
		    var index = $(this).index();
		    $slider.flickity('select', index);
		  });

		});


		// $carouselBacklist.on( 'change.flickity', function( event, index ) {
		//   console.log( 'Flickity change ' + index );
		// });

    // // if one slide add class so display none.
    // $highlightcarousel.on( 'resize', function() {
    //     var isSingleSlide = flkty.slides.length < 2;
    //     $highlightcarousel.toggleClass('is-single-slide', isSingleSlide);
    // });


    // var flkty = $backlist.data('flickity');
    // $backlistTitle = $('.backlist').find('.slider-title');
    // //get current color from slider-item-meta
    // //apply value to slider-title.
		//
    // $backlist.on('scroll.flickity', function () {
    //     let selectedSlideColor = $(flkty.selectedElement).data('textcolor');
    //     //get current color from slider-item-meta
    //     //apply value to slider-title.
    //     $backlistTitle.css('color', selectedSlideColor );
    // });









    $(".news-grid-masonry").masonry({
        // options
        itemSelector: ".news-item",
        percentPosition: true,
        horizontalOrder: true,
        // gutter: 32
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
});
(function ($) {
	"use strict";

	/**
	 * To Title Case 2.1 – http://individed.com/code/to-title-case/
	 * Copyright © 2008–2013 David Gouch. Licensed under the MIT License.
	 *
	 * @returns {string}
	 */
	String.prototype.toTitleCase = function () {
		var smallWords = /^(a|that|is|on|van|have|an|and|as|at|but|by|en|for|if|in|nor|of|on|or|per|the|with|to|vs?\.?|via)$/i;

		return this.replace(
			/[A-Za-z0-9\u00C0-\u00FF]+[^\s-]*/g,
			function (match, index, title) {
				if (
					index > 0 &&
					index + match.length !== title.length &&
					match.search(smallWords) > -1 &&
					title.charAt(index - 2) !== ":" &&
					(title.charAt(index + match.length) !== "-" ||
						title.charAt(index - 1) === "-") &&
					title.charAt(index - 1).search(/[^\s-]/) < 0
				) {
					return match.toLowerCase();
				}

				if (match.substr(1).search(/[A-Z]|\../) > -1) {
					return match;
				}

				return match.charAt(0).toUpperCase() + match.substr(1);
			}
		);
	};
    if ($('.lang-en') && $('.English') && !$('.Nederlands')) {
        $("h1, h2, h3, h4, h5").each(
            function () {
                var heading_string = $(this).html().toString();

                var heading_case = heading_string.toTitleCase();

                $(this).html(heading_case);
        });
    }
})(jQuery);
