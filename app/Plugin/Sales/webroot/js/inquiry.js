jQuery(function($){
	$.ajax({

			url: serverPath + "sales/products/get_product/"+$('#company_id').val(),
			type: "GET",
			dataType: "json",
			success: function(data) {
				$('.option_append_item').remove();
					$.each(data,function(i,name) {
						console.log(name);
						$('#selectProduct').append($('<option class="option_append_item">').text(name).attr('value',i));

					});
				
				}
	});
	$("#selectProduct").prop('disabled', false);
	$("#txtProduct").prop('disabled', false);
	$("#selectProduct").hide();
	$("#checkBack").hide();
	$("#back").hide();
	
	$('#checkAdd').change(function(){
		
		$("#selectProduct").show();
		$("#checkBack").show();
		$("#back").show();
		$("#txtProduct").hide();
		$("#checkAdd").hide();
		$("#add").hide();
		
	});

	$('#checkBack').change(function(){
		$("#selectProduct").hide();
		$("#checkBack").hide();
		$("#back").hide();
		$("#txtProduct").show();
		$("#checkAdd").show();
		$("#add").show();
	});


	$('.categorylist').change(function(){

		$('.option-append').remove();	
		var option = $(this).val();

		var selected = $('#selected_item_type').val();

		$.ajax({
		url: serverPath + "sales/products/find_item/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {

				$.each(data, function(key, value) {	
					
				if (value.ItemTypeHolder.id == selected) {
					$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
				} else {
					$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
				}
			     $('#item_type_holder_id').append($option);
			});			
		}
		});			
	}).trigger('change');

	$('#select_company').change(function(){

		var option = $(this).val();
		
		$.ajax({
		url: serverPath + "sales/customer_sales/find_data/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {
			if (data.length == 0){
				$('#address1').val('');
				$('#contact').val('');	
				$('#email').val('');	
			}else{
				$('#address1').val(data.Address[0].address1);
				$('#contact').val(data.Contact[0].number);	
				$('#email').val(data.Email[0].email);
				$('#id').val(data.Company.id);
			}		
		}
		});
			
	});
	//this function is for item detail
	$('.select-item').change(function(){

		var option = $(this).val();
		$.ajax({
		url: serverPath + "sales/create_order/find_item_detail/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {
			if (data.length == 0){
				$('#quantity').val('');
				$('#unit_price').val('');	
				$('#vat_price').val('');
				$('#material').val('');	
				$('#itemDetailId').val('');
			}else{
				$('#quantity').val(data.QuotationItemDetail.quantity);
				$('#unit_price').val(data.QuotationItemDetail.unit_price);	
				$('#vat_price').val(data.QuotationItemDetail.vat_price);
				$('#material').val(data.QuotationItemDetail.material);
				$('#itemDetailId').val(data.QuotationItemDetail.id);

			}
		}
		});
			
	});
	// generate PO number
	$('.generate-poNumber').change(function(){

		if($(this).is( ":checked" ) == true){
			
            var data = "PO-" + new Date().getTime();
           	// data.substr(0,-3);
			$('#generate-poNumber').val(data);
			
			$('#generate-poNumber').attr('readonly','true');
        }
        
        if($(this).is( ":checked" ) == false){
			
			$('#generate-poNumber').val('');
			$('#generate-poNumber').removeAttr("readonly");
           
        }
	
	});

	$('#itemCategory').change(function(){

		var option = $(this).val();
		
		$.ajax({
			url: serverPath + "sales/products/get_type/"+option,
			type: "GET",
			dataType: "json",
			success: function(data) {

			$.each(data, function(key, value) {
				     $('#itemType')
				         .append($("<option></option>")
				         .attr("value",key)
				         .text(value));
				});
				// $('.option_append').remove();
				// 	$.each(data,function(i,name) {
				// 		console.log(name);
				// 		$('#itemType').append($('<option class="option_append">').text(name).attr('value',i));



				// 	});	
				
				}
		// }).done(function(){
		// 		$.ajax({
		// 		url: serverPath + "sales/products/get_product/"+$('#itemType').val()+"/"+$('#company_id').val(),
		// 		type: "GET",
		// 		dataType: "json",
		// 		success: function(data) {
		// 			$('.option_append_item').remove();
		// 				$.each(data,function(i,name) {
		// 					console.log(name);
		// 					$('#product').append($('<option class="option_append_item">').text(name).attr('value',i));

		// 				});
					
		// 			}
		// 	});

		});
			
	});

	$('#itemType').change(function(){
		

		var option = $(this).val();
		
		
			$.ajax({
			url: serverPath + "sales/products/get_product/"+$('#itemType').val()+"/"+$('#company_id').val(),
			type: "GET",
			dataType: "json",
			success: function(data) {
				$('.option_append_item').remove();
					$.each(data,function(i,name) {
						console.log(name);
						$('#product').append($('<option class="option_append_item">').text(name).attr('value',i));

					});
				
				}
			});

		});
	$('#product').change(function(){

		var option = $(this).val();
		
			$.ajax({
			url: serverPath + "sales/products/get_product_spec/"+option,
			type: "GET",
			dataType: "json",
			success: function(data) {

					console.log(data);
					if (data.length == 0){
						$('#QuotationField2Description').val('');
						$('#QuotationField4Description').val('');	
						$('#QuotationField5Description').val('');
						$('#QuotationField6Description').val('');
						$('#QuotationField7Description').val('');
						$('#QuotationField8Description').val('');
						$('#QuotationField9Description').val('');
						$('#QuotationField10Description').val('');
						$('#QuotationField12Description').val('');
					}else{
						$('#QuotationField2Description').val(data[0]['ProductSpec']['description']);
						$('#QuotationField4Description').val(data[1]['ProductSpec']['description']);	
						$('#QuotationField5Description').val(data[2]['ProductSpec']['description']);
						$('#QuotationField6Description').val(data[3]['ProductSpec']['description']);
						$('#QuotationField7Description').val(data[4]['ProductSpec']['description']);
						$('#QuotationField8Description').val(data[5]['ProductSpec']['description']);
						$('#QuotationField9Description').val(data[6]['ProductSpec']['description']);
						$('#QuotationField10Description').val(data[7]['ProductSpec']['description']);
						$('#QuotationField12Description').val(data[8]['ProductSpec']['description']);

					}
				
				}
			});

		});
	
	

});


	