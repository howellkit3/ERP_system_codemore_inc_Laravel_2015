$('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    $(".add-field", $(this)).click(function(e) {
    	 no++;
        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
        $(this).parent().before($("#phone_number_form").clone().attr("id","phone_number_form" + phone_number_form_index));
       	// var i = $("#multi").find("select").length;
       
    });

    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parents('.multi-field').remove();
    });
});

// $(".add-field"). click(function(){
// 	var $wrapper = $('.multi-fields', this);
//    $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
//         var last = $('.multi-field:last');
//         var current =  $(".multi-field").length - 1;
//         //last.append(new_button.clone(true));
//         last.find('input').val([]);
//         last.find('input.item_type').attr("name", "company_address" + current);
//         last.find('select.select_custom').attr("name", "items[" + current + "][standard]");
//         last.find(".custom_products").css("display","none");
//         last.find(".unit_selection").css("display","none");
//         last.find(".landscape_selection").css("display","none");
//         last.find(".veneer_selection").css("display","none");
//         last.find(".comments_section").css("display","none");
//         last.find(".standard").css('display','none');
//     });

