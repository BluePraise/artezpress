jQuery(document).ready(function($) {


    acf.addAction('acfe/fields/button/complete/name=process_image', function(response, $el, data) {

        var image_url = jQuery(".upload_image .acf-image-uploader.has-value input").val();

        jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'extract_colors',
                    image_url: image_url,
                },
                success: function(response) {

                    jQuery('.image_color_swa').show();
                    jQuery('.image_color_swa tbody tr').remove();
                    jQuery.each(response.data, function(key, val) {
                        jQuery('.image_color_swa tbody').append("<tr><td class=\"select_code\" data-ccode=\"#" + key + "\" style=\"background-color:#" + key + ";\"></td><td>" + key + "</td></tr>");

                    })
                    $('.select_code').click(function() {
                        var selected_code = $(this).data("ccode");
                        jQuery("#artz-custom-color input.wp-color-picker").val(selected_code);
                        jQuery("#artz-custom-color input.wp-color-picker").trigger("change");

                    });

                },
                error: function(response, error) {
                    alert('error:' + error + ' response:' + response);
                }
        });

    });


    $('#artz-bw input').click(function() {
        var selected_code = $(this).val();
        console.log(selected_code);
        jQuery("#artz-custom-color input.wp-color-picker").val(selected_code);
        jQuery("#artz-custom-color input.wp-color-picker").trigger("change");

    });
});