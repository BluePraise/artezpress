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

jQuery(document).ready(function($) {


	//checkout page shipping address toggle

    $(".radio-toggle .input-radio").change(function() {

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
            menuTimeout = setTimeout(function() {
                $("header.fixed-bottom").css("z-index", 0)
            }, 000);
        }
    }

    // cart Quantity JS

    if (!String.prototype.getDecimals) {
        String.prototype.getDecimals = function() {
            var num = this,
                match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            if (!match) {
                return 0;
            }
            return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        }
    }
    // Quantity "plus" and "minus" buttons
    $(document.body).on('click', '.plus, .minus', function() {
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
        .on("mouseenter", function() {
            if (!body.hasClass("menu-open")) {
                body.addClass("menu-open");
                main.addClass("blur");
								menubar.toggleClass("surface-open");
                menu.delay(0).fadeToggle(100, "swing");
            }
        })
        .on("click", function(event) {
            event.preventDefault();
            body.toggleClass("menu-open");
            main.toggleClass("blur");
						menubar.toggleClass("surface-open");
            menu.delay(0).fadeToggle(100, "swing");
        });

    $(".bg-overlay").on("mouseenter", function() {
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
            success: function(response) {
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
        acc[i].addEventListener("click", function() {
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

    $(".owl-carousel").owlCarousel({
        items: 1,
        slideBy: 2,
        loop: true,
        autoplay: true,
        dots: true,
        lazyLoad: true,
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



		// BOOK ARCHIVE SEARCH BAR
		// ------------------------

		// SEARCH BAR CONATINER

		var searchBar = $('.js-scroll-hide'),
				searchToggle = $('.js-search-toggle'),
				bookArchive = $('.js-products-container'),
				barHeight = $('.search-bar').height(),
				typedContainer = $(".js-fake-typewriter");


		// Get height of Search Bar and use as css variable for 'Book Archive' padding-top
		function getBarHeight() {
			bookArchive.get(0).style.setProperty("--bar-height", (barHeight) + 'px');
		}
		$(window).on("load resize",function(e){
			getBarHeight();
		});

		// when scrolling below the serach bar, hide and turn to fixed
		$(window).scroll(function(){
      if ($(this).scrollTop() > barHeight) {

				// Turn Bar to fixed position
				searchBar.fadeOut(100, function() {
			    $(this).addClass("is-fixed");
				});
				// Show the Search toggle
				searchToggle.fadeIn(100);
				// and stop typed
				typedContainer.addClass('is-paused');
				typed.stop();

      } else {

				// When scrolling back up remove the bar fixed position
				searchBar.fadeIn(0, function() {
			    $(this).removeClass("is-fixed");
				});
				// Hide the Search toggle
				searchToggle.fadeOut(100);
				// and stop typed
				typedContainer.removeClass('is-paused');
				typed.start();

      }
		});

		// Show bar on toggle click
		searchToggle.click(function() {
			$(this).fadeOut(100);
			searchBar.fadeIn(100);
		});


		// SEARCH FORM

		$(".js-main-search").on("submit", function(e) {
				e.preventDefault();
				var $this = $(this),
						search = $this.find("input[type=search]").val().toLowerCase();

				if (search) {
						productList.each(function() {
								var product = $(this);
								if (
										product.data("search").toLowerCase().indexOf(search) === -1
								) {
										product.hide();
								} else {
										product.show();
								}
						});
						if (!productList.is(":visible")) {
								$(".products__not-found").show();
						} else {
								$(".products__not-found").hide();
						}
				} else {
						if (!filters.length) {
								productList.show();
						}
				}
		});


		// TYPEWRITER IN SEARCH

		// Fake Typed: For more settings: https://github.com/mattboldt/typed.js
		var typed = new Typed(".js-fake-typewriter__input", {
				strings: [' a Book',
									'^250 an Author',
									'^250 for ‘Architecture’',
									'^250 for ‘Design’',
									'^250 ‘Performance Art’',
									'^250 ‘Fashion History’',
				],
				typeSpeed: 90,
				startDelay: 3000,
				backSpeed: 90,
				backDelay: 3000,
				smartBackspace: true,
				loop: true,
				showCursor: false,
		})

		// remvoe and stop Typed on click
		typedContainer.click(function(e) {
			$(this).addClass('is-paused');
			$('.js-real-input').focus();
			typed.stop();
		});

		// disable Typed on mobile
		$(window).bind("resize", function () {
			if ($(this).width() < 768) {
				typedContainer.addClass('is-paused');
				typed.stop();
			} else {
				typedContainer.removeClass('is-paused');
				typed.start();
			}
		}).trigger('resize');



		// BOOK ARCHIVE FILTERS HEADERS

		var filterSlider = $('.filter-list'),
		 		filterHeaderButtons = $('.filter-header');

		function flicitySlider() {
			//init flickity
			filterSlider.flickity({
				cellSelector: '.filter-list-item',
				cellAlign: 'left',
				pageDots: false,
				setGallerySize: false,
				freeScroll: true,
				groupCells: '80%',
				arrowShape: 'M66.97 100 16.97 50 66.97 0 72.69 5.72 28.41 50 72.69 94.28 66.97 100z',
			});
		}

		flicitySlider();


		//when filter headers buttons clicked
		filterHeaderButtons.on( 'click', function() {
			//use data-header attribute & class for filtering teh filterSlider
			var filterValue = $( this ).attr('data-header'),
			 		slide = filterSlider.find('.filter-list-item'),
					primeryFilters = filterSlider.find('.tags'),
					primeryHeader = $('.filter-header__tags');

			if (filterValue === 'reset') {
				// reset back to Tags
				primeryFilters.fadeIn(400).addClass('flickity');
				primeryHeader.addClass('active');

				// hide all other slides
				slide.not(primeryFilters).removeClass('flickity');
				slide.not(primeryFilters).hide();
				filterHeaderButtons.not(primeryHeader).removeClass('active');

			} else {
				//set active slide
				var active = $('.' + filterValue).fadeIn(400);
				// show only slide with the same class as the header button "attr('data-header)"
				slide.addClass('flickity');
				slide.not(active).removeClass('flickity');
				slide.not(active).hide();

				// remove active class from all buttons
				$('.filter-header').removeClass('active');

				// add active class to active header button
				$(this).addClass('active');
			}

			// destroy filterSlider and rebuild with new filters
			filterSlider.flickity('destroy');

			//rebuild filterSlider with new filter list
			flicitySlider();
		});


		// BOOK ARCHIVE FILTERS

		var productList = $(".product");
		var tags = [];
		var filters = [];

		$(".js-reset-filters").click(function(e) {
				filters = [];
				productList.show();

				// reset all selected filters
				$('.tag-pill').removeClass('active');
		});

		$(".js-filter-item").click(function (e) {
				e.preventDefault();
				var $this = $(this),
						$productsContainer = $(".products"),
						$filter = $this.data("filter");

				$this.toggleClass("active");
				if (filters.indexOf($filter) === -1) {
						filters.push($filter);
				} else {
						filters = filters.filter((f) => f !== $filter);
						productList.each(function() {
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
						productList.each(function() {
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



/* If the user clicks anywhere outside the select box,
then close all select boxes: */
// document.addEventListener("click", closeAllSelect);
// $(".js-filter-collapse").click(function(e) {
//     var $this = $(this)
//     var $activeElement = $(this).data("header");
//     var $otherFilterHeaders = $('.filter-header').siblings();
//
//     $otherFilterHeaders.removeClass('active');
//     $(this).addClass("active");
//
//     if ($activeElement == "categories") {
//         $('.filter-list__tags-item').hide();
//         $('.filter-list__categories-item').show();
//         $('.filter-list__years-item').hide();
//         $('.filter-list__language-item').hide();
//     }
//     if ($activeElement == "year") {
//         $('.filter-list__tags-item').hide();
//         $('.filter-list__categories-item').hide();
//         $('.filter-list__years-item').show();
//         $('.filter-list__language-item').hide();
//     }
//     if ($activeElement == "tags") {
//         $('.filter-list__tags-item').show();
//         $('.filter-list__categories-item').hide();
//         $('.filter-list__years-item').hide();
//         $('.filter-list__language-item').hide();
//     }
//     if ($activeElement == "language") {
//         $('.filter-list__tags-item').hide();
//         $('.filter-list__categories-item').hide();
//         $('.filter-list__years-item').hide();
//         $('.filter-list__language-item').show();
//     }
//
// });
//
// var productList = $(".product");
// var tags = [];
// var filters = [];
//
// $(".js-reset-filters").click(function(e) {
//     filters = [];
//     productList.show();
//
//     //show filter pills
//     $('.filter-list__tags').show();
//     //make sure other categories are hidden
//     $('.filter-list__categories').hide();
//     $('.filter-list__years').hide();
//     //make sure other filter items don't have active class
//     $(".js-filter-collapse").removeClass("active");
//     // reset back to tags filter header
//     $('.filter-header__tags').addClass('active');
//     $('.tag-pill').removeClass('active');
// });
//
// $(".js-filter-item").click(function (e) {
//     e.preventDefault();
//     var $this = $(this),
//         $productsContainer = $(".products"),
//         $filter = $this.data("filter"),
//         $filterTag = $this.data("tag"),
//         $filterCat = $this.data("category");
//
//     $this.toggleClass("active");
//     if (filters.indexOf($filter) === -1) {
//         filters.push($filter);
//     } else {
//         filters = filters.filter((f) => f !== $filter);
//         productList.each(function() {
//             if ($(this).data("filters").indexOf($filter) !== -1) {
//                 $(this).hide();
//             }
//         });
//         if (!filters.length) {
//             $(".js-reset-filters").click();
//         }
//         return;
//     }
//
//     if ($filter) {
//         productList.each(function() {
//             var $this = $(this);
//             if ($this.data("filters").indexOf($filter) === -1) {
//                 if (
//                     filters.every((i) => !$this.data("filters").includes(i))
//                 ) {
//                     $this.hide();
//                 }
//             } else {
//                 $this.show();
//             }
//         });
//     }
// });
//

// $(".js-main-search").on("submit", function(e) {
//     e.preventDefault();
//     var $this = $(this),
//         search = $this.find("input[type=search]").val().toLowerCase();
//
//     if (search) {
//         productList.each(function() {
//             var product = $(this);
//             if (
//                 product.data("search").toLowerCase().indexOf(search) === -1
//             ) {
//                 product.hide();
//             } else {
//                 product.show();
//             }
//         });
//         if (!productList.is(":visible")) {
//             $(".products__not-found").show();
//         } else {
//             $(".products__not-found").hide();
//         }
//     } else {
//         if (!filters.length) {
//             productList.show();
//         }
//     }
// });
//
// // For more settings: https://github.com/mattboldt/typed.js
// var typed = new Typed(".main-search__input", {
//     strings: ['Search for "Architecture"',
// 	            'Search by Category',
// 	            'Search by Year',
// 	            'Search a Title',
// 	            'Search Yellow',
//     ],
//     typeSpeed: 90,
// 		startDelay: 1000,
// 		backSpeed: 90,
// 		backDelay: 3000,
// 		loop: true,
// 		showCursor: true,
// 	  cursorChar: '|',
// 		autoInsertCss: true,
//     attr: 'placeholder',
//     bindInputFocusEvents: true,
// });
//
// $(window).on("scroll", function() {
//     var scroll = $(this).scrollTop();
//     var hideOnScroll = $(".js-hide-onscroll");
//
//     var showOnScroll = $(".js-show-onscroll");
//
//     if (scroll >= 20) {
//         hideOnScroll.removeClass("shown").addClass("hidden");
//         showOnScroll.removeClass("hidden").addClass("shown");
//     } else {
//         hideOnScroll.removeClass("hidden").addClass("shown");
//         showOnScroll.removeClass("shown").addClass("hidden");
//     }
// });
//
// $(".js-search-toggle").click(function() {
//     $(".js-hide-onscroll").removeClass("hidden").addClass("shown");
//     $(".js-show-onscroll").removeClass("shown").addClass("hidden");
// });
//


// var tagsContainer = document.querySelector(".js-tags-container"),
//     tags = document.querySelector(".js-filter-elements");

// var tagsProps = {
//     offset: 0,
//     atStart: true,
//     atEnd: false,
//     containerWidthDiff: tags.scrollWidth - tagsContainer.clientWidth,
// };
// // console.log(tagsProps.containerWidthDiff);
// if (tagsProps.containerWidthDiff <= 0) {
//     $(".js-tags-next").closest(".filter-tags__next").hide();
//     $(".js-tags-prev").closest(".filter-tags__prev").hide();
// } else {
//     function getOffset(offset) {
//         return Math.min(Math.max(offset, 0), tagsProps.containerWidthDiff);
//     }

//     function setButtonsState() {
//         tagsProps.atStart = 0 >= tagsProps.offset;
//         tagsProps.atEnd =
//             tagsProps.offset >= tagsProps.containerWidthDiff &&
//             !tagsProps.atStart;
//         tagsProps.offset = getOffset(tagsProps.offset);

//         $(".js-tags-next")
//             .closest(".filter-tags__next")
//             .css("display", "flex");
//         $(".js-tags-prev")
//             .closest(".filter-tags__prev")
//             .css("display", "flex");
//         if (tagsProps.atEnd) {
//             $(".js-tags-next").closest(".filter-tags__next").hide();
//             $(".js-tags-next")
//                 .closest(".filter-tags__prev")
//                 .css("display", "flex");
//         }
//         if (tagsProps.atStart) {
//             $(".js-tags-prev").closest(".filter-tags__prev").hide();
//             $(".js-tags-next")
//                 .closest(".filter-tags__next")
//                 .css("display", "flex");
//         }
//     }

//     setButtonsState();

//     $(".js-tags-prev").click(function() {
//         tagsProps.offset = getOffset(tagsProps.offset - 120);
//         $(".js-filter-elements").css(
//             "transform",
//             "translateX(-" + tagsProps.offset + "px)"
//         );
//         setButtonsState();
//     });
//     $(".js-tags-next").click(function() {
//         tagsProps.offset = getOffset(tagsProps.offset + 120);
//         $(".js-filter-elements").css(
//             "transform",
//             "translateX(-" + tagsProps.offset + "px)"
//         );
//         setButtonsState();
//     });
// }
