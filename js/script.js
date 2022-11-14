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
     $('ul#shipping_method input').each(function () {
        var $this = $(this);
        if ($this.val().indexOf("wc_pickup_store") != -1  ) {
            if ($this.prop('checked')) {
                hideShippingFields();
            }
            if ($this.attr('type') == 'hidden') {
                hideShippingFields();
            }
        }
    });


    $(document).on('change', 'ul#shipping_method input', function () {
        var $this = $(this);
        if ($this.val().indexOf("wc_pickup_store") != -1) {
            hideShippingFields();
        } else {
            showShippingFields();
        }
    });
    function hideShippingFields() {
        var $col1 = $('.col-1');
        $('#ship-to-different-address-checkbox').prop('checked', false);
        $('.woocommerce-shipping-fields').find('.radio-toggle').css({ opacity: '0.4' });
        $('.woocommerce-shipping-fields').find('#ship-to-different-address-radio-no').attr('disabled', 'disabled');
        $('.woocommerce-shipping-fields').find('#ship-to-different-address-radio-yes').attr('disabled', 'disabled');
        $('.woocommerce-additional-fields').appendTo($col1);
        $('.shipping_address').hide();
        $col1.css({
            marginLeft: "auto",
            marginRight: "auto"
        });
    }

    function showShippingFields() {
        $col2 = $('.woocommerce-shipping-fields').closest('.col-2');
        var $col1 = $('.col-1');
        $('.woocommerce-additional-fields').appendTo($col2);
        $('.woocommerce-shipping-fields').find('.radio-toggle').css({ opacity: '1' });
        $('.woocommerce-shipping-fields').find('#ship-to-different-address-radio-no').removeAttr('disabled', '');
        $('.woocommerce-shipping-fields').find('#ship-to-different-address-radio-yes').removeAttr('disabled');
        $col1.css({
            marginLeft: "",
            marginRight: ""
        });
    }
    
    function getViewportOffset($e) {
        var $window = $(window),
          scrollLeft = $window.scrollLeft(),
          scrollTop = $window.scrollTop(),
          offset = $e.offset(),
          rect1 = { x1: scrollLeft, y1: scrollTop, x2: scrollLeft + $window.width(), y2: scrollTop + $window.height() },
          rect2 = { x1: offset.left, y1: offset.top, x2: offset.left + $e.width(), y2: offset.top + $e.height() };
        return {
          left: offset.left - scrollLeft,
          top: offset.top - scrollTop,
          insideViewport: rect1.x1 < rect2.x2 && rect1.x2 > rect2.x1 && rect1.y1 < rect2.y2 && rect1.y2 > rect2.y1
        };
      }
        

    var scroll = true;
    if($("#jump-to").length != 0) {
        var viewportOffset = getViewportOffset($("#jump-to"));
        //console.log("left: " + viewportOffset.left + ", top: " + viewportOffset.top + ", insideViewport: " + viewportOffset.insideViewport);

        var position = $(document).scrollTop();
        var startP = $(".hero").position();
        var finishP = $("#jump-to");
        if (viewportOffset.top > 0 && scroll == true) {
            scroll = false;
            setTimeout(function () {
                $('html,body').animate({ scrollTop: finishP.offset().top }, 400);
            }, 4000);
        } 
    }
    
    
    // ANIMATIONS
    $(".homepage").fadeIn(400);
    $(".mast-footer").fadeIn(400);
    $(".featured-section").fadeIn(400);
    $(".book-item-card").each(function (i) {
		$(this)
			.delay(150 * i)
			.fadeIn(250);
    });
    
    $(".hero h1 a").on("click", function (event) {
        
        if (this.hash !== "") {
            event.preventDefault();
            // Store hash
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 500, function () {
            });
        }
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
    var $soon_carousel = $(".coming-soon-carousel");    
    if ($(".coming-soon-carousel")) {
        $(".coming-soon-carousel").flickity({
            cellSelector: ".carousel-cell",
            imagesLoaded: true,
            autoPlay: 11000,
            fade: true,
            selectedAttraction: 1,
            friction: 1,
            prevNextButtons: false,
            pageDots: false,
            setGallerySize: false,
            on: {
                ready: function () {
                    var $nav = $soon_carousel.find(".slider-nav__link");
                    var $selected_slide = $soon_carousel.find(".is-selected");
                    
                    sUrl = $selected_slide.data("url");
                    $nav.attr("href", sUrl);
                }
            }
        });
    }
    var $newreleases_carousel = $(".new-releases-carousel");
    if ($(".new-releases-carousel")) {
        $(".new-releases-carousel").flickity({
            cellSelector: ".carousel-cell",
            imagesLoaded: true,
            lazyLoad: true,
            autoPlay: 9000,
            fade: true,
            selectedAttraction: 0.2,
            friction: 0.8,
            prevNextButtons: false,
            pageDots: false,
            setGallerySize: false,
            on: {
                ready: function () {
                    var $pagers = $(".new-releases-carousel").find(".slider-nav__pager");
                    var $nav = $newreleases_carousel.find(".slider-nav__link");
                    var $selected_slide = $newreleases_carousel.find(".is-selected");
                    var $slides = $(".new-releases-carousel").find('.carousel-cell');
                    
                    var sColor = $selected_slide.data("color"),
                        sUrl = $selected_slide.data("url");
                    
                    $newreleases_carousel.attr("data-color", sColor);
                    $nav.attr("href", sUrl);
                    
                    if ($slides.length > 1) {
                        // append a span to every nav pager.
                        for (i = 0; i < $slides.length; i++) {
                            $pagers.append("<span></span>");
                            $pagers.find('span:first-child').addClass('is-active');
                        }                    
                    }

                    $newreleases_carousel.on("select.flickity", function () {
                        var $pager = $pagers.find("span");
                        var $flkty = $(this).data('flickity');
                        
                        $pager.eq($flkty.selectedIndex).addClass("is-active");
                        // $pager.eq($flkty.prevSelectedIndex).removeClass('is-active');
                    });

                    $pagers.on('click', 'span', function() {
                        var index = $(this).index();
                        $(".new-releases-carousel").flickity('select', index);
                    });
                },
                change: function () {
                        
                    var $pagers = $(".new-releases-carousel").find(".slider-nav__pager");
                    var $nav = $newreleases_carousel.find(".slider-nav__link");
                    var $selected_slide = $newreleases_carousel.find(".is-selected");
                    
                    var sColor = $selected_slide.data("color"),
                        sUrl = $selected_slide.data("url");
                    
                    $newreleases_carousel.attr("data-color", sColor);
                    $nav.attr("href", sUrl);
                    
                    $newreleases_carousel.on("scroll.flickity", function () {
                        var $pager = $pagers.find("span");
                        var $flkty = $(this).data('flickity');
                            $pager.filter('.is-active').removeClass('is-active');
                            $pager.eq($flkty.selectedIndex).addClass("is-active");
                        }
                    );
                },
            },
        });
    }

    
    var $backlist_carousel = $(".backlist-carousel");
    if ($(".backlist-carousel")) {
        $(".backlist-carousel").flickity({
            cellSelector: ".carousel-cell",
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
                ready: function () {
                    var $backlist_pagers = $(".backlist-carousel").find(".slider-nav__pager");
                    var $backlist_nav = $backlist_carousel.find(".slider-nav__link");
                    var $selected_slide = $backlist_carousel.find(".is-selected");
                    
                    var sColor = $selected_slide.data("color"),
                        sUrl = $selected_slide.data("url");
                    
                    $backlist_carousel.attr("data-color", sColor);
                    $backlist_nav.attr("href", sUrl);
                    
                    // append a span to every nav pager.
                    for (i = 0; i < 3; i++) {
                        $backlist_pagers.append("<span></span>");
                    }
                    
                    $backlist_carousel.on("select.flickity", function () {
                        var $backlist_pager = $backlist_pagers.find("span");
                        var $flkty = $(this).data('flickity');
                        $backlist_pager.eq($flkty.selectedIndex).addClass("is-active");
                        // $backlist_pager.eq($flkty.prevSelectedIndex).removeClass('is-active');
                    });

                    $backlist_pagers.on('click', 'span', function() {
                        var index = $(this).index();
                        $(".backlist-carousel").flickity('select', index);
                    });
                },
                change: function () {
                        
                    var $backlist_pagers = $(".backlist-carousel").find(".slider-nav__pager");
                    var $backlist_nav = $backlist_carousel.find(".slider-nav__link");
                    var $selected_slide = $backlist_carousel.find(".is-selected");
                    
                    var sColor = $selected_slide.data("color"),
                        sUrl = $selected_slide.data("url");
                    
                    $backlist_carousel.attr("data-color", sColor);
                    $backlist_nav.attr("href", sUrl);
                    
                    $backlist_carousel.on("scroll.flickity", function () {
                        var $backlist_pager = $backlist_pagers.find("span");
                        var $flkty = $(this).data('flickity');
                            $backlist_pager.filter('.is-active').removeClass('is-active');
                            $backlist_pager.eq($flkty.selectedIndex).addClass("is-active");
                        }
                    );
                },
            },
        });
    }

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
