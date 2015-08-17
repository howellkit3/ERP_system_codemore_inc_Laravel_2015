
$(document).ready(function(){

	$body = $('body');

	$(".monthpick").datepicker( {
		format: "mm-yyyy",
		startView: "months", 
		minViewMode: "months"
	});


	$('#changeDate').change(function(){

		$('#result-table').empty();
		$('.datepicker-dropdown').remove();

	});

	$('.radio.inline-block').click(function(){

		$('#result-table').empty();

	});

	$body.on('click','#exportData',function(e){

		var url = $(this).attr('href');

		var month = $('#changeDate').val();

		var range = $('.radio.inline-block input:checked').val();

		$(this).attr('href',url+'?days='+range+'&&month='+month);

		//e.preventDefault();
	});

	$body.on('click','#GeneratePayslip',function(e){

		var url = $(this).attr('href');

		var month = $('#changeDate').val();

		var range = $('.radio.inline-block input:checked').val();

		$(this).attr('href',url+'?days='+range+'&&month='+month);

		//e.preventDefault();
	});

	$body.on('submit','#AttendanceComputeSalariesForm',function(e){

		$result_table = $('#result-table');

		$result_table.html('<img src="'+serverPath+'/img/loader.gif"/>');

		$.ajax({
	        type: "POST",
	        url: serverPath + "human_resource/salaries/compute_salaries/",
	        data : $('#AttendanceComputeSalariesForm').serialize(),
	        dataType: "html",
	        success: function(data) {

	        	setTimeout(function(){

	        	$result_table.html(data);
	        	
	        	$('#exportData').attr('style','display:block');

	        	$('#GeneratePayslip').removeClass('hide')
	        	},1000);

	        }
	    });


			e.preventDefault();

	});

	

	

});