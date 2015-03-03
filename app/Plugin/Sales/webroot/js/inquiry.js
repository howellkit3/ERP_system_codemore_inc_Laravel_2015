jQuery(function($){

	$('#select_company').change(function(){

		var option = $(this).val();
		
		$.ajax({
		url: serverPath + "sales/customer_sales/find_data/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {
			console.log(data);
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

	$('#itemCategory').change(function(){
		//alert($(this).val());

		var option = $(this).val();
		//var type = $('#itemType').val();
		
		$.ajax({
			url: serverPath + "sales/products/get_type/"+option,
			type: "GET",
			dataType: "json",
			success: function(data) {
				$('.option_append').remove();
					$.each(data,function(i,name) {
						console.log(name);
						$('#itemType').append($('<option class="option_append">').text(name).attr('value',i));



					});	
				
				}
		}).done(function(){
				$.ajax({
				url: serverPath + "sales/products/get_product/"+$('#itemType').val()+"/"+$('#select_company').val(),
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
			
	});

	$('#itemType').change(function(){
		//alert($(this).val());

		var option = $(this).val();
		//var type = $('#itemType').val();
		
			$.ajax({
			url: serverPath + "sales/products/get_product/"+$('#itemType').val()+"/"+$('#select_company').val(),
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
			
	

});


	