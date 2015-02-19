jQuery(function($) {
    $('.multi-field-wrapper').each(function() {
   		 var $wrapper = $('.multi-fields', this);
	    $(".add-field", $(this)).click(function(e) {
	        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
	    });
	    $('.multi-field .remove-field', $wrapper).click(function() {
	            $(this).parents('.multi-field').remove();
	    });
    });

    $("li.current,li.disabled").wrapInner("<a href='#'></a>")
});