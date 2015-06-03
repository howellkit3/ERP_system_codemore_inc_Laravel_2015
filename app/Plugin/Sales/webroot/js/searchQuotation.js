$(document).ready(function() {

   	$("body").on('keyup','.searchQuotation', function(e){
        var searchInput = $(this).val();
        if(searchInput){
            $.ajax({
                type: "GET",
                url: serverPath + "sales/quotations/searchQuotation/"+searchInput,
                dataType: "html",
                success: function(data) {
                   
                    if(data){
                        $('.searchAppend').html(data); 
                    }else{
                        $('.searchAppend').html('<font color="red"><b>No result..</b></font>'); 
                    }
                    
                }
            });

        }
        
    });
});