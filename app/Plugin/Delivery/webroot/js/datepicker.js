jQuery(function($){
	$('#datepickerDate').datepicker({
		  format: 'mm-dd-yyyy'
		});
	$('#timepicker1').timepicker({
			minuteStep: 5,
			showSeconds: true,
			showMeridian: false,
			disableFocus: false,
			showWidget: true
		}).focus(function() {
			$(this).next().trigger('click');
		});
	$('#timepicker2').timepicker({
		minuteStep: 5,
		showSeconds: true,
		showMeridian: false,
		disableFocus: false,
		showWidget: true
	}).focus(function() {
		$(this).next().trigger('click');
	});
});