jQuery(document).ready(function($){


	$('.select_type').change(function(){

			var data_change = $(this).data('change');

			if ($(this).val() == 'others'){
				$('.'+data_change).addClass('visible'); 
			} else {
				$('.'+data_change).removeClass('visible'); 
			}
	}).trigger('change');


	//datepicker
	$('.datepick').datepicker({
	format: 'mm-dd-yyyy'
	});

	$('#datepickerDateComponent').datepicker();

	//daterange picker
	$('#datepickerDateRange').daterangepicker();


});