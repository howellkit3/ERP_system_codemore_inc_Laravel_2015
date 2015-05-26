$(function(){
	
$('#CorrugatedPaperLayers').load(function(){
	$('.corrugatedPaper-layers').remove();
	var option = $(this).val();
	var selected = $(this).val();

	//alert ();

	$inputs = '';
	var count = 1;
	for (i = 0; i < selected; i++) { 

		$inputs += '<div class="form-group corrugatedPaper-layers"><label class="col-lg-3 control-label"><span style="color:red">*</span>Substrate  '+count+'</label>';
		$inputs += '<div class="col-lg-8"><input type="hidden" maxlength="120"  class="form-control layer" name="data[ItemGroupLayer][no][]" value="' + i + '"></div>';
		$inputs += '<div class="col-lg-7"><input type="text" maxlength="120" required = "required"  placeholder = "Substrate name" class="form-control layer" name="data[ItemGroupLayer][substrate][]"></div></div>';

		$inputs += '<div class="form-group corrugatedPaper-layers"><label class="col-lg-3 control-label"><span style="color:red">*</span>Flute  '+count+'</label>';
		$inputs += '<div class="col-lg-7"><input type="text" maxlength="120"  placeholder = "Flute" class="form-control layer" name="data[ItemGroupLayer][flute][]"></div></div>';
		count++;

		$inputs += '<div class="form-group corrugatedPaper-layers"><label class="col-lg-2 control-label"></label>';
			$inputs += '<div class="col-lg-8"><hr style="color:#787878"></div></div>';
	}

	$inputs += '<div class="form-group corrugatedPaper-layers"><label class="col-lg-2 control-label"></label>';
			$inputs += '<div class="col-lg-8"><hr style="color:#787878"></div></div>';


	$(this).parents('.form-group').after($inputs);
    return false;
});

$('body').on('click','.remove-layers',function(){

		var parent = $(this).parent().parent().parent().parent();
		
		parent.find('.remove-field').val('true');

		if (parent.find('.remove-field').length > 1) {

				parent.attr('style','display:none');
				parent.remove();
		} else {

			parent.remove();
		}
		
		var layer = 1;

		$('.substrate-layers:visible').each(function(){

				//$(this).find('.control-label').first().html('<span style="color:red">*</span>Substrate '+layer++);
		});

		$('#CorrugatedPaperLayers').val($('.layercount').length);

});

});