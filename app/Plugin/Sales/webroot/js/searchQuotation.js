$(document).ready(function() {


    function searchQuotation(searchInput) {

    $this = $('.searchQuotation');

    $container = $('#quotation-table');

    var searchInput = $('.searchQuotation').val();
    
      if(searchInput){
            $('.quotationFields').hide();
            $('.searchAppend').show();
        }else{
            $('.quotationFields').show();
            $('.searchAppend').hide();
        }


    $container.html('<img src="'+serverPath+'/img/loader.gif"/>');

    $.ajax({
        type: "GET",
        url: serverPath + "sales/quotations/search_quotation/"+searchInput,
        dataType: "html",
        success: function(data) {

            console.lo
            if(data){

                $container.html(data);
                
            } 
            if (data.length < 5 ) {

                 $container.html('<font color="red"><b>No result..</b></font>');
                 
            }
            
        }
    });
}

var timeout;

$('.searchQuotation').keypress(function() {


    if(timeout) {
        clearTimeout(timeout);
        timeout = null;
    }

    timeout = setTimeout(searchQuotation,500)
})




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
             
            $('.field').hide();
            $('.searchProductAppend').show();
        }else{
            $('.field').show();
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