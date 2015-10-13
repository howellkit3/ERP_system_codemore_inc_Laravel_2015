$(document).ready(function() {
    
    var wrapper         = $("#sortable");

    $("body").on('click','.add_panel_button', function(e){

    	var thisMe = $(this);

        var counter = parseInt($(this).attr('data'));

        var varCounter = counter + 1;

        $(this).attr('data',parseInt(varCounter));

        var realName = "data[ProductSpecificationMainPanel][][name]";
    	//call main-spec-category
        $.ajax({ 
            type: "GET", 
            url: serverPath + "sales/products/get_main/"+counter+"/"+realName, 
            dataType: "html", 
            success: function(mainDataField){ 
                
                $(wrapper).append(mainDataField); 
                $('.main'+counter).focus();

            } 
            
        });
            
    	e.preventDefault();

    });

});