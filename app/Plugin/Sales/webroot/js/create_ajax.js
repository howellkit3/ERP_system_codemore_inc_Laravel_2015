$(document).ready(function() {

	var companyId = $('.contacpersonlist').val();
	if(companyId){
		$.ajax({
			url: serverPath + "sales/products/find_contact/"+companyId,
			type: "get",
			async: false,
			dataType: "json",
			success: function(data) {
				
				$.each(data, function(key, value) {
					//console.log(value.ContactPerson.id);
					//if (value.ContactPerson.id == selected) {
						$option = "<option class='option-append-contact' value="+ value.ContactPerson.id + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";	
					// } else {
					// 	$option = "<option class='option-append-contact' value="+ value.ContactPerson.id + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";
					// 	// $option = "<option class='option-append-contact'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
					// }
				     $('#QuotationAttentionDetails').append($option);
				    
				});	
				$('.loading_event').remove();
				//$('.categorylist').change();	
			}
		});
	}
		

	$('.contacpersonlist').change(function(){
			//$('.option-append-contact1').remove();
			var contactID = $(this).val();

			var selected = $('#quotations_attention_details').val();

			$("#loading").clone().show().addClass("loading_event").insertAfter($(this)); //ajax loader

			$.ajax({
				url: serverPath + "sales/products/find_contact/"+contactID,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {
					//$('.option-append-contact').remove();
					$.each(data, function(key, value) {
						
						if (value.ContactPerson.id == selected) {
							$option = "<option class='option-append-contact1' value="+ value.ContactPerson.id + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";	
						} else {
							$option = "<option class='option-append-contact1' value="+ value.ContactPerson.id + ">"+ value.ContactPerson.firstname+' '+value.ContactPerson.lastname +"</option>";
							// $option = "<option class='option-append-contact'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}
					     $('#QuotationAttentionDetails').append($option);
					     //alert($option)
					    
					});	
					$('.loading_event').remove();
					//$('.categorylist').change();	
				}
			});			
	});

	$('.categorylist').change(function(){
			
			$('.option-append').remove();
			$('.option-append2').remove();	item_type_holder_id

			$("#loading").clone().show().addClass("loading_event").insertAfter($(this)); //ajax loader
			var option = $(this).val();
			var selected = $('#selected_item_type').val();
			$.ajax({
				url: serverPath + "sales/products/find_categ/"+option,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {
					$("#item_type_holder_id").find('[value]').remove();
					$('#item_type_holder_id').append('<option value="">--Select Item--</option>');
					$.each(data, function(key, value) {
						if (value.id == selected) {
							$option = "<option class='option-append' value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
						} else {
							$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}
					    $('#item_type_holder_id').append($option);
					});	
					  $('.loading_event').remove();

					 //$('#item_type_holder_id').change();	
				}
			});			
	});

	$('#item_type_holder_id').change(function(){
		var itemtypeid = $(this).val();
		$('.option-append2').remove();
		$("#loading").clone().show().addClass("loading_event").insertAfter($(this)); //ajax loader
			
		$.ajax({
			url: serverPath + "sales/products/find_product/"+itemtypeid,
			type: "get",
			dataType: "json",
			success: function(data) {
				$("#product_holder_id").find('[value]').remove();
				$('#product_holder_id').append('<option value="">--Select Item--</option>');
				$.each(data, function(key, value) {
					if (value.id == itemtypeid) {
					$option = "<option class='option-append2' value="+value.Product.id+">"+value.Product.name+"</option>";	
					} else {
					$option = "<option class='option-append2' value="+value.Product.id+">"+value.Product.name+"</option>";
					}
					$('#product_holder_id').append($option);
					
				});
				 $('.loading_event').remove();
			
			}
		});		
	});
});