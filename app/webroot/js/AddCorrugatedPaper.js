$(function(){
	
$('#CorrugatedPaperCategoryId').change(function(){
			$('.option-append').remove();
			var option = $(this).val();
			var selected = $('#CorrugatedPaperCategoryId').val();
			$.ajax({
				url: serverPath + "settings/ajax_categ/"+option,
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
					     $('#CorrugatedPaperTypeId').append($option);
					});			
				}
			});			

	}).trigger('change');


});