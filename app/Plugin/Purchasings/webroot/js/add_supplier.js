jQuery(document).ready(function($){


	$('.select_type').change(function(){

			var data_change = $(this).data('change');

			if ($(this).val() == 'Others'){
				$('.'+data_change).addClass('visible'); 
			} else {
				$('.'+data_change).removeClass('visible'); 
			}
	}).trigger('change');


	//datepicker
	$('.datepick').datepicker({
		format: 'yyyy-mm-dd'
	});
	
});