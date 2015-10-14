
    $("body").on('change','.category', function(e){

        var thisMe = $(this);
        var category = thisMe.parents('.form-horizontal').find('.category').val();

        
        if(category == 0){

            
            thisMe.parents('.form-horizontal').find('.other-items').hide();
            thisMe.parents('.form-horizontal').find('.rolls').show();
            thisMe.parents('.form-horizontal').find( ".other-element" ).prop( "disabled", true );
            thisMe.parents('.form-horizontal').find( ".roll-element" ).prop( "disabled", false );

        }else{
            
            thisMe.parents('.form-horizontal').find('.other-items').show();
            thisMe.parents('.form-horizontal').find('.rolls').hide();
            thisMe.parents('.form-horizontal').find( ".other-element" ).prop( "disabled", false );
            thisMe.parents('.form-horizontal').find( ".roll-element" ).prop( "disabled", true );

        }

            
        });