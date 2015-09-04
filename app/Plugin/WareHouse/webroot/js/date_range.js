jQuery(function($){

    $("body").on('click','.applyBtn', function(e){
        var whatReport = $(this).parents('body').find('.appendreport').val();
        var thisReport = ' ';
        var allReport = ' ';
       
         $('.summaryReport').hide();
         $('.dateRangeAppend').show();

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
            url: serverPath + "ware_house/warehouse_requests/out_record_report/"+from+"/"+to,
            dataType: "html",
            success: function(data) {

                if(data){
                    $('.dateRangeAppend').html(data);
                } else{
                    $('.dateRangeAppend').html('<font color="red"><b>No result..</b></font>');
                }
               
                
            }
        });

    });

});