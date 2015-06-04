$(function(){

	// $('#SubstrateCategoryId').change(function(){
	$("body").on('change','#substrateCaterogy', function(e){
		$('.option-append').remove();
		var option = $(this).val();
		var selected = $('#substrateCaterogy').val();

		$.ajax({
			url: serverPath + "settings/ajax_categ_substrate/"+option,
			type: "get",
			dataType: "json",
			success: function(data) {
				console.log(data);
				console.log('sdfsdfsdf');
				$.each(data, function(key, value) {

					if (value.id == selected) {
						$option = "<option class='option-append' selected value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";	
					} else {
						$option = "<option class='option-append'  value="+value.ItemTypeHolder.id+">"+value.ItemTypeHolder.name+"</option>";
					}
				     $('#SubstrateTypeId').append($option);
				});			
			}
		});			

	});


});