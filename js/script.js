jQuery(document).ready(function($) {



    //checkout page shipping address toggle

    $('.radio-toggle .input-radio').change(function() {
        var curval = ($(this).val() === '0') ? true : false;
        $('#ship-to-different-address-checkbox').prop('checked', curval);
        $('#ship-to-different-address-checkbox').trigger('click');
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

    $(".js-toggle-menu")
        .on("mouseenter", function() {
            if (!body.hasClass("menu-open")) {
                body.addClass("menu-open");
                main.addClass("blur");
                menu.delay(0).fadeToggle(100, "swing");
            }
        })
        .on("click", function(event) {
            event.preventDefault();
            body.toggleClass("menu-open");
            main.toggleClass("blur");
            menu.delay(0).fadeToggle(100, "swing");
        });

    $(".bg-overlay").on("mouseenter", function() {
        if (body.hasClass("menu-open")) {
            artez_ajax_menu();
            body.removeClass("menu-open");
            main.toggleClass("blur");
            menu.delay(0).fadeToggle(100, "swing");
        }
    });

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
            error: function(e) {
                alert("Error on closing menu");
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
                }, 100);
            }
        });
    }

    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        dots: true,
        lazyLoad: true,
    });


    $(".wp-end-of-page").waypoint({
        // element: document.getElementById("basic-waypoint"),
        handler: function(direction) {
            console.log("client height");
            if (direction === "down") {
                $(".main-menu-container").css({ opacity: 0 });
            } else {
                $(".main-menu-container").css({ opacity: 1 });
            }
        },
        offset: "80%",
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

    $(".js-filter-collapse").click(function(e) {
        $(this).toggleClass("active");
    });

    var productList = $(".product");
    var tags = [];
    var filters = [];

    $(".js-reset-filters").click(function(e) {
        filters = [];
        productList.show();
        $(".js-filter-item").removeClass("active");
    });

    $(".js-filter-item").click(function(e) {
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

    $(window).on("scroll", function() {
        var scroll = $(this).scrollTop();
        var hideOnScroll = $(".js-hide-onscroll");

        var showOnScroll = $(".js-show-onscroll");

        if (scroll >= 20) {
            hideOnScroll.removeClass("shown").addClass("hidden");
            showOnScroll.removeClass("hidden").addClass("shown");
        } else {
            hideOnScroll.removeClass("hidden").addClass("shown");
            showOnScroll.removeClass("shown").addClass("hidden");
        }
    });

    $(".js-search-toggle").click(function() {
        $(".js-hide-onscroll").removeClass("hidden").addClass("shown");
        $(".js-show-onscroll").removeClass("shown").addClass("hidden");
    });

    var tagsContainer = document.querySelector(".js-tags-container"),
        tags = document.querySelector(".js-tags");

    var tagsProps = {
        offset: 0,
        atStart: true,
        atEnd: false,
        containerWidthDiff: tags.scrollWidth - tagsContainer.clientWidth,
    };

    if (tagsProps.containerWidthDiff <= 0) {
        $(".js-tags-next").closest(".filter-tags__next").hide();
        $(".js-tags-prev").closest(".filter-tags__prev").hide();
    } else {
        function getOffset(offset) {
            return Math.min(Math.max(offset, 0), tagsProps.containerWidthDiff);
        }

        function setButtonsState() {
            tagsProps.atStart = 0 >= tagsProps.offset;
            tagsProps.atEnd =
                tagsProps.offset >= tagsProps.containerWidthDiff &&
                !tagsProps.atStart;
            tagsProps.offset = getOffset(tagsProps.offset);

            $(".js-tags-next")
                .closest(".filter-tags__next")
                .css("display", "flex");
            $(".js-tags-prev")
                .closest(".filter-tags__prev")
                .css("display", "flex");
            if (tagsProps.atEnd) {
                $(".js-tags-next").closest(".filter-tags__next").hide();
                $(".js-tags-next")
                    .closest(".filter-tags__prev")
                    .css("display", "flex");
            }
            if (tagsProps.atStart) {
                $(".js-tags-prev").closest(".filter-tags__prev").hide();
                $(".js-tags-next")
                    .closest(".filter-tags__next")
                    .css("display", "flex");
            }
        }

        setButtonsState();

        $(".js-tags-prev").click(function() {
            tagsProps.offset = getOffset(tagsProps.offset - 320);
            $(".js-tags").css(
                "transform",
                "translateX(-" + tagsProps.offset + "px)"
            );
            setButtonsState();
        });
        $(".js-tags-next").click(function() {
            tagsProps.offset = getOffset(tagsProps.offset + 320);
            $(".js-tags").css(
                "transform",
                "translateX(-" + tagsProps.offset + "px)"
            );
            setButtonsState();
        });
    }



});