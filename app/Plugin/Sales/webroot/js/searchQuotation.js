$(document).ready(function() {

   	$("body").on('keyup','.searchQuotation', function(e){
        var searchInput = $(this).val();

        if(searchInput){
            $('.quotationFields').hide();
            $('.searchAppend').show();
        }else{
            $('.quotationFields').show();
            $('.searchAppend').hide();
        }
        
        
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

    //search customer list
    $("body").on('keyup','.searchCustomer', function(e){
        var searchInput = $(this).val();
        //console.log(searchInput);
        if(searchInput){
            $('.customerFields').hide();
            $('.searchAppend').show();
        }else{
            $('.customerFields').show();
            $('.searchAppend').hide();
        }
        
        $.ajax({
            type: "GET",
            url: serverPath + "sales/customer_sales/search_customer/"+searchInput,
            dataType: "html",
            success: function(data) {
                console.log(data);
                if(data){

                    $('.searchAppend').html(data);
                    

                } 
                if (data.length < 5 ) {

                    $('.searchAppend').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });

    });

        $("body").on('keyup','.searchProduct', function(e){
        var searchInput = $(this).val();

        if(searchInput){
           // alert(searchInput);
            $('.productFields').hide();
            $('.searchProductAppend').show();
        }else{
            $('.productFields').show();
            $('.searchProductAppend').hide();
        }
        
        
        $.ajax({
            type: "GET",
            url: serverPath + "sales/products/search_product/"+searchInput,
            dataType: "html",
            success: function(data) {

                if(data){

                    $('.searchProductAppend').html(data);
                    

                } 
                if (data.length < 5 ) {

                    $('.searchProductAppend').html('<font color="red"><b>No result..</b></font>');
                     
                }
                
            }
        });

    });
});