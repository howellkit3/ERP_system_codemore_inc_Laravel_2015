jQuery(function($) {
    $("#CompanyInquiryFormForm").validate({
        
        submitHandler: function (form) {
        var formURL = $("#CompanyInquiryFormForm").attr("action");
         $.ajax({
             type: "POST",
             url: formURL,
             dataType: "html",
             data: $(form).serialize(),
             success: function (data) {
                $( "input[name='data[Company][id]']" ).val( data );
                $('.btn.btn-primary.mrg-b-lg').text('Customer Info Added');
                $(form).html("<div id='message'></div>");
                $('#message').html("<h2>Customer Information Complete.</h2>")
                     .append("<p></p>")
                     .hide()
                     .fadeIn(1500, function () {
                     $('#message').append("<div></div>");
                 });


             },
            
         });
         return false; 
        }

    });
});
