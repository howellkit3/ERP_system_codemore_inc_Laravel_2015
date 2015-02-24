jQuery(function($){

    $('#select_company').change(function(){

        var option = $(this).val();
        
        $.ajax({
        url: serverPath + "ware_house/request_stocks/find_data/"+option,
        type: "get",
        dataType: "json",
        success: function(data) {
            if (data.length == 0){
                $('#address1').val('');
                $('#contact').val('');  
                $('#email').val('');    
                $('#type').val('');  
                $('#operation').val('');   
            }else{
                $('#address1').val(data.Product[0].name);
                $('#email').val(data.Email[0].email);
                 $('#type').val(data.Organization.type);
                  $('#operation').val(data.Organization.operation_type);
            }
        }
        })
            
    });

});