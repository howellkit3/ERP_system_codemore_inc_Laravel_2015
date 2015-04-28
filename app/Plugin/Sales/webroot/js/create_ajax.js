
	$('.categorylist').change(function(){
			$('.option-append').remove();
			$('.option-append2').remove();	
			var option = $(this).val();
			var selected = $('#selected_item_type').val();
			$.ajax({
				url: serverPath + "sales/products/find_categ/"+option,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {
			
					$.each(data, function(key, value) {
						if (value.id == selected) {
							$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
						} else {
							$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}
					     $('#item_type_holder_id').append($option);
					});	
				}
			});			
	}).trigger('change');

	$('.contacpersonlist').change(function(){
			$('.option-append-contact').remove();
			var contactID = $(this).val();
			$.ajax({
				url: serverPath + "sales/products/find_contact/"+contactID,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {
					$.each(data, function(key, value) {
						if (value.id == contactID) {
							$option = "<option class='option-append-contact' selected value="+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";	
						} else {
							$option = "<option class='option-append-contact' selected value="+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";
							// $option = "<option class='option-append-contact'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}
					     $('#QuotationAttentionDetails').append($option);
					});	
				}
			});			
	}).trigger('change');

	$('#item_type_holder_id').change(function(){
			var itemtypeid = $(this).val();
			$('.option-append2').remove();
			$.ajax({
				url: serverPath + "sales/products/find_product/"+itemtypeid,
				type: "get",
				dataType: "json",
				success: function(data) {
					
					$.each(data, function(key, value) {
						if (value.id == itemtypeid) {
						$option = "<option class='option-append2' selected value="+value.Product.id+">"+value.Product.name+"</option>";	
						} else {
						$option = "<option class='option-append2'  value="+value.Product.id+">"+value.Product.name+"</option>";
						}
						$('#product_holder_id').append($option);
					});			
			}
			});		
		}).trigger('change');