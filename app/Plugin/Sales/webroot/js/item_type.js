jQuery(function($){

	$('#item_category').change(function(){
		//alert($(this).val());

		var option = $(this).val();
		
		$.ajax({
		url: serverPath + "sales/products/get_type/"+option,
		type: "GET",
		dataType: "json",
		success: function(data) {
			$('.option_append').remove();
				$.each(data,function(i,name) {
					$('#item_type').append($('<option class="option_append">').text(name).attr('value',i));

				});
			
		}
		});
			
	}).trigger('change');

});