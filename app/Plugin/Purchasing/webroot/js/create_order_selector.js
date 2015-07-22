jQuery(document).ready(function($){
				
	$("body").on('change','.supplier-select', function(e){
		$('.supplier-append-contact').remove();
		var supplierId = $(this).val();

		if (supplierId) {

			$.ajax({
				url: serverPath + "purchasing/requests/find_supplier_number/"+supplierId,
				type: "get",
				async: false,
				dataType: "json",
				success: function(data) {
					
					$.each(data.contact[0], function(key, value) {
						
						$option = "<option class='supplier-append-contact' value="+ value.id + ">"+ value.number+"</option>";	

						$('#PurchaseOrderContactId').append($option);
					    
					});	

					$.each(data.contactperson[0], function(key, value) {
						
						$option = "<option class='supplier-append-contact' value="+ value.id + ">"+ value.firstname.toUpperCase()+" "+value.lastname.toUpperCase()+"</option>";	

						$('#PurchaseOrderContactPersonId').append($option);
					    
					});	

					$('.loading_event').remove();
						
				}
			});

		}else{

			$('.supplier-append-contact').remove();

		};

	});

});