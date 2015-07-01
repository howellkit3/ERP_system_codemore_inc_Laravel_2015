jQuery(function($){

    $("body").on('click','.dr', function(e){

        $('.appendreport').val(1);
        $(this).parent().find('.myDateRange').val('');

    });
    $("body").on('click','.php', function(e){
        
        $('.appendreport').val(2);
        $(this).parent().find('.myDateRange').val('');

    });

    $("body").on('click','.usd', function(e){
        
        $('.appendreport').val(3);
        $(this).parent().find('.myDateRange').val('');

    });

    $("body").on('click','.term', function(e){
        
        $('.appendreport').val(4);
        $(this).parent().find('.myDateRange').val('');

    });

    $("body").on('click','.clear-date', function(e){
        $(this).parent().find('.myDateRange').val('');
        //$('.myDateRange').prop('readonly', false);
        
        $('.dateRangeAppend-dr').hide();
        $('.dateRangeAppend-php').hide();
        $('.dateRangeAppend-usd').hide();
        $('.dateRangeAppend-term').hide();

        $('.dr-report').show();
        $('.php-report').show();
        $('.usd-report').show();
        $('.term-report').show();
        
        
    });

    $("body").on('click','.applyBtn', function(e){
        var whatReport = $(this).parents('body').find('.appendreport').val();
        var thisReport = ' ';
        var allReport = ' ';
        if (whatReport == 1) {
            thisReport = 'dateRangeAppend-dr';
            allReport = 'dr-report';
        }
        if (whatReport == 2) {
            thisReport = 'dateRangeAppend-php';
            allReport = 'php-report';
        }
        if (whatReport == 3) {
            thisReport = 'dateRangeAppend-usd';
            allReport = 'usd-report';
        }
        if (whatReport == 4) {
            thisReport = 'dateRangeAppend-term';
            allReport = 'term-report';
        }
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
            url: serverPath + "accounting/sales_invoice/daterange_summary/"+from+"/"+to+"/"+whatReport,
            dataType: "html",
            success: function(data) {

                if(data){
                    $('.'+thisReport).html(data);
                } else{
                    $('.'+thisReport).html('<font color="red"><b>No result..</b></font>');
                }
               
                
            }
        });

    });

});