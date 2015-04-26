$(function(){
	
	$('#CompoundSubstrateCategoryId').change(function(){

		$('.option-append').remove();	
		var option = $(this).val();
		var selected = $('#selected_type').val();

		$.ajax({
		url: serverPath + "settings/ajax_categ/"+option,
		type: "get",
		dataType: "json",
		success: function(data) {

					$.each(data, function(key, value) {

						if (value.ItemTypeHolder.id == selected) {
							$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
						} else {
							$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
						}
					     $('#CompoundSubstrateTypeId').append($option);
					});		
		}
		});			
	}).trigger('change');


});