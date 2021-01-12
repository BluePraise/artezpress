jQuery(document).ready(function ($) {
    let tags = [];

    $(".js-filter-tag").click(function(event) {
        // Prevent defualt action - opening tag page
        event.preventDefault();

        let selectedTaxonomy = $(this).data("slug");
        if (tags.indexOf(selectedTaxonomy) !== -1) {
            tags = tags.filter(function(i) {
                return i !== selectedTaxonomy;
            });
        } else {
            tags.push(selectedTaxonomy);
        }

        let data = {
            action: "filter_posts", // function to execute
            afp_nonce: afp_vars.afp_nonce, // wp_nonce
            taxonomy: JSON.stringify(tags),
        };

        $.post({
            url: afp_vars.afp_ajax_url,
            data: data,
            beforeSend: function() {
                $(".js-loading-container").addClass("loading");
            },
            success: function(response) {
                if (response) {
                    $(".js-products-container").html(response);
                    $(".js-loading-container").removeClass("loading");

                    $('.js-filter-authors').html($('.hidden-filter-authors').html());
                    $('.js-filter-years').html($('.hidden-filter-years').html());
                }
            },
        });
    });
})
