jQuery(function($){
	$('#sales_order_id').change(function(){

		var option = $(this).val();
		
		$.ajax({
		url: serverPath + "accounting/salesInvoice/find_data/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {
			console.log(data);
			if (data.length == 0){
				$('#delivery_no').val('');
				$('#ordered_quantity').val('');
				$('#company_name').val('');
				$('#product_name').val('');
				$('#price').val('');
				$('#quantity_delivered').val('');
				$('#delivered_date').val('');
				$('#accepted_qty').val('');

					
			}else{
				$('#delivery_no').val(data[0]['Schedule']['delivery_no']);
				$('#company_name').val(data[2]['Company']['company_name']);
				$('#product_name').val(data[1]['Product']['product_name']);
				$('#ordered_quantity').val(data[1]['QuotationField'][1]['description']);
				$('#price').val(data[1]['QuotationField'][2]['description']);
				$('#delivered_date').val(data[3][0]['Delivery']['description']);
				$('#quantity_delivered').val(data[3][1]['Delivery']['description']);
				$('#accepted_qty').val(data[3][2]['Delivery']['description']);
				

			}
			
			}
		});
			
	});
});