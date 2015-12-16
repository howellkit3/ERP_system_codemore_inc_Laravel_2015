$(document).ready(function(){

	$('#exportReport').on('click',function(e){

		$form = $('#ProductionIndexForm');
		
		$url = $(this).parents('form').attr('action');

		if ( $('#productionDate').val($('.myDateRange').val()) ) {

			return true;

		} else {

			e.preventDefault();	
		}

	});

});