 function checkedPayroll(month,date,type) {

                  $.ajax({
                    type: "GET",
                    url: serverPath + "payroll/payrolls/checkExisting?month="+month+'&&date='+date+'&&type='+type,
                    dataType: "json",
                    success: function(data) {
                        
                        if (data != '') {
                        	$mode = $('.mode_type:checked');

                            $mode.attr('disabled','disabled').next().html($mode.data('key')  + ' <span class="label label-danger">Already Process </span> ');

                            $('.mode_type').attr('checked',true);

                        }  else {

                           $('.mode_type').each(function(){

                                $(this).attr('disabled',false);
                                $(this).next().text($(this).data('key'));
                           });

                            //  $('.mode_type').attr('disabled',false);

                        }
                    }
                });


}

 function getPayrollBy(month,status) {

 		$result = $('.result-cont');

 		$result.html('<img src="'+serverPath+'/img/loader.gif"/>');

		$.ajax({
            type: "GET",
            url: serverPath + "payroll/payrolls/getPayrollBy?month="+month+'&&status='+status,
            dataType: "html",
            success: function(data) {


            $result.html(data);  

            }
        });
}

$(document).ready(function(){


	$body = $('body');

	$body.on('click','#updatePayroll',function(e){

		var url = $(this).attr('href');

		//$(this).attr('href',url+'?days='+range+'&&month='+month);

		swal({   title: "Process Payroll",  
		 text: "This will update employee payroll information. Click OK to continue",  
		 type: "info", 
		 showCancelButton: true,   
		 closeOnConfirm: false,   
		 showLoaderOnConfirm: true, },
		 function() {  
		 		//$(this).attr('href',url+'?days='+range+'&&month='+month);
				window.location.href = 	url;
					
				var alert = $(".sweet-alert");

				var cancelButton = alert.find('.cancel');

				cancelButton.trigger("click");
		  });


		e.preventDefault();
	});


	$(".monthpick").datepicker( {
		format: "mm-yyyy",
		startView: "months", 
		minViewMode: "months"
	});


$('.mode_type').click(function(){

    if ($('#PayrollDate').val() != '') {

            var description = 'Payroll for: ';

            $('#PayrollDescription').val(description + $(this).val() + ' ' + $('#PayrollMonthYear').val() );

			var type = $('#PayrollType').val();

			var month = $('#PayrollMonthYear').val();

			var date = $(this).val();

			checkedPayroll(month,date,type)
    }

});

$('#PayrollMonthYear').change(function(){

    var month = $(this).val();

    var date = $('.mode_type:checked').val();

    var type = $('#PayrollType').val();

    checkedPayroll(month,date,type)

}).trigger('change');

$('#PayrollPayrollCreateForm').submit(function(e){

	$error = $('span.label-danger').length;

	if ($error == 0) {

		return true;

	}

	e.preventDefault();
});


$('#MonthPayrollIndex').change(function(){

	var month = $(this).val();

	var status = $('#StatusPayrollIndex').val();

	getPayrollBy(month,status);

});


$('#StatusPayrollIndex').change(function(){

	var status = $(this).val();

	var month = $('#MonthPayrollIndex').val();

	getPayrollBy(month,status);

});

$body.on('click','#item_type_pagination_ajax a', function(e) {
	
	var getUrl = $(this).attr('href');

	 $result.html('<img src="'+serverPath+'/img/loader.gif"/>');

	 $.ajax({
      url:getUrl,
      type: "GET",
      success:function(result){

         $result.html(result);
      }
    });

	 e.preventDefault();
});

$('#MonthPayrollIndex').change(function(){
		$('.datepicker-dropdown').remove();

	});


});