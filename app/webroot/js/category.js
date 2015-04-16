$(function(){

$('#ItemTypeHolderItemCategoryHolderId').change(function(){

		$('.option-append').remove();	
		var option = $(this).val();
		var selected = $('#selected_type').val();

		$.ajax({
		url: serverPath + "/settings/category_find/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {
			$('.radio-type input').removeAttr('checked');
			$('.radio-type input').each(function(){

				if (data.ItemCategoryHolder.category_type == $(this).val()) {

						$(this).prop("checked", true)
				}

			});
			// });			
		}
		});			
	}).trigger('change');

$('.radio-type label').click(function(){
	
	$('.radio-type input').attr('checked',false);
	$(this).prev().prop('checked',true);

});

});