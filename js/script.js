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


    //checkout page shipping address toggle

    $(".radio-toggle .input-radio").change(function () {

        var curval = $(this).val() === "0" ? true : false;

        $("#ship-to-different-address-checkbox").prop("checked", curval);
        $("#ship-to-different-address-checkbox").trigger("click");
        $(".shipping_address").toggle("fast");

    });


    // header menu overlap menu fix

    var head_menu = $('header.fixed-bottom');
    var menuTimeout = null;

    // $(window).on('mousemove', mouseMoveHandler);

    function mouseMoveHandler(e) {
        if (e.pageX < 20 || head_menu.is(':hover')) {
            // Show the menu if mouse is within 20 pixels
            // from the left or we are hovering over it
            // console.log('fire 1');
            clearTimeout(menuTimeout);
            menuTimeout = null;
            $("header.fixed-bottom").css("z-index", 2);
        } else if (menuTimeout === null) {
            // Hide the menu if the mouse is further than 20 pixels
            // from the left and it is not hovering over the menu
            // and we aren't already scheduled to hide it
            // console.log('fire 2');
            menuTimeout = setTimeout(function () {
                $("header.fixed-bottom").css("z-index", 0)
            }, 000);
        }
    }

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
    $comingsoon  = $('.coming-soon-carousel');
    $newreleases = $('.new-releases-carousel');
    $backlist    = $('.backlist-carousel');
    $highlightcarousel    = $('.highlight-carousel');

    $comingsoon.flickity({
        cellSelector: '.slider-item',
        setGallerySize: true,
        resize: true,
        imagesLoaded: true,
        wrapAround: false,
        // watchCSS: true,
        // fade: true,
        freeScroll: true,
        contain: true,
        draggable: false,
        prevNextButtons: false,
        pageDots: true
    });

     $newreleases.flickity({
        cellSelector: '.slider-item',
        setGallerySize: true,
        resize: true,
        // wrapAround: false,
        watchCSS: true,
        // fade: true,
        // freeScroll: true,
        // contain: true,
        // draggable: false,
        // prevNextButtons: false,
        pageDots: true
     });
    $backlist.flickity({
        cellSelector: '.slider-item',
        autoPlay: true,
        setGallerySize: true,
        resize: true,
        wrapAround: false,
        fade: true,
        freeScroll: true,
        contain: true,
        draggable: true,
        on: {
            ready: function () {
            }
        }
    });
    // // if one slide add class so display none.
    // $highlightcarousel.on( 'resize', function() {
    //     var isSingleSlide = flkty.slides.length < 2;
    //     $highlightcarousel.toggleClass('is-single-slide', isSingleSlide);
    // });
    
    
    var flkty = $backlist.data('flickity');
    $backlistTitle = $('.backlist').find('.slider-title');
    //get current color from slider-item-meta
    //apply value to slider-title.

    $backlist.on('scroll.flickity', function () {
        let selectedSlideColor = $(flkty.selectedElement).data('textcolor');
        //get current color from slider-item-meta
        //apply value to slider-title.
        $backlistTitle.css('color', selectedSlideColor );
    });
    


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
