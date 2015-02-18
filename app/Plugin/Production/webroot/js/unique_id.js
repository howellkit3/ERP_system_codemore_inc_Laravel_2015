jQuery(function($){
$("#startDate").mask("99/99/9999");
	$('#select_company').change(function(){

		var option = $(this).val();
		
		$.ajax({
			url: serverPath + "production/production_systems/find_data/"+option,
			type: "get",
			dataType: "json",
			success: function(data) {
				// console.log(inquiryId);
				console.log(data);
				if (data.length == 0){
					$('#unique_id').val('');	

				}else{

					$('#unique_id').val(data.Quotation.unique_id);

				}
			
			}
		})
			
	});

});