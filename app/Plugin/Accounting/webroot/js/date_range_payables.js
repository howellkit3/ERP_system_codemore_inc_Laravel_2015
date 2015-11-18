jQuery(function($){

    $("body").on('click','.dr', function(e){

        $('.appendreport').val(1);
        $(this).parent().find('.myDateRange').val('');

    });


    $("body").on('click','.clear-date', function(e){
        $(this).parent().find('.myDateRange').val('');
        //$('.myDateRange').prop('readonly', false);
        
        $('.dateRangeAppend-dr').hide();


        $('.dr-report').show();

        
    });

       $("body").on('change','.company-filter', function(e){

        company = $('.company-filter').val();

        var thisReport = ' ';
        var allReport = ' ';
        
        thisReport = 'dateRangeAppend-dr';
        allReport = 'dr-report';
        
        console.log(thisReport);
        $('.'+allReport).hide();
        $('.'+thisReport).show();
        //$('.myDateRange').prop('readonly', true);
        var dateRange = $('.myDateRange').val();

        var splitDate = dateRange.split('-');
       
        var a = splitDate[0].replace('/', '-');
        var b = splitDate[1].replace('/', '-');
        var c = a.replace('/', '-');
        var d = b.replace('/', '-');
        var from = c.replace(/\s+/g, '');
        var to = d.replace(/\s+/g, '');


        $.ajax({
            type: "GET",
            url: serverPath + "accounting/sales_invoice/company_filter_payables/"+from+"/"+to+"/"+company,
            dataType: "html",
            success: function(data) {

                if(data){
                    $('.dateRangeAppend-dr').html(data);
                } else{
                    $('.'+thisReport).html('<font color="red"><b>No result..</b></font>');
                }
               
                
            }
        });
        
    });



    $("body").on('click','.applyBtn', function(e){

        company = $('.company-filter').val(); 
        
        var thisReport = ' ';
        var allReport = ' ';
        
        thisReport = 'dateRangeAppend-dr';
        allReport = 'dr-report';
        
        console.log(thisReport);
        $('.'+allReport).hide();
        $('.'+thisReport).show();
        //$('.myDateRange').prop('readonly', true);
        var dateRange = $('.myDateRange').val();
        
        var splitDate = dateRange.split('-');
       
        var a = splitDate[0].replace('/', '-');
        var b = splitDate[1].replace('/', '-');
        var c = a.replace('/', '-');
        var d = b.replace('/', '-');
        var from = c.replace(/\s+/g, '');
        var to = d.replace(/\s+/g, '');
        
        $.ajax({
            type: "GET",
            url: serverPath + "accounting/sales_invoice/daterange_summary_payables/"+from+"/"+to,
            dataType: "html",
            success: function(data) {

                if(data){
                    $('.dateRangeAppend-dr').html(data);
                } else{
                    $('.'+thisReport).html('<font color="red"><b>No result..</b></font>');
                }
               
                
            }
        });

    });

});