$(document).ready(function() {

   	$("body").on('keyup','.searchQuotation', function(e){
        var searchInput = $(this).val();
        
        $.ajax({
            type: "GET",
            url: serverPath + "sales/quotations/search_quotation/"+searchInput,
            dataType: "html",
            success: function(data) {
            	
                if(data){

                	$('.searchAppend').html(data);
                    

                } 
                if (data.length < 5 ) {

                	$('.searchAppend').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });

    });
});