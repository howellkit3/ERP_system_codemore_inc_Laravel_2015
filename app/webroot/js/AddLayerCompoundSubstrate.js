$(function(){

 $("body").on('keyup','#CompoundSubstrateLayers', function(e){

	var option = $(this).val();
	var selected = $(this).val();


	if ($(this).hasClass('edit')) {

		var count  = $('.substrate-layers:visible').length;


		$inputs = '';
		for (i = count; i < selected; i++) { 
			count_visible = count + 1;
		$inputs += '<div class="form-group substrate-layers"><label class="col-lg-2 control-label"><span style="color:red">*</span>Substrate  '+count_visible+'</label>';
		$inputs += '<div class="col-lg-8"><input type="hidden" maxlength="120"  class="form-control layer" name="data[ItemGroupLayer][no][]" value="' + i + '"></div>';
		$inputs += '<div class="col-lg-8"><input type="text" maxlength="120" required = "required" placeholder = "Substrate name" class="form-control layer" name="data[ItemGroupLayer][substrate][]"></div>';
		$inputs += '<div class="form-group"><div class="col-lg-1"><button type="button" class="remove-field remove-layers btn btn-danger" ><i class="fa fa-minus"></i></button></div></div></div>';
		
		count++;

		}

		$('.substrate-layers:visible').last().after($inputs);


	} else {

	
	$('.substrate-layers').remove();

	$inputs = '';
	var count = 1;
	for (i = 0; i < selected; i++) { 
		$inputs += '<div class="form-group substrate-layers"><label class="col-lg-2 control-label"><span style="color:red">*</span>Substrate  '+count+'</label>';
		$inputs += '<div class="col-lg-8"><input type="hidden" maxlength="120"  class="form-control layer" name="data[ItemGroupLayer][no][]" value="' + i + '"></div>';
		$inputs += '<div class="col-lg-8"><input type="text" maxlength="120" required = "required" placeholder = "Substrate name" class="form-control layer" name="data[ItemGroupLayer][substrate][]"></div>';
		$inputs += '<div class="form-group"><div class="col-lg-1"><button type="button" class="remove-field remove-layers btn btn-danger" ><i class="fa fa-minus"></i></button></div></div></div>';
		count++;
	}
	$(this).parents('.form-group').after($inputs);

	}
    return false;
});

$('body').on('click','.remove-layers',function(){

		var parent = $(this).parent().parent().parent();

		//console.log(parent.attr('class'));

		 //var count  = $('.abc').length;

		// alert(count);
		
		parent.find('.remove-field').val('true');

		if (parent.find('.remove-field').length > 1) {

			//alert('i entered if');
				parent.attr('style','display:none');
				parent.remove();
		} else {

			//alert('i entered else');
			parent.remove();
		}
		
		var layer = 1;

		$('.substrate-layers:visible').each(function(){

				$(this).find('.control-label').first().html('<span style="color:red">*</span>Substrate '+layer++);
		});

		$('#CompoundSubstrateLayers').val($('.layercount').length);
});

});