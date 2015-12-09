jQuery(function($){

    $("body").on('click','.dr', function(e){

        $('.appendreport').val(1);
        $(this).parent().find('.myDateRange').val('');

    });

    $("body").on('click','.clear-date', function(e){
        $(this).parent().find('.myDateRange').val('');
        $(this).parent().find('.product-filter').val('');
        $(this).parent().find('.company-filter').val('');
        //$('.myDateRange').prop('readonly', false);
        
        $('.dateRangeAppend-dr').hide();

        $('.dr-report').show();
  
    }); 

    $("body").on('change','.product-filter', function(e){

        product = $('.product-filter').val();

        company = $('.company-filter').val();

        $('.company-filter').val('');

        var thisReport = ' ';

        var allReport = ' ';
        
        thisReport = 'dateRangeAppend-dr';
        allReport = 'dr-report';
        
        console.log(thisReport);
        $('.'+allReport).hide();
        $('.'+thisReport).show();
        //$('.myDateRange').prop('readonly', true);
        var dateRange = $('.myDateRange').val();

        if(dateRange){

        var splitDate = dateRange.split('-');
       
        var a = splitDate[0].replace('/', '-');
        var b = splitDate[1].replace('/', '-');
        var c = a.replace('/', '-');
        var d = b.replace('/', '-');
        var from = c.replace(/\s+/g, '');
        var to = d.replace(/\s+/g, '');

        }

        if(from == null){
        
            from = "undefined"
        }

        if(to == null){
        
            to = "undefined"
        }

        if(company){
        }else{
        
            company = "undefined"
        }

        $.ajax({
            type: "GET",
            url: serverPath + "delivery/deliveries/daterange_summary/"+from+"/"+to+"/"+product+"/"+company,
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

    $("body").on('change','.company-filter', function(e){

        product = $('.product-filter').val();

        company = $('.company-filter').val();

        $('.product-filter').val('');

        var thisReport = ' ';

        var allReport = ' ';
        
        thisReport = 'dateRangeAppend-dr';
        allReport = 'dr-report';
        
        console.log(thisReport);
        $('.'+allReport).hide();
        $('.'+thisReport).show();
        //$('.myDateRange').prop('readonly', true);
        var dateRange = $('.myDateRange').val();

        //console.log(dateRange);

        if(dateRange){

        var splitDate = dateRange.split('-');
       
        var a = splitDate[0].replace('/', '-');
        var b = splitDate[1].replace('/', '-');
        var c = a.replace('/', '-');
        var d = b.replace('/', '-');
        var from = c.replace(/\s+/g, '');
        var to = d.replace(/\s+/g, '');

        }

        if(from == null){
        
            from = "undefined"
        }

        if(to == null){
        
            to = "undefined"
        }

        if(product){
        }else{
        
            product = "undefined"
        }

        $.ajax({
            type: "GET",
            url: serverPath + "delivery/deliveries/daterange_summary/"+from+"/"+to+"/"+product+"/"+company,
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

        product = $('.product-filter').val();

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

        //alert(company);

        if(company){
        }else{
        
            company = "undefined"
        }

        if(product){
        }else{
        
            product = "undefined"
        }

        //lert(company); 
        
        $.ajax({
            type: "GET",
            url: serverPath + "delivery/deliveries/daterange_summary/"+from+"/"+to+"/"+product+"/"+company,
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