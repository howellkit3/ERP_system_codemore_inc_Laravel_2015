
    $("body").on('change','.category', function(e){

        var thisMe = $(this);
        var category = thisMe.parents('.item-category').find('.category').val();
            
        if(category == 0){

            
            thisMe.parents('.item-category').find('.other-items').hide();
            thisMe.parents('.item-category').find('.rolls').show();
            thisMe.parents('.item-category').find( ".other-element" ).prop( "disabled", true );
            thisMe.parents('.item-category').find( ".roll-element" ).prop( "disabled", false );

        }else{
            
            thisMe.parents('.item-category').find('.other-items').show();
            thisMe.parents('.item-category').find('.rolls').hide();
            thisMe.parents('.item-category').find( ".other-element" ).prop( "disabled", false );
            thisMe.parents('.item-category').find( ".roll-element" ).prop( "disabled", true );

        }

            
        });