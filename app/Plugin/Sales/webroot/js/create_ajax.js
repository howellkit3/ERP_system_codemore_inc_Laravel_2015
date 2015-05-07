	$('.contacpersonlist').change(function(){
			$('.option-append-contact').remove();
			var contactID = $(this).val();

			var selected = $('#quotations_attention_details').val();

			$("#loading").clone().show().addClass("loading_event").insertAfter($(this)); //ajax loader

			$.ajax({
				url: serverPath + "sales/products/find_contact/"+contactID,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {
					$.each(data, function(key, value) {
						
						if (value.ContactPerson.id == selected) {
							$option = "<option class='option-append-contact' selected value="+ value.ContactPerson.id + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";	
						} else {
							$option = "<option class='option-append-contact' value="+ value.ContactPerson.id + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";
							// $option = "<option class='option-append-contact'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}
					     $('#QuotationAttentionDetails').append($option);
					    
					});	
					 $('.loading_event').remove();
					//$('.categorylist').change();	
				}
			});			
	}).trigger('change');

	$('.categorylist').change(function(){

			$('.option-append').remove();
			$('.option-append2').remove();	
			$("#loading").clone().show().addClass("loading_event").insertAfter($(this)); //ajax loader
			var option = $(this).val();
			var selected = $('#selected_item_type').val();
			$.ajax({
				url: serverPath + "sales/products/find_categ/"+option,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {

					// var typeOption = [];
			
					$.each(data, function(key, value) {
						if (value.id == selected) {

							$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
						} else {

							$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}

						// typeOption.push($option);

						// // alert(typeOption);

						// typeOption.sort(); 

						// alert(typeOption);

					     $('#item_type_holder_id').append($option);
					});	
					  $('.loading_event').remove();

					 $('#item_type_holder_id').change();	
				}
			});			
	}).trigger('change');

$('#item_type_holder_id').change(function(){
		var itemtypeid = $(this).val();	
		$('.option-append2').remove();
		$("#loading").clone().show().addClass("loading_event").insertAfter($(this)); //ajax loader
			
		$.ajax({
			url: serverPath + "sales/products/find_product/"+itemtypeid,
			type: "get",
			dataType: "json",
			success: function(data) {
				
				$.each(data, function(key, value) {

					if (value.id == itemtypeid) {

					$option = "<option class='option-append2' selected value="+value.Product.id+">"+value.Product.name+"</option>";	
					alert();
					} else {
					$option = "<option class='option-append2' value="+value.Product.id+">"+value.Product.name+"</option>";
					}
					$('#product_holder_id').append($option);
					
				});
				 $('.loading_event').remove();
			
		}
		});		
	});