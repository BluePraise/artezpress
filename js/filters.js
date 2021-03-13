jQuery(document).ready(function($) {    
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

    setTimeout(function () {
        flicitySlider();
    }, 400);
    
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