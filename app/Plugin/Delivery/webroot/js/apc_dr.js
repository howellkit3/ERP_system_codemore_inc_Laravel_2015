$(document).ready(function(){

	$('.datepicker').datepicker();

	$('#DeliveryCompanyId').change(function(){

		$this = $(this);

		$('#DeliveryContact .appended').remove();

		$.ajax({
			url: serverPath + "delivery/deliveries/check_contact",
			type: "get",
			async: false,
			dataType: "json",
			data : {'company_id' : $this.val() },
			success: function(data) {
						
					
					try {
							
							$.each( data.ContactPerson, function( key, value ) {

							var name = 	value.firstname;

							if (value.middlename != '') {
								name += ' '+ value.middlename;
							}
							name += ' '+ value.lastname; 
								
							$('#DeliveryContact').append('<option class="appended" selected value="'+value.id+'">'+name+'</option>');
					
						});
					

					} catch(err) {
							console.log(err);
					}	



					try {
						$.each( data.Contact, function( key, value ) {

								
							$('#DeliveryTelNum').append('<option class="appended" selected value="'+value.id+'">'+value.number+'</option>');
					
						});
					

					} catch(err) {
							console.log(err);
					}	


			}
		});


		//change label company

		var modalForm = $('#checkItem');
		var modelText = modalForm.find('.lbl-customer');

		var companySelected = modalForm.find('#companyId');

		modelText.empty();
		modelText.text($('#DeliveryCompanyId option:selected').text());

		companySelected.val($('#DeliveryCompanyId option:selected').val());

	});

	$('#findDeliverySchedule').click(function(e){

		var date1 = $('#checkItem #dateFrom').val();

		var date2 = $('#checkItem #dateTo').val();

		var companyId = $('#companyId').val();

		var appendTable = $('.append-result');

		$.ajax({
			url : serverPath + 'delivery/deliveries/find_delivery_schedule',
			dataType : 'html',
			type: 'POST',
			data : {'from' : date1 , 'to' : date2 , 'company_id' : companyId },
			success : function(data) {
				
				try {
					appendTable.html(data);
				} catch(err) {
					console.log(err);
				}
			}
 
		});

e.preventDefault();


	});

	$('#checkItem button.btn-primary').click(function(){

		$key = 1;
		$('.checkbox-item:checked').each(function(){

			$html = '<tr>';
			$html += '<td>'+$(this).parent().text()+'<input type="hidden" name="data[ClientOrderDelivery]['+$key+'][delivery_schedule_id]" value="'+$(this).val()+'"><input type="hidden" name="data[ClientOrderDelivery]['+$key+'][client_order_id]" value="'+$(this).data('client')+'"></td>';
			
			$html += '<td>'+$(this).data('po')+'</td>';
			$html += '<td>'+$(this).data('po')+'</td>';
			$html += '<td><a href="#" class="delete-item"><i class="fa fa-trash" title="delete item"></i></a></td>';
			$html += '</tr>';

			$('#tableAppendModal tbody.result').append($html);

			$key++;
		});

	
	});

	$('body').on('click','.delete-item',function(e){
		
			$(this).parents('tr').remove();	

			e.preventDefault();	
	});


});