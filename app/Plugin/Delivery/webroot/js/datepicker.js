jQuery(function($){
	$('#truck_plate_number').change(function(){
		//alert($(this).val());

		var option = $(this).val();
		
			$.ajax({
			url: serverPath + "delivery/truckSchedules/get_product_schedule",
			type: "POST",
			 data: {"plate_number": option, "sched_date": $('#datepickerDate').val() },
			//dataType: "json",
			success: function(data) {
					console.log(data);
					//alert(data);
					$("#table-schedule").html(data);

				}
			});

	});

	$('#datepickerDate').change(function(){	
		$.ajax({
		url: serverPath + "delivery/truckSchedules/get_product_schedule",
		type: "POST",
		 data: {"plate_number": $('#truck_plate_number').val(), "sched_date": $('#datepickerDate').val() },
		//dataType: "json",
		success: function(data) {
				console.log(data);
				//alert(data);
				$("#table-schedule").html(data);

			}
		});

	});

	$('#timepicker1').change(function(){
		//alert($('#timepicker1').val());
		
		$.ajax({
		url: serverPath + "delivery/truckSchedules/get_product_schedule",
		type: "POST",
		 data: {"plate_number": $('#truck_plate_number').val(), "sched_date": $('#datepickerDate').val(),"time_from": $('#timepicker1').val()},
		//dataType: "json",
		success: function(data) {
				console.log(data);
				//alert(data);
				$("#table-schedule").html(data);

			}
		});

	});
	$('#datepickerDate').datepicker({
		  format: 'mm-dd-yyyy'
		  
	});
	$('#delivered_date').datepicker({
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